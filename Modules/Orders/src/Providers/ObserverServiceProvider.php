<?php

namespace Modules\Orders\Providers;

use Modules\Orders\Models\Order;
use Illuminate\Support\ServiceProvider;
use Modules\Orders\Observers\OrderObserver;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void {}

    public function boot()
    {
        Order::observe(OrderObserver::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
