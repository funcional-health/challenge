<?php

use Illuminate\Http\Request;

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

Route::resource('industries', 'Api\IndustriesController');

Route::get('industries/restore/{id}', 'Api\IndustriesController@restore');

Route::resource('products', 'Api\ProductsController');

Route::get('products/restore/{id}', 'Api\ProductsController@restore');
