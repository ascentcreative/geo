<?php

namespace AscentCreative\Geo\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Triggered whenever the Basket model is updated (add / remove items, coupon codes, shipping details etc)
 */
class AddressSaved {
    
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $address;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\AscentCreative\Geo\Models\Address $address)
    {
        $this->address = $address;
    }

}
