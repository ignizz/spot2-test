<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->get('/test', [SpotController::class, "test"]);

Route::get('/price-m2/zip-codes/{zipCode}/aggregate/{aggregate}', [SpotController::class, "priceM2"]);

// price-m2/zip-codes/{zip_code}/aggregate/{aggregate}?construction_type={construction_type}