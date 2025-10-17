<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
namespace App\Observers;


use App\Models\Order;
use Illuminate\Support\Str;


class OrderObserver
{
    
public function creating(Order $order)
{
// Assign unique order number before saving
$order->order_number = 'ORD-' . strtoupper(Str::random(10));
}


}