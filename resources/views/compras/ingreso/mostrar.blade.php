@extends ('disenopagina.plantillapagina')
@section('Contenido')
    
        <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="proveedor">Proveedor</label>
                   <p>{{$ingreso->persona->nombre}}</p>
                  </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-gruop">
                    <label for="tipo_comprobante" >Tipo de Comprobante</label>
                    <p>{{$ingreso->tipo_comprobante}}</p>
                  </div>  
                </div>
        </div>
        <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="serie_comprobante">Serie Comprobante</label>
                    <p>{{$ingreso->serie_comprobante}}</p>
                  </div>      
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="num_comprobante">Número Comprobante</label>
                    <p>{{$ingreso->num_comprobante}}</p>
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
                                        <th>Precio Compra</th>
                                        <th>Precio Venta</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tbody>
                                    <?php $total=0; ?>
                                        @foreach($ingreso->detalleingreso as $det)
                                        <tr>
                                            <td>{{$det->articulo->nombre}}</td>
                                            <td>{{$det->cantidad}}</td>
                                            <td>{{$det->precio_compra}}</td>
                                            <td>{{$det->precio_venta}}</td>
                                            <td>{{($det->precio_compra)*($det->cantidad)}}</td>
                                            <?php $total=$total+(($det->precio_compra)*($det->cantidad)); ?>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><h4 id="total">{{"$/".$total}}</h4></th>
                                    </tfoot>
                                </table>
                            </div> 
                        </div>
                   </div>
                </div>
        </div>

@endsection