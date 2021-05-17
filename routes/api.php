<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Models\Order;
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
Route::get('users/{user}/orders', 'App\Http\Controllers\UserController@showOrders');

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
    '/groupbuys/active',
    'App\Http\Controllers\GroupbuyController@indexUser'
);
Route::get(
    '/groupbuys/joined',
    'App\Http\Controllers\GroupbuyController@indexUserJoined'
);
Route::get(
    '/groupbuys/pendingpay',
    'App\Http\Controllers\GroupbuyController@indexPendingPay'
);

Route::post(
    '/groupbuys/join',
    'App\Http\Controllers\GroupbuyController@store'
);
Route::put(
    '/groupbuys/{groupbuy}/updateStatus',
    'App\Http\Controllers\GroupbuyController@updateStatus'
);

//Notification
Route::get(
    'noti/yours',
    'App\Http\Controllers\NotificationController@indexUser'
);
Route::post('noti/read', 'App\Http\Controllers\NotificationController@read');

//Order
Route::get('/orders/topay', [OrderController::class, 'indexForPayment']);

//Payment
Route::get('/pay/get', [PaymentController::class, 'index']);
Route::post('/pay/transaction', [PaymentController::class, 'makeStripePayment'])->name('make-payment');

//ADMIN
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users', 'App\Http\Controllers\UserController@index');
    Route::get('users/{user}', 'App\Http\Controllers\UserController@show');
    Route::patch('users/{user}', 'App\Http\Controllers\UserController@update');
    Route::patch('products/{product}/minmax/change', 'App\Http\Controllers\ProductController@updateMinMax');
    Route::patch('orders/{order}/deliver', 'App\Http\Controllers\OrderController@deliverOrder');
    Route::resource('/orders', 'App\Http\Controllers\OrderController');
    Route::resource('/products', 'App\Http\Controllers\ProductController')->except(['index', 'show']);

    Route::get(
        '/admingroupbuys',
        'App\Http\Controllers\GroupbuyController@indexAdmin'
    );
    
});
