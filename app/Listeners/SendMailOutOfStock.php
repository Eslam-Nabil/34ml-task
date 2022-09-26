<?php

namespace App\Listeners;

use App\Events\ProductOutOfStock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailOutOfStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductOutOfStock  $event
     * @return void
     */
    public function handle(ProductOutOfStock $event)
    {

    }
}
