<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17

namespace App\Services;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class OrderService
{
    protected OrderRepository $orders;
    protected ProductRepository $products;

    public function __construct(OrderRepository $orders, ProductRepository $products)
    {
        $this->orders = $orders;
        $this->products = $products;
    }


    public function createOrder(int $buyerId, array $items): Order
    {

        return DB::transaction(function () use ($buyerId, $items) {

            $order = $this->orders->create([
                'buyer_id' => $buyerId,
                'status' => 'pending',
                'total_amount' => 0,
            ]);

            $total = 0;

            foreach ($items as $item) {
                $productId = (int) ($item['product_id'] ?? 0);
                $qty = (int) ($item['quantity'] ?? 0);

                if ($productId <= 0 || $qty <= 0) {
                    throw new Exception("Invalid item payload (product_id or quantity).");
                }


                $product = $this->products->findForUpdate($productId);

                // dd($product);

                if (!$product) {
                    throw new Exception("Product not found: {$productId}");
                }

                if ($product->stock_quantity < $qty) {
                    throw new Exception("Insufficient stock for product {$productId}");
                }

                $lineTotal = $product->price * $qty;


                $this->orders->createItem([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'seller_id' => $product->seller_id,
                    'quantity' => $qty,
                    'price' => $product->price,
                ]);

                $this->products->reduceStock($product, $qty);

                $total += $lineTotal;
            }


            $order->update([
                'total_amount' => $total,
                'status' => 'paid',
            ]);
            DB::afterCommit(function () use ($order) {
                Event::dispatch(new OrderPlaced($order));
            });

            return $order;
        });
    }

    public function getSellerSuccessfullOrder(int $sellerId)
    {
        return \App\Models\Order::whereHas('items', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
            $query->where('status', 'paid');
        })->with('items')->get();
    }

      public function getSellerUnSuccessfullOrder(int $sellerId)
    {
        return \App\Models\Order::whereHas('items', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
            $query->whereNot('status', 'paid');
        })->with('items')->get();
    }

    public function sellerCurrentBalance(int $sellerId)
    {
        $seller = \App\Models\User::where('role', 'seller')
            ->where('id', $sellerId)
            ->first(['balance', 'name']);

        if (!$seller) {
            throw new \Exception("Seller not found (ID: {$sellerId})");
        }

        return $seller; 
    }


}
