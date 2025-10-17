<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\Order;
use App\Observers\OrderObserver;

class EventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Order::observe(OrderObserver::class);
    }
}
