<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SellerController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role:admin')->group(function () {
        //All the Admin Route will go here
    });

    Route::middleware('role:buyer')->group(function () {
        Route::post('buyer/orders', [OrderController::class, 'store']);
        Route::get('buyer/orders/list', [OrderController::class, 'buyerOrders']);
        Route::get('buyer/orders/invoices', [OrderController::class, 'buyerInvoices']);
    });

    Route::middleware('role:seller')->group(function () {
        Route::get('/seller/orders/successful', [SellerController::class, 'successfullOrderList']);
        Route::get('/seller/orders/unsuccessful', [SellerController::class, 'unSuccessfullOrderList']); 
        Route::get('/seller/orders/balance', [SellerController::class, 'sellerBalance']); 
    });

});



