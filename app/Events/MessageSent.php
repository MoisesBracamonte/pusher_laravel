<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel; // Canal público
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel; // Canal privado
use Illuminate\Broadcasting\PresenceChannel; // Canal privado
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        /*
            * De esta forma llegan las peticiones a todos los usuarios 
            * return new Channel('example');
        */
        /* De esta otra cada usuario tendra un canal especifico de modo que le llegaran unicamente los mensajes que son enviado a travez de su canal*/
        return new PrivateChannel('users.'.$this->message->to_id);
    }
}
