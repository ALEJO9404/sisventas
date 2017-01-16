<?php

namespace Sisventas\Http\Controllers;

use Illuminate\Http\Request;

use Sisventas\Categoria;
use Illuminate\Support\Facades\Redirect;
use Sisventas\Http\Requests\ValidacionCategoria;
use Illuminate\Support\Facades\DB;


class ControladorCategoria extends Controller
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
            $Resultado=DB::table('categorias')->where('nombre','LIKE','%'.$FiltroConsulta.'%')
            ->where('condicion','=','1')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('almacen.categoria.index',["categorias"=>$Resultado, "FiltroBusqueda"=>$FiltroConsulta]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almacen.categoria.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionCategoria $request)
    {
     $categoria=new Categoria;
     $categoria->nombre=$request->get('nombre');
     $categoria->descripcion=$request->get('descripcion');
     $categoria->condicion='1';
     $categoria->save();
     return Redirect::to('almacen/categoria');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("almacen.categoria.mostrar",["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("almacen.categoria.editar",["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionCategoria $request, $id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
}
