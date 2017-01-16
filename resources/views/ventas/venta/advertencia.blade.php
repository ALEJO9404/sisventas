<div class="modal fade modal-slide-in-right" aria-hidden="True" role="dialog" tabindex="-1" id="mensajeadvertenciaeliminar-{{$ven->id}}">
 {!!Form::open(['action'=>['ControladorVenta@destroy',$ven->id], 'method'=>'delete'])!!}
 <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">x</span>
        </button>	
        <h4 class="modal-title">Anular Venta</h4>
 	  </div>
 	  <div class="modal-body">
 		<p>Confirme si desea anular la venta</p>
 	  </div>
 	  <div class="modal-footer">
 	  	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>	
 	  	<button class="btn btn-primary" type="submit">Confirmar</button>
 	  </div>
   </div>
 </div>
 {!! Form::close() !!}
</div>