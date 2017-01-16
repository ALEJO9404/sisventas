@extends ('disenopagina.plantillapagina')
@section('Contenido')
    
        <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="proveedor">Cliente</label>
                   <p>{{$venta->persona->nombre}}</p>
                  </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-gruop">
                    <label for="tipo_comprobante" >Tipo de Comprobante</label>
                    <p>{{$venta->tipo_comprobante}}</p>
                  </div>  
                </div>
        </div>
        <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="serie_comprobante">Serie Comprobante</label>
                    <p>{{$venta->serie_comprobante}}</p>
                  </div>      
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="num_comprobante">Número Comprobante</label>
                    <p>{{$venta->num_comprobante}}</p>
                  </div>   
                </div>
        </div>

        <div class="row">
                <div class="panel panel-primary">
                   <div class="panel-body">
                         <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="form-group">
                                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color:#A9D0F5">
                                        <th>Artículos</th>
                                        <th>Cantidad</th>
                                        <th>Precio Venta</th>
                                        <th>Descuento</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tbody>
                                        @foreach($venta->detalleventa as $det)
                                        <tr>
                                            <td>{{$det->articulo->nombre}}</td>
                                            <td>{{$det->cantidad}}</td>
                                            <td>{{$det->precio_venta}}</td>
                                            <td>{{$det->descuento}}</td>
                                            <td>{{(($det->precio_venta)*($det->cantidad))-$det->descuento}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><h4 id="total">{{"$/".$venta->total_venta}}</h4></th>
                                    </tfoot>
                                </table>
                            </div> 
                        </div>
                   </div>
                </div>
        </div>

@endsection