<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/create', [OrderController::class, 'create']);
Route::get('/order', [OrderController::class, 'store']);
Route::delete('/order/destroy/{id}', [OrderController::class, 'destroy']);
Route::get('/order/edit/{id}', [OrderController::class, 'edit']);
Route::put('/order/update/{id}', [OrderController::class, 'update']);
Route::get('orders/export/', [OrderController::class, 'export']);
Route::get('orders/maps/', [OrderController::class, 'maps']);