<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//ORDERS
Route::get('/v1/orders', [OrderController::class, 'index']);
//http://127.0.0.1:8000/api/v1/orders

Route::get('/v1/orders/{orderIdUser}', [OrderController::class, 'order_by_user_id']);
//http://127.0.0.1:8000/api/v1/orders/9

Route::get('/v1/orders-details', [OrderController::class, 'order_details']);
//http://127.0.0.1:8000/api/v1/orders-details

Route::get('/v1/orders', [OrderController::class, 'total_range']);
//http://127.0.0.1:8000/api/v1/orders?start_range=100&end_range=250

Route::get('/v1/orders-total-by-user/{idUser}', [OrderController::class, 'total_orders_by_user']);
//http://127.0.0.1:8000/api/v1/orders-total-by-user/9

Route::get('/v1/orders-by-desc', [OrderController::class, 'orders_with_user_info']);
//http://127.0.0.1:8000/api/v1/orders-by-desc

Route::get('/v1/orders-total', [OrderController::class, 'total_sum']);
//http://127.0.0.1:8000/api/v1/orders-total

Route::get('/v1/orders-cheapest', [OrderController::class, 'get_cheapest_order']);
//http://127.0.0.1:8000/api/v1/orders-cheapest

Route::get('/v1/orders-group', [OrderController::class, 'get_orders_grouped_by_user']);
//http://127.0.0.1:8000/api/v1/orders-group



//USUARIOS
Route::get('/v1/users', [UserController::class, 'index']);
//http://127.0.0.1:8000/api/v1/users

Route::get('/v1/users/{letter}', [UserController::class, 'users_by_initial']);
//http://127.0.0.1:8000/api/v1/users/r