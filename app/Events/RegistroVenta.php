<?php

namespace Sisventas\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RegistroVenta
{
    use InteractsWithSockets, SerializesModels;
    public $DetalleVenta;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($DetalleVenta)
    {
        $this->DetalleVenta = $DetalleVenta;
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