<?php

namespace Sisventas\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class IngresoInventario
{
    use InteractsWithSockets, SerializesModels;
    
    public $DetalleIngreso;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($DetalleIngreso)
    {
        $this->DetalleIngreso = $DetalleIngreso;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
