<?php

use App\Models\Watchlist;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//UserController
Route::post(
    'login',
    'App\Http\Controllers\UserController@login'
);
Route::post(
    'register',
    'App\Http\Controllers\UserController@register'
);

//ProductController
Route::get(
    '/products',
    'App\Http\Controllers\ProductController@index'
);
Route::get(
    '/availableProducts',
    'App\Http\Controllers\ProductController@userIndex'
);
Route::get(
    '/products/{product}',
    'App\Http\Controllers\ProductController@show'
);
Route::get(
    '/adminproducts',
    'App\Http\Controllers\ProductController@adminIndex'
);
Route::post(
    '/upload-file',
    'App\Http\Controllers\ProductController@uploadFile'
);

//WatchlistController
Route::resource(
    '/watchlists',
    'App\Http\Controllers\WatchlistController'
);

//GroupbuyController
Route::get(
    '/activeGroupbuys',
    'App\Http\Controllers\GroupbuyController@userIndex'
);
Route::get(
    '/admingroupbuys',
    'App\Http\Controllers\GroupbuyController@adminIndex'
);
Route::post(
    '/groupbuys/join',
    'App\Http\Controllers\GroupbuyController@store'
);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users', 'App\Http\Controllers\UserController@index');
    Route::get('users/{user}', 'App\Http\Controllers\UserController@show');
    Route::patch('users/{user}', 'App\Http\Controllers\UserController@update');
    Route::get('users/{user}/orders', 'App\Http\Controllers\UserController@showOrders');
    Route::patch('products/{product}/minmax/change', 'App\Http\Controllers\ProductController@updateMinMax');
    Route::patch('orders/{order}/deliver', 'App\Http\Controllers\OrderController@deliverOrder');
    Route::resource('/orders', 'App\Http\Controllers\OrderController');
    Route::resource('/products', 'App\Http\Controllers\ProductController')->except(['index', 'show']);
});
