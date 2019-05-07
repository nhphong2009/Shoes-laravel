<?php

Auth::routes();

Route::get('/', 'IndexController@index')->name('index');

Route::get('/home', 'HomeController@index');

Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::post('/addcart', 'IndexController@addcart')->name('index.addcart');

Route::get('/removecart/{rowId}', 'IndexController@removeCart')->name('index.removeCart');

Route::get('/checkout', 'IndexController@cart')->name('index.cart');

Route::post('/checkout','IndexController@checkout')->name('index.checkout');

Route::get('product/get-size-by-color', 'IndexController@getSizeByColor');

Route::get('product/get-quantity-by-productDetail', 'IndexController@getQuantityByProductDetail');

Route::get('/product/{slug}', 'IndexController@getProductdetail')->name('index.getProductdetail');

Route::get('/brand/{slug}', 'IndexController@getBrand')->name('index.getBrand');

Route::get('/category/{slug}', 'IndexController@getCate')->name('index.getCate');

Route::get('/product', 'IndexController@getPro')->name('index.getPro');

Route::get('/changQuantity/{rowId}', 'IndexController@changQuantity')->name('index.changQuantity');

Route::post('/search', 'IndexController@searchPro')->name('index.searchPro');

Route::group(['prefix'=>'admin'],function(){
	Route::get('/', 'AdminController@index')->name('admin.dashboard');

	//login admin route
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

	//admin password reset route
	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

	//brands route
	Route::get('/get-list-brand', 'BrandController@getList')->name('brands.getList');
	Route::group(['prefix'=>'brand'],function(){
		Route::get('/', 'BrandController@index')->name('brands.index');
		
		Route::get('/create', 'BrandController@create')->name('brands.create');
		Route::post('/','BrandController@store')->name('brands.store');
		Route::get('/{id}','BrandController@show')->name('brands.show');
		Route::get('/{id}/edit', 'BrandController@edit')->name('brands.edit');
		Route::post('/{id}', 'BrandController@update')->name('brands.update');
		Route::delete('/{id}', 'BrandController@destroy')->name('brands.destroy');
	});

	//categories route
	Route::get('/get-list-category', 'CategoryController@getList')->name('categories.getList');
	Route::group(['prefix'=>'category'],function(){
		Route::get('/', 'CategoryController@index')->name('categories.index');
		
		Route::get('/create', 'CategoryController@create')->name('categories.create');
		Route::post('/','CategoryController@store')->name('categories.store');
		Route::get('/{id}','CategoryController@show')->name('categories.show');
		Route::get('/{id}/edit', 'CategoryController@edit')->name('categories.edit');
		Route::post('/{id}', 'CategoryController@update')->name('categories.update');
		Route::delete('/{id}', 'CategoryController@destroy')->name('categories.destroy');
	});

	//colors route
	Route::get('/get-list-color', 'ColorController@getList')->name('colors.getList');
	Route::group(['prefix'=>'color'],function(){
		Route::get('/', 'ColorController@index')->name('colors.index');
		
		Route::get('/create', 'ColorController@create')->name('colors.create');
		Route::post('/','ColorController@store')->name('colors.store');
		Route::get('/{id}','ColorController@show')->name('colors.show');
		Route::get('/{id}/edit', 'ColorController@edit')->name('colors.edit');
		Route::post('/{id}', 'ColorController@update')->name('colors.update');
		Route::delete('/{id}', 'ColorController@destroy')->name('colors.destroy');
	});

	//materials route
	Route::get('/get-list-material', 'MaterialController@getList')->name('materials.getList');
	Route::group(['prefix'=>'material'],function(){
		Route::get('/', 'MaterialController@index')->name('materials.index');
		
		Route::get('/create', 'MaterialController@create')->name('materials.create');
		Route::post('/','MaterialController@store')->name('materials.store');
		Route::get('/{id}','MaterialController@show')->name('materials.show');
		Route::get('/{id}/edit', 'MaterialController@edit')->name('materials.edit');
		Route::post('/{id}', 'MaterialController@update')->name('materials.update');
		Route::delete('/{id}', 'MaterialController@destroy')->name('materials.destroy');
	});

	//sizes route
	Route::get('/get-list-size', 'SizeController@getList')->name('sizes.getList');
	Route::group(['prefix'=>'size'],function(){
		Route::get('/', 'SizeController@index')->name('sizes.index');
		
		Route::get('/create', 'SizeController@create')->name('sizes.create');
		Route::post('/','SizeController@store')->name('sizes.store');
		Route::get('/{id}','SizeController@show')->name('sizes.show');
		Route::get('/{id}/edit', 'SizeController@edit')->name('sizes.edit');
		Route::post('/{id}', 'SizeController@update')->name('sizes.update');
		Route::delete('/{id}', 'SizeController@destroy')->name('sizes.destroy');
	});

	//styles route
	Route::get('/get-list-style', 'StyleController@getList')->name('styles.getList');
	Route::group(['prefix'=>'style'],function(){
		Route::get('/', 'StyleController@index')->name('styles.index');
		
		Route::get('/create', 'StyleController@create')->name('styles.create');
		Route::post('/','StyleController@store')->name('styles.store');
		Route::get('/{id}','StyleController@show')->name('styles.show');
		Route::get('/{id}/edit', 'StyleController@edit')->name('styles.edit');
		Route::post('/{id}', 'StyleController@update')->name('styles.update');
		Route::delete('/{id}', 'StyleController@destroy')->name('styles.destroy');
	});

	//Product images route
	Route::get('/get-list-productimage', 'ProductimagesController@getList')->name('productimages.getList');
	Route::group(['prefix'=>'productimage'],function(){
		Route::get('/', 'ProductimagesController@index')->name('productimages.index');
		
		Route::get('/create', 'ProductimagesController@create')->name('productimages.create');
		Route::post('/','ProductimagesController@store')->name('productimages.store');
		Route::get('/{id}','ProductimagesController@show')->name('productimages.show');
		Route::get('/{id}/edit', 'ProductimagesController@edit')->name('productimages.edit');
		Route::post('/{id}', 'ProductimagesController@update')->name('productimages.update');
		Route::delete('/{id}', 'ProductimagesController@destroy')->name('productimages.destroy');
	});

	//Product details route
	Route::get('/get-list-productdetail', 'ProductdetailsController@getList')->name('productdetails.getList');
	Route::group(['prefix'=>'productdetail'],function(){
		Route::get('/', 'ProductdetailsController@index')->name('productdetails.index');
		
		Route::get('/create', 'ProductdetailsController@create')->name('productdetails.create');
		Route::post('/','ProductdetailsController@store')->name('productdetails.store');
		Route::get('/{id}','ProductdetailsController@show')->name('productdetails.show');
		Route::get('/{id}/edit', 'ProductdetailsController@edit')->name('productdetails.edit');
		Route::post('/{id}', 'ProductdetailsController@update')->name('productdetails.update');
		Route::delete('/{id}', 'ProductdetailsController@destroy')->name('productdetails.destroy');
	});

	//Products route
	Route::get('/get-list-product', 'ProductController@getList')->name('products.getList');
	Route::group(['prefix'=>'product'],function(){
		Route::get('/', 'ProductController@index')->name('products.index');
		
		Route::get('/create', 'ProductController@create')->name('products.create');
		Route::post('/','ProductController@store')->name('products.store');
		Route::get('/{id}','ProductController@show')->name('products.show');
		Route::get('/{id}/edit', 'ProductController@edit')->name('products.edit');
		Route::post('/{id}', 'ProductController@update')->name('products.update');
		Route::delete('/{id}', 'ProductController@destroy')->name('products.destroy');
	});

	//Order details route
	Route::get('/get-list-orderdetail', 'OrderdetailsController@getList')->name('orderdetails.getList');
	Route::group(['prefix'=>'orderdetail'],function(){
		

		Route::get('/', 'OrderdetailsController@index')->name('orderdetails.index');
		
		Route::get('/create', 'OrderdetailsController@create')->name('orderdetails.create');
		Route::post('/','OrderdetailsController@store')->name('orderdetails.store');
		Route::get('/{id}','OrderdetailsController@show')->name('orderdetails.show');
		Route::get('/{id}/edit', 'OrderdetailsController@edit')->name('orderdetails.edit');
		Route::post('/{id}', 'OrderdetailsController@update')->name('orderdetails.update');
		Route::delete('/{id}', 'OrderdetailsController@destroy')->name('orderdetails.destroy');
	});

	//Orders route
	Route::get('/get-list-order', 'OrderController@getList')->name('orders.getList');
	Route::group(['prefix'=>'order'],function(){

		Route::get('/', 'OrderController@index')->name('orders.index');
		
		Route::get('/create', 'OrderController@create')->name('orders.create');

		Route::post('/','OrderController@store')->name('orders.store');
		Route::get('/{id}','OrderController@show')->name('orders.show');
		Route::get('/{id}/edit', 'OrderController@edit')->name('orders.edit');
		Route::post('/{id}', 'OrderController@update')->name('orders.update');
		Route::post('/check/{id}', 'OrderController@checkApplyOrder')->name('orders.checkApplyOrder');
		Route::delete('/check/{id}', 'OrderController@checkCancelOrder')->name('orders.checkCancelOrder');
		Route::delete('/{id}', 'OrderController@destroy')->name('orders.destroy');
	});
});


