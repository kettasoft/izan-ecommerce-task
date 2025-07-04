<?php

namespace Modules\Orders\Observers;

use Modules\Orders\Events\OrderCreated;
use Modules\Orders\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        event(new OrderCreated($order));
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void {}

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void {}

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void {}

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void {}
}
