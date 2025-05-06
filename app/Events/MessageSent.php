<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets; // <-- Import correct
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets; // <-- Traits corrects

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
        

    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.'.$this->message->to_id);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->load('from')
        ];
    }
}