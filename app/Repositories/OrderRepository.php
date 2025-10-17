<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;


class OrderRepository
{
protected Order $model;


public function __construct(Order $order)
{
$this->model = $order;
}


public function create(array $data): Order
{
return $this->model->create($data);
}


public function createItem(array $data)
{
return \App\Models\OrderItem::create($data);
}


public function markInvoiced(Order $order): void
{
$order->update(['invoiced' => true]);
}
}