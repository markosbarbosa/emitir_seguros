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

Route::get('/', 'SegurosController@index')->name('seguros.index');
Route::get('/products/pesquisa/{destination}/{begin_date}/{end_date}', 'SegurosController@products')->name('seguros.products');
Route::get('/product/{id}/', 'SegurosController@productShow')->name('seguros.product.show');
