<?php

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

Route::get('/products', 		     		'ProductController@index')->name('products');
Route::get('/products/data', 	     		'ProductController@data')->name('products.data');
Route::get('/products/add', 	     		'ProductController@add')->name('products.add');
Route::get('/products/edit/{id}',    		'ProductController@edit')->name('products.edit');
Route::get('/products/view/{id}',    		'ProductController@view')->name('products.view');
Route::post('/products/create',      		'ProductController@create')->name('products.create');
Route::put('/products/update',       		'ProductController@update')->name('products.update');
Route::post('/products/images/{id}', 		'ProductController@images')->name('products.images');
Route::get('/products/search/autocomplete', 'ProductController@autocomplete')->name("products.autocomplete");

///////////////////////////////////////////////////////////////////////////////////////
// STOCK
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/products/{id}/stock',         'StockController@index')->name('stock.index');
Route::get('/products/{id}/stock/data',    'StockController@data')->name('stock.data');
Route::get('/products/{id}/stock/add',     'StockController@add')->name('stock.add');
Route::post('/products/{id}/stock/create', 'StockController@create')->name('stock.create');

///////////////////////////////////////////////////////////////////////////////////////
// ORDERS
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/orders', 		     	  'OrderController@index')->name('orders');
Route::get('/orders/data/pending', 	  'OrderController@pending')->name('orders.pending');
Route::get('/orders/data/sold', 	  'OrderController@sold')->name('orders.sold');
Route::get('/orders/data/cancelled',  'OrderController@cancelled')->name('orders.cancelled');
Route::get('/orders/add', 	      	  'OrderController@add')->name('orders.add');
Route::get('/orders/view/{id}', 	  'OrderController@view')->name('orders.view');
Route::post('/orders/create',    	  'OrderController@create')->name('order.create');
Route::post('/orders/status/{id}',    'OrderController@status')->name('orders.status');

///////////////////////////////////////////////////////////////////////////////////////
// CLIENTS
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/clients/search/autocomplete', 'ClientController@autocomplete')->name("clients.autocomplete");

///////////////////////////////////////////////////////////////////////////////////////
// COSTS
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/costs', 				'CostController@index')->name('costs');
Route::get('/costs/data',    		'CostController@data')->name('costs.data');
Route::get('/costs/add',    		'CostController@add')->name('costs.add');
Route::get('/costs/view/{id}', 		'CostController@index')->name('costs.view');
Route::post('/costs/create',    	'CostController@create')->name('costs.create');

///////////////////////////////////////////////////////////////////////////////////////
// SUPPLIERS
///////////////////////////////////////////////////////////////////////////////////////

Route::get('/suppliers/search/autocomplete', 'CostController@autocomplete')->name('suppliers.autocomplete');
