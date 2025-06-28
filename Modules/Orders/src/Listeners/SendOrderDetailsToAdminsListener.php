<?php

namespace Modules\Orders\Listeners;

use Modules\Orders\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Orders\Jobs\NotifyAdminWithNewOrderJob;

class SendOrderDetailsToAdminsListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        NotifyAdminWithNewOrderJob::dispatch($event->order);
    }
}
