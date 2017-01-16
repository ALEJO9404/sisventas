<?php

namespace Sisventas\Http\Controllers;

use Illuminate\Http\Request;

use Sisventas\Articulo; 
use Sisventas\DetalleIngreso;
use Sisventas\Venta; 
use Sisventas\DetalleVenta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Sisventas\Http\Requests\ValidacionVenta; 
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ControladorVenta extends Controller
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
            $Resultado=Venta::with('DetalleVenta','Persona')
            ->where('num_comprobante','LIKE','%'.$FiltroConsulta.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('ventas.venta.index',["ventas"=>$Resultado, "FiltroBusqueda"=>$FiltroConsulta]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes=DB::table('personas')->where('tipo_persona','=','Cliente')->get();
        $articulos=Articulo::with('DetalleIngreso')

        ->where('articulos.estado','=','Activo')
        ->where('articulos.stock','>','0')
        ->get();
        return view('ventas.venta.crear',["clientes"=>$clientes, "articulos"=>$articulos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionVenta $request)
    {
    	try {
    		DB::beginTransaction();
    		$venta=new Venta;
            $venta->persona_id=$request->get('persona_id');
            $venta->user_id=Auth::user()->id;
            $venta->tipo_comprobante=$request->get('tipo_comprobante');
            $venta->serie_comprobante=$request->get('serie_comprobante');
            $venta->num_comprobante=$request->get('num_comprobante');
            $venta->total_venta=$request->get('total_venta');
            $venta->impuesto="18";
            $venta->estado="Activa";
            $venta->save();
            $articulo_id=$request->get('articulo_id');
            $cantidad=$request->get('cantidad');
            $descuento=$request->get('descuento');
            $precio_venta=$request->get('precio_venta');
            $c=0;
            while ($c < count($articulo_id)) {
            	$detalleventa=new DetalleVenta;
                $detalleventa->venta_id=$venta->id;
                $detalleventa->articulo_id=$articulo_id[$c];
                $detalleventa->cantidad=$cantidad[$c];
                $detalleventa->descuento=$descuento[$c];
                $detalleventa->precio_venta=$precio_venta[$c];
                $detalleventa->save();
                $c=$c+1;
            }
            DB::commit();
    	} catch (Exception $e) {
    		DB::rollBack();
    	}
     return Redirect::to('ventas/venta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("ventas.venta.mostrar",["venta"=>Venta::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("ventas.venta.editar",["venta"=>Venta::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionVenta $request, $id)
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
        return Redirect::to('ventas/venta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta=Venta::findOrFail($id);
        $venta->estado='Anulada';
        $venta->update();
        return Redirect::to('ventas/venta');
    }
}
