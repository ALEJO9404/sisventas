<?php

namespace Sisventas\Http\Controllers;

use Illuminate\Http\Request;

use Sisventas\Persona; //LLamar al modelo Categoria
use Illuminate\Support\Facades\Redirect;
use Sisventas\Http\Requests\ValidacionPersona; //Formulario de validación de datos
use Illuminate\Support\Facades\DB; //Trabajo con el generador de consultas

class ControladorCliente extends Controller
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
            ->where('tipo_persona','=','Cliente')
            ->orwhere('numero_documento','LIKE','%'.$FiltroConsulta.'%')
            ->where('tipo_persona','=','Cliente')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('ventas.cliente.index',["clientes"=>$Resultado, "FiltroBusqueda"=>$FiltroConsulta]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ventas.cliente.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionPersona $request)
    {
     $cliente=new Persona;
     $cliente->tipo_persona="Cliente";
     $cliente->nombre=$request->get('nombre');
     $cliente->tipo_documento=$request->get('tipo_documento');
     $cliente->numero_documento=$request->get('numero_documento');
     $cliente->direccion=$request->get('direccion');
     $cliente->telefono=$request->get('telefono');
     $cliente->email=$request->get('email');
     $cliente->save();
     return Redirect::to('ventas/cliente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("ventas.cliente.mostrar",["cliente"=>Persona::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("ventas.cliente.editar",["cliente"=>Persona::findOrFail($id)]);
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
        $cliente=Persona::findOrFail($id);
        $cliente->nombre=$request->get('nombre');
        $cliente->tipo_documento=$request->get('tipo_documento');
        $cliente->numero_documento=$request->get('numero_documento');
        $cliente->direccion=$request->get('direccion');
        $cliente->telefono=$request->get('telefono');
        $cliente->email=$request->get('email');
        $cliente->update();
        return Redirect::to('ventas/cliente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente=Persona::findOrFail($id);
        $cliente->tipo_persona='ClienteInactivo';
        $cliente->update();
        return Redirect::to('ventas/cliente');
    }
}
