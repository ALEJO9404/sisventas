@extends ('disenopagina.plantillapagina')

@section('Contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Proveedores <a href="proveedor/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include ('compras.proveedor.buscar')
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

				@foreach ($proveedores as $pro)
				<tr>
					<td style="vertical-align:middle;">{{$pro->id}}</td>
					<td style="vertical-align:middle;">{{$pro->nombre}}</td>
					<td style="vertical-align:middle;">{{$pro->tipo_documento}}</td>
					<td style="vertical-align:middle;">{{$pro->numero_documento}}</td>
					<td style="vertical-align:middle;">{{$pro->direccion}}</td>
					<td style="vertical-align:middle;">{{$pro->telefono}}</td>
					<td style="vertical-align:middle;">{{$pro->email}}</td>
					<td style="vertical-align:middle;" align="center">
						<a href="{{URL::action('ControladorProveedor@edit', $pro->id)}}"><button class="btn btn-info">Editar</button></a>
						<a data-target="#mensajeadvertenciaeliminar-{{$pro->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('compras.proveedor.advertencia')
				@endforeach
			</table>
		</div>
		{{$proveedores->render()}}
	</div>
</div>
@endsection