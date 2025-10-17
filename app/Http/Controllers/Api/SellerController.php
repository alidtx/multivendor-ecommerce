<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Exception;

class SellerController extends Controller
{
    protected OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
        $this->middleware('auth:sanctum');
        $this->middleware('role:seller');
    }

    public function successfullOrderList(Request $request)
    {
        try {
            $sellerId = $request->user()->id;

            $orders = $this->service->getSellerSuccessfullOrder($sellerId);

            return response()->json([
                'success' => true,
                'data' => $orders
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch orders: ' . $e->getMessage(),
                'data' => null
            ], 422);
        }
    }

    public function unSuccessfullOrderList(Request $request)
    {
        try {
            $sellerId = $request->user()->id;

            $orders = $this->service->getSellerUnSuccessfullOrder($sellerId);

            return response()->json([
                'success' => true,
                'data' => $orders
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch orders: ' . $e->getMessage(),
                'data' => null
            ], 422);
        }
    }

    public function sellerBalance(Request $request): JsonResponse
    {
        try {
            $sellerId = $request->user()->id;
            $seller = $this->service->sellerCurrentBalance($sellerId);

            return response()->json([
                'success' => true,
                'data' => [
                    'name' => $seller->name,
                    'balance' => $seller->balance,
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch balance: ' . $e->getMessage(),
                'data' => null,
            ], 422);
        }
    }


}
