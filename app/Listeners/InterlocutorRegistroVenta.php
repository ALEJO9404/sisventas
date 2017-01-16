<?php

namespace Sisventas\Listeners;

use Sisventas\Events\RegistroVenta;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InterlocutorRegistroVenta
{
//    public $DetalleVenta;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(/*$DetalleVenta*/)
    {
        /*$this->DetalleVenta = $DetalleVenta;*/
    }

    /**
     * Handle the event.
     *
     * @param  RegistroVenta  $event
     * @return void
     */
    public function handle(RegistroVenta $event)
    {
        //
    }
}
