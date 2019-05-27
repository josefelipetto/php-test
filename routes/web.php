<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/retailers',  'RetailersController@index');

Route::get('/retailers/{retailer}',  'RetailersController@show');

Route::post('/retailers', 'RetailersController@store');

Route::get('/create/retailers', 'RetailersController@create')->name('create-retailer');

Route::post('/retailers', 'RetailersController@store')->name('store-retailer');

Route::get('/edit/retailers/{retailer}', 'RetailersController@edit')->name('edit-retailer');

Route::put('/retailers/{retailer}', 'RetailersController@update')->name('update-retailer');


Route::get('/{products?}',  'ProductsController@index')->name('products');

Route::get('/products/{product}','ProductsController@show');

Route::put('/products/{product}', 'ProductsController@update')->name('update-product');

Route::post('/products/{product}/subscribe','SubscriptionController@store')->name('subscription');

Route::post('/products', 'ProductsController@store')->name('store-product');

Route::get('/create/products', 'ProductsController@create')->name('create-product');

Route::get('/edit/products/{product}', 'ProductsController@edit')->name('edit-product');



