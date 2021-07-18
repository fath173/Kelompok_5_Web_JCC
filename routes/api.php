<?php

use App\Http\Controllers\Api\Auth\Account;
use App\Http\Controllers\Api\Auth\login;
use App\Http\Controllers\Api\Auth\register;
use App\Http\Controllers\Api\Checkout\Checkout;
use App\Http\Controllers\Api\Ongkir\DataOngkir;
use App\Http\Controllers\Api\Orders\Orders;
use App\Http\Controllers\Api\Products\Product as allProduct;
use App\Http\Controllers\Api\Testimonial\Testimoni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;



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

// Route::middleware('auth:api')->get('/user', function (Request $request) {return $request->user();});

Route::get('/products', [allProduct::class, 'index']);
Route::get('/products/{id}', [allProduct::class, 'detailProduct']);
Route::post('/login', [login::class, 'login']);
Route::post('/register', [register::class, 'register']);
Route::get('/testimonials', [Testimoni::class, 'index']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [login::class, 'logout']);

    Route::get('/account/{id}', [Account::class, 'index']);
    Route::put('/account/{id}/bio', [Account::class, 'updateBio']);
    Route::post('/account/{id}/photo', [Account::class, 'updatePhoto']);

    Route::get('/orders/{id}', [Orders::class, 'index']);
    Route::get('/orders/{id}/detail', [Orders::class, 'detailOrders']);
    Route::post('/orders/{id}/payment', [Orders::class, 'payment']);
    Route::put('/orders/{id}/cancel', [Orders::class, 'cancelOrder']);
    Route::put('/orders/{id}/confirm', [Orders::class, 'confirmOrder']);
    Route::put('/orders/{id}/up-testi', [Orders::class, 'updateTesti']);

    Route::post('/ongkir', [DataOngkir::class, 'dataOngkir']);
    Route::post('/checkout', [Checkout::class, 'inputOrders']);
});
