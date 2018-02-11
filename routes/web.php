<?php


Auth::routes();
Route::get('/', 'HomeController@index')->name('dashboard');
//Route::get('/home', 'HomeController@index')->name('dashboard');

Route::group(['prefix' => 'admin','middleware' => 'auth'], function() {
    Route::get('/products', ['uses' =>'ProductController@index', 'as' => 'products.index']);
	Route::get('/products/create',['uses' =>'ProductController@create','as' => 'products.create']);
	Route::post('/products', ['uses' =>'ProductController@store', 'as' => 'products.store']);
	Route::get('/products/{product}','ProductController@show');
	Route::post('/products/{id}','ProductController@update');

	Route::get('/orders', ['uses'=>'OrderController@index','as' => 'orders.index']);
	Route::get('/orders/create', ['uses'=>'OrderController@create','as' => 'orders.create']);
	Route::get('/orders/{id}/edit', ['uses'=>'OrderController@edit','as' => 'orders.edit']);
	Route::get('/orders/{id}/bayar', ['uses'=>'OrderController@bayar','as' => 'orders.bayar']);
	Route::get('/orders/printbayar/{id}', ['uses'=>'OrderController@printbayar','as' => 'orders.printbayar']);


	Route::get('/orders/nohp',['uses' => 'OrderController@nohp', 'as' => 'orders.nohp']);
	Route::get('/orders/namabarang',['uses'=>'OrderController@namabarang', 'as'=> 'orders.namabarang']);
	Route::post('/orders/store', ['uses' => 'OrderController@store', 'as' => 'orders.store']);
	Route::patch('/orders/update/{id}', ['uses' => 'OrderController@update', 'as' => 'orders.update']);
	Route::patch('/orders/updatebayar/{id}', ['uses' => 'OrderController@updatebayar', 'as' => 'orders.updatebayar']);
	Route::post('/orders/updateorder/{id}', ['uses' => 'OrderController@updateOrder', 'as' => 'orders.updateorder']);
	Route::get('/orders/ordernumber','OrderController@orderNumber');
	Route::post('/orders/tambah/{idProduk}',['uses'=>'OrderController@tambahProduk', 'as' => 'orders.tambahproduk']);
	Route::delete('/orders/{id}',['uses' => 'OrderController@destroy', 'as' => 'orders.destroy']);

	//delete produk order detail
	//Route::delete('ordersdetail/produk/{idproduk}', ['uses'=>'OrderController@hapusProduk', 'as'=>'ordersdetail.hapus']);
	Route::delete('orders/{id}/produk/{idproduk}', ['uses'=>'OrderController@hapusProduk', 'as'=>'ordersdetail.hapus']);
	//datatable
	Route::get('/orders/data',['uses'=>'OrderController@getMasterData', 'as' => 'orders.data']);
	Route::get('/orders/datadetail/{id}',['uses'=>'OrderController@getDetailsData', 'as' => 'orders.detail']);

	// user
	// Route::get('/users',['uses'=>'UsersController@index','as' => 'users.index']);
	// Route::get('/users/create',['uses'=>'UsersController@create','as' => 'users.create']);
	// Route::get('/users/admin/{id}',['uses'=>'UsersController@admin', 'as' => 'users.admin']);
	// Route::get('/users/not-admin/{id}',['uses'=>'UsersController@not_admin', 'as' => 'users.not_admin']);
	// Route::post('/users/store',['uses'=>'UsersController@store','as' => 'users.store']);
	// Route::get('/users/changepassword',['uses'=>'UsersController@showChangePasswordForm', 'as' => 'users.edit']);
	// Route::post('/users/changePassword','UsersController@changePassword')->name('changePassword');



	//Report 
	Route::get('report/stok',['uses'=>'ReportController@stok', 'as'=>'report.stok']);
	Route::resource('report', 'ReportController');
	Route::post('report/gettanggal',['uses'=>'ReportController@getTanggal','as'=>'report.tanggal']);
	Route::post('report/pdf',['uses'=>'ReportController@getPdf','as'=>'report.pdf']);


	Route::resource('produk', 'Admin\\ProdukController');

	Route::resource('users', 'UsersController');

	Route::resource('roles', 'RoleController');

	Route::resource('permissions', 'PermissionController');

});

Route::resource('admin/customer', 'Admin\\CustomerController');
