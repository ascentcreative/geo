<?php

namespace AscentCreative\Geo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddressSavedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
     
    }

    /**
   
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event) {
        
       dd($event);

    }
}
