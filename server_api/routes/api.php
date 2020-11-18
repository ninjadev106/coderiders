<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BoxController;
use App\Http\Controllers\API\BenefitController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'API'], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);

    Route::get('boxes', [BoxController::class, 'index']);
    Route::post('boxes', [BoxController::class, 'store']);
    Route::post('boxes/custom', [BoxController::class, 'custom']);

    Route::get('benefits', [BenefitController::class, 'index']);
    Route::get('products', [ProductController::class, 'index']);

});
