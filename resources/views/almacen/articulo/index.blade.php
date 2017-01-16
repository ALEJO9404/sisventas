@extends ('disenopagina.plantillapagina')

@section('Contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Articulos <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include ('almacen.articulo.buscar')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Código</th>
					<th>Categoria</th>
					<th>Stock</th>
					<th>Imagen</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>

				@foreach ($articulos as $art)
				<tr>
					<td style="vertical-align:middle;">{{$art->id}}</td>
					<td style="vertical-align:middle;">{{$art->nombre}}</td>
					<td style="vertical-align:middle;">{{$art->codigo}}</td>
					<td style="vertical-align:middle;">{{$art->categoria->nombre}}</td>
					<td style="vertical-align:middle;">{{$art->stock}}</td>
					<td style="vertical-align:middle;" align="center"><img src="{{asset('Imagenes/Articulos/'. $art->imagen)}}" alt="{{$art->imagen}}" height="100px" width="100px" class="img-thumbnail"></td>
					<td style="vertical-align:middle;">{{$art->estado}}</td>
					<td style="vertical-align:middle;">
						<a href="{{URL::action('ControladorArticulo@edit', $art->id)}}"><button class="btn btn-info">Editar</button></a>
						<a data-target="#mensajeadvertenciaeliminar-{{$art->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.articulo.advertencia')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>
</div>
@endsection