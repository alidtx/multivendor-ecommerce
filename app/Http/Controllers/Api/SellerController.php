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

    public function index(Request $request)
    {
        $sellerId = $request->user()->id;
        
    }
}
