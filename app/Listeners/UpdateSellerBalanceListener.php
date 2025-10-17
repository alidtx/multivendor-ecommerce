<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17


namespace App\Listeners;


use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateSellerBalanceListener implements ShouldQueue
{
    use InteractsWithQueue;


    public $tries = 3;


    public function handle(OrderPlaced $event)
    {
        foreach ($event->order->items as $item) {
            $seller = $item->seller;
            $amount = $event->order->total_amount;  
            $seller->increment('balance', $amount);
        }
    }

}