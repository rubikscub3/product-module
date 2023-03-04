<?php

use Illuminate\Support\Facades\Route;

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

// Product list with filtering and pagination
Route::get('/products', 'ProductController@index');

// Add a new product
Route::post('/products', 'ProductController@store');

// Show a product
Route::get('/products/{id}', 'ProductController@show');

// Update a product
Route::put('/products/{id}', 'ProductController@update');

// Delete a product
Route::delete('/products/{id}', 'ProductController@destroy');
