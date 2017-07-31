<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::pattern('id','[0-9]+');

Route::get('/', 'StoreController@index');
Route::get('/home', 'StoreController@index');
Route::get('/customer/about_us','StoreController@about_us');
Route::get('/customer/contact','StoreController@contact');

Route::get('/category/{id}', ['as' => 'store.category', 'uses' => 'StoreController@category']);
Route::post('/search', ['as' => 'store.search', 'uses' => 'StoreController@search']);
Route::get('/tag/{id}', ['as' => 'store.tag', 'uses' => 'StoreController@tag']);
Route::get('/product/{id}', ['as' => 'store.product', 'uses' => 'StoreController@product']);
Route::get('/cart', ['as' => 'cart', 'uses' => 'CartController@index']);
Route::get('/cart/add/{id}', ['as' => 'cart.add', 'uses' => 'CartController@add']);
Route::get('/cart/destroy/{id}', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);
Route::post('cart/update/', ['as' => 'cart.update', 'uses' => 'CartController@update']);


Route::group(['middleware'=>'auth'], function() {
	Route::group(['prefix'=>'checkout'], function() {
		Route::get('placeOrder', ['as' => 'checkout.place', 'uses' => 'CheckoutController@place']);
		Route::get('payredirect/{transaction_id?}', ['as' => 'checkout.payredirect', 'uses' => 'CheckoutController@payredirect']);
	});
	Route::get('account/orders', ['as' => 'account.orders', 'uses' => 'AccountController@orders']);
});

Route::post('checkout/changestatus', ['as' => 'checkout.changestatus', 'uses' => 'CheckoutController@changestatus']);

Route::group(['prefix'=>'admin', 'middleware'=>['auth','isadmin']], function() {

	Route::group(['prefix'=>'categories'], function() {
		Route::get('/{id?}', ['as' => 'categories', 'uses' => 'AdminCategoriesController@index']);
		Route::get('/create', ['as' => 'categories.create', 'uses' => 'AdminCategoriesController@create']);
		Route::post('/store', ['as' => 'categories.store', 'uses' => 'AdminCategoriesController@store']);
		Route::put('/{id}', ['as' => 'categories.put', 'uses' => 'AdminCategoriesController@index']);
		Route::get('/{id}/destroy', ['as' => 'categories.destroy', 'uses' => 'AdminCategoriesController@destroy']);
		Route::get('/{id}/edit', ['as' => 'categories.edit', 'uses' => 'AdminCategoriesController@edit']);
		Route::put('/{id}/update', ['as' => 'categories.update', 'uses' => 'AdminCategoriesController@update']);
	});

	Route::group(['prefix'=>'products'], function() {
		Route::get('/{id?}', ['as' => 'products', 'uses' => 'AdminProductsController@index']);
		Route::get('/create', ['as' => 'products.create', 'uses' => 'AdminProductsController@create']);
		Route::post('/', ['as' => 'products.store', 'uses' => 'AdminProductsController@store']);
		Route::put('/{id}', ['as' => 'products.put', 'uses' => 'AdminProductsController@index']);
		Route::get('/{id}/destroy', ['as' => 'products.destroy', 'uses' => 'AdminProductsController@destroy']);
		Route::get('/{id}/edit', ['as' => 'products.edit', 'uses' => 'AdminProductsController@edit']);
		Route::put('/{id}/update', ['as' => 'products.update', 'uses' => 'AdminProductsController@update']);

		Route::group(['prefix'=>'images'], function() {
			Route::get('/{id}/product', ['as' => 'products.images', 'uses' => 'AdminProductsController@images']);
			Route::get('create/{id}/product', ['as' => 'products.images.create', 'uses' => 'AdminProductsController@createImage']);
			Route::post('store/{id}/product', ['as' => 'products.images.store', 'uses' => 'AdminProductsController@storeImage']);
			Route::get('destroy/{id}/product', ['as' => 'products.images.destroy', 'uses' => 'AdminProductsController@destroyImage']);
		});

	});

	Route::group(['prefix'=>'orders'], function() {
		Route::get('/', ['as' => 'orders', 'uses' => 'AdminOrdersController@index']);
		Route::get('/{id}/edit', ['as' => 'orders.edit', 'uses' => 'AdminOrdersController@edit']);
		Route::put('/{id}/update', ['as' => 'orders.update', 'uses' => 'AdminOrdersController@update']);
	});

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
