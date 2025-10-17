<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Exception;

class OrderController extends Controller
{
    protected OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;

    }

    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'buyer_id' => 'required|integer',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|integer',
                'items.*.quantity' => 'required|integer|min:1',
            ]);

            $order = $this->service->createOrder($data['buyer_id'], $data['items']);
            return response()->json([
                'success' => true,
                'message' => 'Order created successfully!',
                'data' => [
                    'order_id' => $order->id,
                    'total_amount' => $order->total_amount,
                    'status' => $order->status,
                    'created_at' => $order->created_at->toDateTimeString()
                ]
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order creation failed: ' . $e->getMessage(),
                'data' => null
            ], 422);
        }
    }

    public function buyerOrders(Request $request): JsonResponse
    {
        try {
            $buyerId = $request->user()->id;
            $orders = $this->service->currentBuyerOrderList($buyerId);

            return response()->json([
                'success' => true,
                'data' => $orders,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch orders: ' . $e->getMessage(),
                'data' => null,
            ], 422);
        }
    }

    public function buyerInvoices(Request $request): JsonResponse
{
    try {
        $buyerId = $request->user()->id;
        $invoices = $this->service->currentBuyerInvoices($buyerId);

        return response()->json([
            'success' => true,
            'data' => $invoices,
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch invoices: ' . $e->getMessage(),
            'data' => null,
        ], 422);
    }
}


}