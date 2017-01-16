<?php

namespace Sisventas\Http\Controllers;

use Illuminate\Http\Request;

use Sisventas\Persona; //LLamar al modelo Categoria
use Illuminate\Support\Facades\Redirect;
use Sisventas\Http\Requests\ValidacionPersona; //Formulario de validación de datos
use Illuminate\Support\Facades\DB; //Trabajo con el generador de consultas

class ControladorProveedor extends Controller
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
            $Resultado=DB::table('personas')->where('nombre','LIKE','%'.$FiltroConsulta.'%')
            ->where('tipo_persona','=','Proveedor')
            ->orwhere('numero_documento','LIKE','%'.$FiltroConsulta.'%')
            ->where('tipo_persona','=','Proveedor')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('compras.proveedor.index',["proveedores"=>$Resultado, "FiltroBusqueda"=>$FiltroConsulta]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compras.proveedor.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionPersona $request)
    {
     $proveedor=new Persona;
     $proveedor->tipo_persona="Proveedor";
     $proveedor->nombre=$request->get('nombre');
     $proveedor->tipo_documento=$request->get('tipo_documento');
     $proveedor->numero_documento=$request->get('numero_documento');
     $proveedor->direccion=$request->get('direccion');
     $proveedor->telefono=$request->get('telefono');
     $proveedor->email=$request->get('email');
     $proveedor->save();
     return Redirect::to('compras/proveedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("compras.proveedor.mostrar",["proveedor"=>Persona::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("compras.proveedor.editar",["proveedor"=>Persona::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionPersona $request, $id)
    {
        $proveedor=Persona::findOrFail($id);
        $proveedor->nombre=$request->get('nombre');
        $proveedor->tipo_documento=$request->get('tipo_documento');
        $proveedor->numero_documento=$request->get('numero_documento');
        $proveedor->direccion=$request->get('direccion');
        $proveedor->telefono=$request->get('telefono');
        $proveedor->email=$request->get('email');
        $proveedor->update();
        return Redirect::to('compras/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor=Persona::findOrFail($id);
        $proveedor->tipo_persona='ProveedorInactivo';
        $proveedor->update();
        return Redirect::to('compras/proveedor');
    }
}
