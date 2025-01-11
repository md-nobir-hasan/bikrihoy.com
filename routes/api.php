<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix('courier')->group(function () {
//     Route::post('order', 'CourierController@createOrder');
//     Route::post('bulk-order', 'CourierController@createBulkOrder');
//     Route::get('track/{type}/{id}', 'CourierController@trackOrder');
//     Route::get('balance', 'CourierController@getBalance');
// });

Route::get('/order/{order}/check-status', [OrderController::class, 'checkStatus']);
