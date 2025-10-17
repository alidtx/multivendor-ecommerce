<?php 



use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin', [AuthController::class, 'admin']);
});

Route::middleware(['auth:sanctum', 'role:seller'])->group(function () {
    Route::get('/seller', [AuthController::class, 'seller']);
});

Route::middleware(['auth:sanctum', 'role:buyer'])->group(function () {
    Route::get('/buyer', [AuthController::class, 'buyer']);
});


