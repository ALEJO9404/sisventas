@extends ('disenopagina.plantillapagina')

@section('Contenido')
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Cliente: {{$cliente->nombre}}</h3>
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


        {!!Form::model($cliente, ['action'=>['ControladorCliente@update', $cliente->id], 'method'=>'PATCH'])!!}
        {{Form::token()}}

                <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" required value="{{$cliente->nombre}}" class="form-control" placeholder="Nombre...">
                  </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" required value="{{$cliente->direccion}}" class="form-control" placeholder="Dirección...">
                  </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-gruop">
                    <label for="tipo_documento" >Tipo de Documento</label>
                    <select name="tipo_documento" class="form-control">
                    @if($cliente->tipo_documento=="Cédula de Ciudadania")
                        <option value="Cédula de Ciudadania" selected>Cédula de Ciudadania</option>
                        <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                        <option value="NIT">NIT</option>
                    @elseif($cliente->tipo_documento=="Cédula de Extranjería")
                        <option value="Cédula de Ciudadania">Cédula de Ciudadania</option>
                        <option value="Cédula de Extranjería" selected>Cédula de Extranjería</option>
                        <option value="NIT">NIT</option>
                    @elseif($cliente->tipo_documento=="NIT")
                        <option value="Cédula de Ciudadania">Cédula de Ciudadania</option>
                        <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                        <option value="NIT" selected>NIT</option>
                    @endif
                    </select>
                  </div>  
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="numero_documento">Número de Documento</label>
                    <input type="text" name="numero_documento" required value="{{$cliente->numero_documento}}" class="form-control" placeholder="Número de Documento...">
                  </div>      
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono"  value="{{$cliente->telefono}}" class="form-control" placeholder="Teléfono...">
                  </div>   
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" required value="{{$cliente->email}}" class="form-control" placeholder="Email...">
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