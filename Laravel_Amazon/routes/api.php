<?php

use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::get('user/{user}', 'show');
    Route::get('user/{user}/subscription', 'show_subscription');
    Route::get('user/{user}/pedidos', 'show_pedidos');
});

Route::controller(SubscriptionController::class)->group(function() {
    Route::post('subscription', 'store');
    Route::get('subscription/{subscription}', 'show');
    Route::get('subscription/{subscription}/user', 'show_user');
});

Route::controller(PedidosController::class)->group(function () {
    Route::get('pedido/{pedido}', 'listPedidos');
    Route::post('pedido', 'store');
    Route::get('pedido/{pedido}/user', 'show_user');
    Route::post('pedido/{pedido}/producto/{producto}/book', 'añadirProducto');
    Route::get('pedido/{pedido}/productos', 'listProductos');
});

Route::controller(ProductoController::class)->group(function () {
    Route::post('producto', 'store');
    Route::get('producto/{producto}', 'show');
    Route::get('producto/{producto}/pedidos', 'listPedidos');
});
