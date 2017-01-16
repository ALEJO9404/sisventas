@extends ('disenopagina.plantillapagina')

@section('Contenido')
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Articulo: {{$articulo->nombre}}</h3>
        @if (count($errors)>0)
                <div class="alert alert-danger">
                        <ul>
                        @foreach($errors->all() as $errores)
                                <li>{{$errores}}</li>
                        @endforeach
                        </ul>
                </div>
        @endif
        </div>
</div>


        {!!Form::model($articulo, ['action'=>['ControladorArticulo@update', $articulo->id], 'method'=>'PATCH', 'files'=>'true'])!!}
        {{Form::token()}}

                <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control" placeholder="Nombre...">
                  </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control" placeholder="Código del artículo...">
                  </div>      
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion"  value="{{$articulo->descripcion}}" class="form-control" placeholder="Descripción del artículo...">
                  </div>   
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control" placeholder="Stock del artículo...">
                  </div>   
                </div>
                

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-gruop">
                    <label for="categoria_id" >Categoria</label>
                    <select name="categoria_id" class="form-control">
                      @foreach ($categorias as $cat)
                      @if($cat->id==$articulo->categoria_id)
                        <option value="{{$cat->id}}" selected>{{$cat->nombre}}</option>
                      @else
                        <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>  
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" class="form-control">
                    @if (($articulo->imagen)!="")
                    <img src="{{asset('Imagenes/Articulos/'.$articulo->imagen)}}" height="200px" width="200px" class="img-thumbnail">
                    @endif
                  </div>   
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                  </div>
                </div>
        </div>
        {!! Form::close() !!}
@endsection