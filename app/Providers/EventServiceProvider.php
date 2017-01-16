<?php

namespace Sisventas\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Sisventas\Events\SomeEvent' => [
            'Sisventas\Listeners\EventListener',
        ],

        /*'Sisventas\Events\IngresoInventario' => [
            //'Sisventas\Listeners\InterlocutorIngresoInventario',
            //'Sisventas\Listeners\ActualizarInventario@RegistroIngresoInventario',
        ],*/
        
        /*'Sisventas\Events\RegistroVenta' => [
            //'Sisventas\Listeners\InterlocutorRegistroVenta',
            //'Sisventas\Listeners\ActualizarInventario@RegistroEgresoInventario',

        ],*/
    ];


    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'Sisventas\Listeners\ActualizarInventario',
    ];
    
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
