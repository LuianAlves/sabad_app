<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ProductionOrderUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public string $action;

    /**
     * @param string $action Ex: created, separated, started, finished
     */
    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function broadcastOn(): Channel
    {
        // Canal único pra todo mundo ouvir
        return new Channel('production-orders');
    }

    // (opcional) nome do evento no front
    public function broadcastAs(): string
    {
        return 'ProductionOrderUpdated';
    }
}
