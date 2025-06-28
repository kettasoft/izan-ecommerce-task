<?php

namespace Modules\Orders\Jobs;

use Illuminate\Bus\Queueable;
use Modules\Users\Models\Admin;
use Modules\Orders\Models\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Orders\Notifications\OrderCreatedNotification;

class NotifyAdminWithNewOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Order $order) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach (Admin::cursor() as $admin) {
            $admin->notify(new OrderCreatedNotification($this->order));
        }
    }
}
