<?php

namespace App\Events;

use App\Models\RegisterUser;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $registerUser;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RegisterUser $registerUser)
    {
        $this->registerUser = $registerUser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.registered.1');
    }

    public function broadcastAs()
    {
        return 'user.registered.1';
    }

    public function broadcastWith()
    {
        return [
            'user' => [
                'name' => $this->registerUser->user->name,
                'email' => $this->registerUser->user->email,
                'phone' => $this->registerUser->user->phone,
                'dni' => $this->registerUser->user->dni,
                'cantidad' => $this->registerUser->tickets,
            ]
        ];
    }
}
