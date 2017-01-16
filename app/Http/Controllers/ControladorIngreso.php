<?php

namespace Sisventas\Http\Controllers;

use Illuminate\Http\Request;

use Sisventas\Ingreso;  //LLamar al modelo Ingreso
use Sisventas\DetalleIngreso; //LLamar al modelo Detalle Ingreso
use Illuminate\Support\Facades\Redirect;// Trabajo con redirecciones
use Illuminate\Support\Facades\Input; //Trabajo con ficheros
use Illuminate\Support\Facades\File; //Eliminar Archivos
use Sisventas\Http\Requests\ValidacionIngreso; //Formulario de validación de datos
use Illuminate\Support\Facades\DB; //Trabajo con el generador de consultas
use Carbon\Carbon;//Trabajo con fecha y hora
use Response;
use Illuminate\Support\Collection;

class ControladorIngreso extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){$this->middleware('auth');}
    
    public function index(Request $request)
    {
            if($request){
            $FiltroConsulta=trim($request->get('FiltroBusqueda'));
            $Resultado=Ingreso::with('DetalleIngreso','Persona')
            ->where('num_comprobante','LIKE','%'.$FiltroConsulta.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('compras.ingreso.index',["ingresos"=>$Resultado, "FiltroBusqueda"=>$FiltroConsulta]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores=DB::table('personas')->where('tipo_persona','=','Proveedor')->get();
        $articulos=DB::table('articulos')->select(DB::raw('CONCAT(articulos.codigo, "-", articulos.nombre) as articulo'), 'articulos.id')
        ->where('articulos.estado','=','Activo')
        ->get();
        return view('compras.ingreso.crear',["proveedores"=>$proveedores, "articulos"=>$articulos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionIngreso $request)
    {
    	try {
    		DB::beginTransaction();
    		$ingreso=new Ingreso;
            $ingreso->persona_id=$request->get('persona_id');
            $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
            $ingreso->serie_comprobante=$request->get('serie_comprobante');
            $ingreso->num_comprobante=$request->get('num_comprobante');
            $ingreso->impuesto="18";
            $ingreso->estado="Activo";
            $ingreso->save();
            $articulo_id=$request->get('articulo_id');
            $cantidad=$request->get('cantidad');
            $precio_compra=$request->get('precio_compra');
            $precio_venta=$request->get('precio_venta');
            $c=0;
            while ($c < count($articulo_id)) {
            	$detalleingreso=new DetalleIngreso;
                $detalleingreso->ingreso_id=$ingreso->id;
                $detalleingreso->articulo_id=$articulo_id[$c];
                $detalleingreso->cantidad=$cantidad[$c];
                $detalleingreso->precio_compra=$precio_compra[$c];
                $detalleingreso->precio_venta=$precio_venta[$c];
                $detalleingreso->save();
                $c=$c+1;
            }
            DB::commit();
    	} catch (Exception $e) {
    		DB::rollBack();
    	}
     return Redirect::to('compras/ingreso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("compras.ingreso.mostrar",["ingreso"=>Ingreso::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("compras.ingreso.editar",["ingreso"=>Ingreso::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionIngreso $request, $id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->categoria_id=$request->get('categoria_id');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        if(Input::hasFile('imagen')){
          $file=Input::file('imagen');
          $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
          File::delete(public_path().'/imagenes/articulos/'.$articulo->imagen);
          $articulo->imagen=$file->getClientOriginalName();
        }
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->estado='Anulado';
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }
}
