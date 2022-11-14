<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1/')->group(function () {
    Route::get('test', function () {
        return response()->json(['geldi']);
    });

    Route::get('foods', [\App\Http\Controllers\Api\FoodController::class, 'index']);

    Route::get('tables', [\App\Http\Controllers\Api\TableController::class, 'index']);

    Route::get('details', [\App\Http\Controllers\Api\RestaurantController::class, 'index']);

    //orders
    Route::get('orders/table/{table}', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
//    Route::post('take-bill', [OrderController::class, 'takeBill']);
});
