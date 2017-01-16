{!! Form::open(['url'=>'compras/ingreso', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search']) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="FiltroBusqueda" placeholder="Buscar...." value="{{$FiltroBusqueda}}">
		<span class="input-group-btn"><button type="submint" class="btn btn-primary">Buscar</button></span>
	</div>
</div>
{!! Form::close() !!}