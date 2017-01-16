@extends ('disenopagina.plantillapagina')

@section('Contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include ('ventas.venta.buscar')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>

				@foreach ($ventas as $ven)
				<tr>
					<td style="vertical-align:middle;">{{$ven->created_at}}</td>
					<td style="vertical-align:middle;">{{$ven->persona->nombre}}</td>
					<td style="vertical-align:middle;">{{$ven->tipo_comprobante.":".$ven->serie_comprobante."-".$ven->num_comprobante}}</td>
					<td style="vertical-align:middle;">{{$ven->impuesto}}</td>
					<td style="vertical-align:middle;">{{$ven->total_venta}}</td>
					<td style="vertical-align:middle;">{{$ven->estado}}</td>
					<td style="vertical-align:middle;" align="center">
						<a href="{{URL::action('ControladorVenta@show', $ven->id)}}"><button class="btn btn-primary">Detalles</button></a>
						<a data-target="#mensajeadvertenciaeliminar-{{$ven->id}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('ventas.venta.advertencia')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>
@endsection