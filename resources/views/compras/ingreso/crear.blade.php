@extends ('disenopagina.plantillapagina')

@section('Contenido')
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3>Nuevo Ingreso</h3>
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
        {!!Form::open(['url'=>'compras/ingreso', 'method'=>'POST', 'autocomplete'=>'off']) !!}
        {{Form::token()}}
        <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="proveedor">Proveedor</label>
                    <select name="persona_id" id="persona_id" class="form-control selectpicker" data-live-search="true">
                    @foreach($proveedores as $pro)
                    <option value="{{$pro->id}}">{{$pro->nombre}}</option>
                    @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-gruop">
                    <label for="tipo_comprobante" >Tipo de Comprobante</label>
                    <select name="tipo_comprobante" class="form-control">
                        <option value="Boleta">Boleta</option>
                        <option value="Factura">Factura</option>
                        <option value="Ticket">Ticket</option>
                    </select>
                  </div>  
                </div>
        </div>
        <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="serie_comprobante">Serie Comprobante</label>
                    <input type="text" name="serie_comprobante" required value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie Comprobante...">
                  </div>      
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="num_comprobante">Número Comprobante</label>
                    <input type="text" name="num_comprobante"  value="{{old('num_comprobante')}}" required class="form-control" placeholder="Número Comprobante...">
                  </div>   
                </div>
        </div>

        <div class="row">
                <div class="panel panel-primary">
                   <div class="panel-body">

                         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Artículo</label>
                                <select name="particulo_id" id="particulo_id" class="form-control selectpicker" data-live-search="true">
                                @foreach($articulos as $art)
                                <option value="{{$art->id}}">{{$art->articulo}}</option>
                                @endforeach
                                </select>
                            </div>
                         </div>

                         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
                            </div>
                         </div>

                         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                                <label>Precio de Compra</label>
                                <input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="Precio Compra">
                            </div>
                         </div>

                         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                                <label>Precio de venta</label>
                                <input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="Precio Venta">
                            </div>
                         </div>     

                         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                             <button type="button" id="btn_agregar" class="btn btn-primary">Agregar</button>
                            </div>
                         </div>  

                         <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="form-group">
                                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color:#A9D0F5">
                                        <th>Opciones</th>
                                        <th>Artículos</th>
                                        <th>Cantidad</th>
                                        <th>Precio Compra</th>
                                        <th>Precio Venta</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><h4 id="total">$/0.00</h4></th>
                                    </tfoot>
                                    <tbody></tbody>
                                </table>
                            </div> 
                        </div>

                   </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
                  <div class="form-group">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                  </div>
                </div>
        </div>
        {!! Form::close() !!}
@push('scripts')
<script >
    $(document).ready(function(){
        $('#btn_agregar').click(function(){Agregar();});});
    

    var contador=0;
    total=0;
    subtotal=[];
    $('#guardar').hide();

    function Agregar(){
        articulo_id=$('#particulo_id').val();
        artculo=$('#particulo_id option:selected').text();
        cantidad=$('#pcantidad').val();
        precio_compra=$('#pprecio_compra').val();
        precio_venta=$('#pprecio_venta').val();
        
        if(articulo_id!="" && cantidad!="" && precio_compra!="" && precio_venta!="" ){
            subtotal[contador]=(cantidad*precio_compra);
            total=total+subtotal[contador];
            var filatabladetalle='<tr class="selected" id="fila'+contador+'"><td><button type="button" class="btn btn-warning" onclick="Eliminar('+contador+');">X</button></td><td><input type="hidden" name="articulo_id[]" value="'+articulo_id+'">'+artculo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[contador]+'</td></tr>';
            contador++;
            Limpiar();
            $('#total').html("$/. "+ total);
            Evaluar();
            $('#detalles').append(filatabladetalle);
        }else{
            alert("Error al ingresar el detalle del ingreso, revise los datos del articulo");
        }
    }

    
    function Limpiar(){
        $('#pcantidad').val("");
        $('#pprecio_compra').val("");
        $('#pprecio_venta').val("");
    }

    function Evaluar(){
        if (total>0) {
            $('#guardar').show();
        }else{
            $('#guardar').hide();
        }
    }
    function Eliminar(IndiceTabla){
    total=total-subtotal[IndiceTabla];
    $('#total').html("$/. "+total);
    $('#fila' +IndiceTabla).remove();
    Evaluar();
    }
</script>
@endpush
@endsection