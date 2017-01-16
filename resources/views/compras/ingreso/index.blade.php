@extends ('disenopagina.plantillapagina')

@section('Contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include ('compras.ingreso.buscar')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>

				@foreach ($ingresos as $ing)
				<tr>
					<td style="vertical-align:middle;">{{$ing->created_at}}</td>
					<td style="vertical-align:middle;">{{$ing->persona->nombre}}</td>
					<td style="vertical-align:middle;">{{$ing->tipo_comprobante.":".$ing->serie_comprobante."-".$ing->num_comprobante}}</td>
					<td style="vertical-align:middle;">{{$ing->impuesto}}</td>
					<?php $total=0; ?>
					@foreach ($ing->detalleingreso as $det)
					<?php  $total=$total+(($det->cantidad)*($det->precio_compra)) ?>
					@endforeach
					<td style="vertical-align:middle;">{{$total}}</td>
					<td style="vertical-align:middle;">{{$ing->estado}}</td>
					<td style="vertical-align:middle;" align="center">
						<a href="{{URL::action('ControladorIngreso@show', $ing->id)}}"><button class="btn btn-primary">Detalles</button></a>
						<a data-target="#mensajeadvertenciaeliminar-{{$ing->id}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('compras.ingreso.advertencia')
				@endforeach
			</table>
		</div>
		{{$ingresos->render()}}
	</div>
</div>
@endsection