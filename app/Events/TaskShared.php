<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskShared implements ShouldBroadcast
{
    public function __construct(public $taskId, public $userId, public $role) {

    }

    public function broadcastOn() {
        return new PrivateChannel("user.$this->userId");
    }

    public function broadcastWith() {
        return ['task_id'=>$this->taskId,'role'=>$this->role];
    }
}
