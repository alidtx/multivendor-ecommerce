<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17


namespace App\Events;


use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Order;


class OrderPlaced
{
use Dispatchable, InteractsWithSockets, SerializesModels;


public Order $order;


public function __construct(Order $order)
{
$this->order = $order;
}


}