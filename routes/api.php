<?php

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

Route::post('/formvalidation', 'Api\CheckValidation')->withoutMiddleware('throttle');
Route::get('/item/{id}', 'Api\Item')->name('api.item.show');

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    Route::post('/auth/login', 'Api\Auth\Login@login')->name('auth.login');
    Route::group(['middleware' => [ 'auth:api' ]], function () {
        Route::get('/auth/profile', 'Api\Auth\Profile@get')->name('auth.profile');
        Route::resource('/selling', 'Api\Selling');
    });
});
