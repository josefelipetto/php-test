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


Route::get('/retailers',  'API\RetailersController@index');

Route::get('/retailers/{retailer}',  'API\RetailersController@show');

Route::post('/retailers', 'API\RetailersController@store');

Route::post('/retailers', 'API\RetailersController@store');

Route::put('/retailers/{retailer}', 'API\RetailersController@update');


Route::get('/{products?}',  'API\ProductsController@index');

Route::get('/products/{product}','API\ProductsController@show');

Route::put('/products/{product}', 'API\ProductsController@update');

Route::post('/products', 'API\ProductsController@store');