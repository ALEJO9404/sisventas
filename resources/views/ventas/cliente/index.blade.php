@extends ('disenopagina.plantillapagina')

@section('Contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Clientes <a href="cliente/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include ('ventas.cliente.buscar')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Tipo de Documento</th>
					<th>Número de Documento</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>

				@foreach ($clientes as $cli)
				<tr>
					<td style="vertical-align:middle;">{{$cli->id}}</td>
					<td style="vertical-align:middle;">{{$cli->nombre}}</td>
					<td style="vertical-align:middle;">{{$cli->tipo_documento}}</td>
					<td style="vertical-align:middle;">{{$cli->numero_documento}}</td>
					<td style="vertical-align:middle;">{{$cli->direccion}}</td>
					<td style="vertical-align:middle;">{{$cli->telefono}}</td>
					<td style="vertical-align:middle;">{{$cli->email}}</td>
					<td style="vertical-align:middle;" align="center">
						<a href="{{URL::action('ControladorCliente@edit', $cli->id)}}"><button class="btn btn-info">Editar</button></a>
						<a data-target="#mensajeadvertenciaeliminar-{{$cli->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('ventas.cliente.advertencia')
				@endforeach
			</table>
		</div>
		{{$clientes->render()}}
	</div>
</div>
@endsection