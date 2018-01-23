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

///////////////////////////////////////////////////////////////////////////////////////
// HOME
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

///////////////////////////////////////////////////////////////////////////////////////
// PRODUCTS
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/products', 		     'ProductController@index')->name('products');
Route::get('/products/data', 	     'ProductController@data')->name('products.data');
Route::get('/products/add', 	     'ProductController@add')->name('products.add');
Route::get('/products/edit/{id}',    'ProductController@edit')->name('products.edit');
Route::get('/products/view/{id}',    'ProductController@view')->name('products.view');
Route::post('/products/create',      'ProductController@create')->name('products.create');
Route::put('/products/update',       'ProductController@update')->name('products.update');
Route::post('/products/images/{id}', 'ProductController@images')->name('products.images');

///////////////////////////////////////////////////////////////////////////////////////
// STOCK
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/products/{id}/stock',        'StockController@index')->name('stock.index');
Route::get('/products/{id}/stock/data',   'StockController@data')->name('stock.data');
Route::get('/products/{id}/stock/add',    'StockController@add')->name('stock.add');
Route::post('/products/{id}/stock/create', 'StockController@create')->name('stock.create');


///////////////////////////////////////////////////////////////////////////////////////
// SALES
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/sales', 'SaleController@index')->name('sales');

///////////////////////////////////////////////////////////////////////////////////////
// COSTS
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/costs', 'CostController@index')->name('costs');
