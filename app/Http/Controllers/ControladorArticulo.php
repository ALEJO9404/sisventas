<?php

namespace Sisventas\Http\Controllers;

use Illuminate\Http\Request;

use Sisventas\Articulo;  //LLamar al modelo Articulo
use Sisventas\Categoria; //LLamar al modelo Categoria
use Illuminate\Support\Facades\Redirect;// Trabajo con redirecciones
use Illuminate\Support\Facades\Input; //Trabajo con ficheros
use Illuminate\Support\Facades\File; //Eliminar Archivos
use Sisventas\Http\Requests\ValidacionArticulo; //Formulario de validación de datos
use Illuminate\Support\Facades\DB; //Trabajo con el generador de consultas

class ControladorArticulo extends Controller
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
            $Resultado=Articulo::with('Categoria')
            ->where([['nombre','LIKE','%'.$FiltroConsulta.'%'], ['estado','=','Activo']])
            ->orwhere([['codigo','LIKE','%'.$FiltroConsulta.'%'], ['estado','=','Activo']])
            ->orderBy('nombre','desc')
            ->paginate(7);
            return view('almacen.articulo.index',["articulos"=>$Resultado, "FiltroBusqueda"=>$FiltroConsulta]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias=DB::table('categorias')->where('condicion','=','1')->get();
        return view('almacen.articulo.crear',["categorias"=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionArticulo $request)
    {
     $articulo=new Articulo;
     $articulo->categoria_id=$request->get('categoria_id');
     $articulo->codigo=$request->get('codigo');
     $articulo->nombre=$request->get('nombre');
     $articulo->stock=$request->get('stock');
     $articulo->descripcion=$request->get('descripcion');
     if(Input::hasFile('imagen')){
        $file=Input::file('imagen');
        $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
        $articulo->imagen=$file->getClientOriginalName();
     }
     $articulo->estado='Activo';
     $articulo->save();
     return Redirect::to('almacen/articulo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("almacen.articulo.mostrar",["articulo"=>Articulo::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias=DB::table('categorias')->where('condicion','=','1')->get();
        return view("almacen.articulo.editar",["articulo"=>Articulo::findOrFail($id),"categorias"=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionArticulo $request, $id)
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
        $articulo=Articulo::findOrFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
}
