<?php

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware' => 'auth'], function() {
    Route::get('/products', ['uses' =>'ProductController@index', 'as' => 'products.index']);
	Route::get('/products/create',['uses' =>'ProductController@create','as' => 'products.create']);
	Route::post('/products', ['uses' =>'ProductController@store', 'as' => 'products.store']);
	Route::get('/products/{product}','ProductController@show');
	Route::post('/products/{id}','ProductController@update');

	Route::get('/orders', ['uses'=>'OrderController@index','as' => 'orders.index']);
	Route::get('/orders/create', ['uses'=>'OrderController@create','as' => 'orders.create']);
	Route::get('/orders/{id}/edit', ['uses'=>'OrderController@edit','as' => 'orders.edit']);
	Route::get('/orders/nohp',['uses' => 'OrderController@nohp', 'as' => 'orders.nohp']);
	Route::get('/orders/namabarang',['uses'=>'OrderController@namabarang', 'as'=> 'orders.namabarang']);
	Route::post('/orders/store', ['uses' => 'OrderController@store', 'as' => 'orders.store']);
	Route::get('/orders/ordernumber','OrderController@orderNumber');
	//datatable
	Route::get('/orders/data',['uses'=>'OrderController@getMasterData', 'as' => 'orders.data']);
	Route::get('/orders/datadetail/{id}',['uses'=>'OrderController@getDetailsData', 'as' => 'orders.detail']);

	// user
	Route::get('/users',['uses'=>'UsersController@index','as' => 'users.index']);
	Route::get('/users/create',['uses'=>'UsersController@create','as' => 'users.create']);
	Route::get('/users/admin/{id}',['uses'=>'UsersController@admin', 'as' => 'users.admin']);
	Route::get('/users/not-admin/{id}',['uses'=>'UsersController@not_admin', 'as' => 'users.not_admin']);
	Route::post('/users/store',['uses'=>'UsersController@store','as' => 'users.store']);
});






