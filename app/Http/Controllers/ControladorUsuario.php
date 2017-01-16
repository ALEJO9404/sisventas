<?php

namespace Sisventas\Http\Controllers;

use Illuminate\Http\Request;

use Sisventas\User; 
use Illuminate\Support\Facades\Redirect;
use Sisventas\Http\Requests\ValidacionUsuario;
use Illuminate\Support\Facades\DB;

class ControladorUsuario extends Controller
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
            $Resultado=DB::table('users')->where('name','LIKE','%'.$FiltroConsulta.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('seguridad.usuario.index',["usuarios"=>$Resultado, "FiltroBusqueda"=>$FiltroConsulta]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seguridad.usuario.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionUsuario $request)
    {
     $usuario=new User;
     $usuario->name=$request->get('name');
     $usuario->email=$request->get('email');
     $usuario->password=bcrypt($request->get('password'));
     $usuario->save();
     return Redirect::to('seguridad/usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("seguridad.usuario.mostrar",["usuario"=>User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("seguridad.usuario.editar",["usuario"=>User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionUsuario $request, $id)
    {
        $usuario=User::findOrFail($id);
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->update();
        return Redirect::to('seguridad/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario=DB::table('users')->where('id','=',$id)->delete();
        return Redirect::to('seguridad/usuario');
    }
}
