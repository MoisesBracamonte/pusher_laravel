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
    public $messages;
    public function __construct($message)
    {
        $this->messages = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('example');
    }
}
