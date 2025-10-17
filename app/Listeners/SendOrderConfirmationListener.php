<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17


namespace App\Listeners;


use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;


class SendOrderConfirmationListener implements ShouldQueue
{
use InteractsWithQueue;


public $tries = 3;


public function handle(OrderPlaced $event)
{
// Simulate sending email by writing to log
Log::info('Simulated Email: Order confirmation sent for order ' . $event->order->id);
}

}