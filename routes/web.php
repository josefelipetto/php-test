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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/retailers',  'RetailersController@index');
Route::get('/retailers/{retailer}',  'RetailersController@show');
Route::post('/retailers', 'RetailersController@store');

Route::get('/products',  'ProductsController@index')->name('products');
Route::get('/products/{product}','ProductsController@show');
Route::post('/products', 'ProductsController@store');
