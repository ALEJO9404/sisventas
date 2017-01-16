<?php

namespace Sisventas\Listeners;

use Sisventas\Articulo;
use Sisventas\Events\IngresoInventario;
use Sisventas\Events\RegistroVenta;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActualizarInventario
{
    /**
     * Handle user IngresoInventario events.
     */
    public function RegistroIngresoInventario($event) {
        $articulo=Articulo::findOrFail($event->DetalleIngreso->articulo_id);
        $articulo->stock=$articulo->stock+$event->DetalleIngreso->cantidad;
        $articulo->update();
    }

    /**
     * Handle user RegistroVenta events.
     */
    public function RegistroEgresoInventario($event) {
        $articulo=Articulo::findOrFail($event->DetalleVenta->articulo_id);
        $articulo->stock=$articulo->stock-$event->DetalleVenta->cantidad;
        $articulo->update();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Sisventas\Events\IngresoInventario',
            'Sisventas\Listeners\ActualizarInventario@RegistroIngresoInventario'
        );

        $events->listen(
            'Sisventas\Events\RegistroVenta',
            'Sisventas\Listeners\ActualizarInventario@RegistroEgresoInventario'
        );
    }

}
