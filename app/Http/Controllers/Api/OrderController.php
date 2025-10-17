<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;


class OrderController extends Controller
{
    protected OrderService $service;


    public function __construct(OrderService $service)
    {
        $this->service = $service;
        // $this->middleware('auth:sanctum');
    }


    public function store(Request $request): JsonResponse
    {

        $data = $request->validate([
            'buyer_id' => 'required|integer',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
         
        $order = $this->service->createOrder($data['buyer_id'], $data['items']);


        return response()->json(['order_id' => $order->id], 201);
    }

}