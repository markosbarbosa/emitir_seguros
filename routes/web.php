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
Route::get('/produtos/pesquisa/{destination}/{begin_date}/{end_date}', 'ProductsController@index')->name('products.index');
Route::get('/produtos/{id}/{destination}/{begin_date}/{end_date}', 'ProductsController@show')->name('products.show');
Route::get('/pedidos/{id}/{destination}/{begin_date}/{end_date}', 'PurchasesController@create')->name('purchases.create');
Route::post('/pedidos', 'PurchasesController@store')->name('purchases.store');
Route::get('/pedidos/concluido', 'PurchasesController@end')->name('purchases.end');
