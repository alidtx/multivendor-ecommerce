<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17


namespace App\Listeners;


use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AuditTrailListener implements ShouldQueue
{
    use InteractsWithQueue;


    public function handle(OrderPlaced $event)
    {
        $payload = [
            'order_id' => $event->order->id,
            'order_number' => $event->order->order_number,
            'buyer_id' => $event->order->buyer_id,
            'total' => $event->order->total_amount,
            'items' => $event->order->items->map(function ($i) {
                return [
                    'product_id' => $i->product_id,
                    'seller_id' => $i->seller_id,
                    'quantity' => $i->quantity,
                    'price' => $i->price,
                    'total' => $i->total,
                ];
            })->toArray(),
            'timestamp' => now()->toIso8601String(),
        ];

         Log::info('AuditTrail Payload:',$payload );
    }
}