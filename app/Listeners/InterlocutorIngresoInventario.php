<?php

namespace Sisventas\Listeners;

use Sisventas\Events\IngresoInventario;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InterlocutorIngresoInventario
{
    //public $DetalleIngreso;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(/*$DetalleIngreso*/)
    {
        /*$this->DetalleIngreso = $DetalleIngreso;*/
    }

    /**
     * Handle the event.
     *
     * @param  IngresoInventario  $event
     * @return void
     */
    public function handle(IngresoInventario $event)
    {
        //
    }
}
