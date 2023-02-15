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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => ['auth','isAdmin'],'prefix' => 'admin'], function () {

	
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

	//category
	Route::get('category', ['as' => 'category.view', 'uses' => 'App\Http\Controllers\PcategoryController@show']);
	Route::post('category', ['as' => 'category.store', 'uses' => 'App\Http\Controllers\PcategoryController@store']);
	Route::get('category/delete/{id}', ['as' => 'category.delete', 'uses' => 'App\Http\Controllers\PcategoryController@delete']);

	//product
	Route::get('product', ['as' => 'product.view', 'uses' => 'App\Http\Controllers\ProductsController@index']);
	Route::get('product/{id}', ['as' => 'product.show', 'uses' => 'App\Http\Controllers\ProductsController@show']);
	Route::POST('product', ['as' => 'product.store', 'uses' => 'App\Http\Controllers\ProductsController@store']);
	Route::POST('product/update/{id}', ['as' => 'product.update', 'uses' => 'App\Http\Controllers\ProductsController@update']);
	Route::POST('product/image/{id}', ['as' => 'product.addImage', 'uses' => 'App\Http\Controllers\ProductsController@addImage']);
	Route::get('product/thumbnail/{image}/{id}', ['as' => 'product.setThumbnail', 'uses' => 'App\Http\Controllers\ProductsController@setThumbnail']);
	//transaction
	Route::get('orders', ['as' => 'pending.order', 'uses' => 'App\Http\Controllers\TransactionController@pendingA']);
	Route::get('/preparation', ['as' => 'transaction.preparation', 'uses' => 'App\Http\Controllers\TransactionController@preparationA']);
	Route::get('/shipping', ['as' => 'transaction.shipping', 'uses' => 'App\Http\Controllers\TransactionController@shippingA']);
	Route::get('/finish', ['as' => 'transaction.finish', 'uses' => 'App\Http\Controllers\TransactionController@finishA']);

	Route::put('transaction/accept/{transaction}', ['as' => 'transaction.accept', 'uses' => 'App\Http\Controllers\TransactionController@acceptA']);
	Route::put('transaction/endorse/{transaction}', ['as' => 'transaction.endorse', 'uses' => 'App\Http\Controllers\TransactionController@endorseA']);
	
	//User
	Route::get('/user', ['as' => 'user', 'uses' => 'App\Http\Controllers\UserController@user']);
	Route::get('/user/{id}', ['as' => 'user.show', 'uses' => 'App\Http\Controllers\UserController@userShow']);
	Route::get('/driver', ['as' => 'user.driver', 'uses' => 'App\Http\Controllers\UserController@driver']);
	Route::get('/driver/{id}', ['as' => 'driver.show', 'uses' => 'App\Http\Controllers\UserController@driverShow']);
	Route::put('/driver/update/{id}', ['as' => 'driver.addLicense', 'uses' => 'App\Http\Controllers\UserController@addLicense']);
	//barangay
	Route::get('/barangay', ['as' => 'barangay', 'uses' => 'App\Http\Controllers\BarangayController@index']);
	Route::post('/barangay', ['as' => 'barangay.store', 'uses' => 'App\Http\Controllers\BarangayController@store']);
	Route::put('/barangay/{id}', ['as' => 'barangay.update', 'uses' => 'App\Http\Controllers\BarangayController@update']);
	Route::get('barangay/delete/{id}', ['as' => 'barangay.delete', 'uses' => 'App\Http\Controllers\BarangayController@delete']);
});


Route::group(['middleware' => ['auth','isUser']], function () {

	//profile
	Route::get('/dashboard', 'App\Http\Controllers\HomeController@dashboardU')->name('dashboard');

	
	//driver

	
	//product
	Route::get('product', ['as' => 'product.viewU', 'uses' => 'App\Http\Controllers\ProductsController@indexU']);
	Route::get('product/{id}', ['as' => 'product.showU', 'uses' => 'App\Http\Controllers\ProductsController@showU']);
	//cart
	Route::post('product/cart/{id}', ['as' => 'product.addCart', 'uses' => 'App\Http\Controllers\ProductsController@addToCart']);
	Route::post('product/cart/quantityUpdate/{id}', ['as' => 'product.quantityUpdate', 'uses' => 'App\Http\Controllers\ProductsController@quantityUpdate']);
	Route::get('cart', ['as' => 'product.myCart', 'uses' => 'App\Http\Controllers\ProductsController@myCart']);
	Route::get('cart/delete/{id}/{transaction}', ['as' => 'cart.delete', 'uses' => 'App\Http\Controllers\CartController@cartDelete']);
	
	//transaction
	Route::put('order/{transaction}', ['as' => 'transaction.order', 'uses' => 'App\Http\Controllers\TransactionController@order']);
	Route::put('orderCancel/{transaction}', ['as' => 'cancel.order', 'uses' => 'App\Http\Controllers\TransactionController@cancelOrder']);
	Route::get('myOrder', ['as' => 'transaction.myOrder', 'uses' => 'App\Http\Controllers\TransactionController@myOrder']);
	
	//address
	Route::post('user/addAddress', ['as' => 'user.addAddress', 'uses' => 'App\Http\Controllers\UserController@addAddress']);
	//

	Route::get('/resendCode', ['as' => 'resend.code', 'uses' => 'App\Http\Controllers\UserController@resendCode']);
	Route::post('/sms/verification', ['as' => 'sms.verification', 'uses' => 'App\Http\Controllers\UserController@smsVerify']);
	
	
	

});


Route::group(['middleware' => ['auth','isDriver'],'prefix'=>'driver'], function () {
	Route::get('/dashboard', 'App\Http\Controllers\HomeController@dashboardD')->name('dashboardD');
	Route::get('/pending', ['as' => 'driver.pending', 'uses' => 'App\Http\Controllers\TransactionController@pendingD']);
	Route::get('/finish', ['as' => 'driver.finishList', 'uses' => 'App\Http\Controllers\TransactionController@finishListD']);
	Route::put('/finish/{transaction}', ['as' => 'driver.finish', 'uses' => 'App\Http\Controllers\TransactionController@finishD']);
});

Route::group(['middleware' => ['auth']], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
	//chat
	Route::post('/sendMessage/{id}', ['as' => 'chat.sendMessage', 'uses' => 'App\Http\Controllers\ChatController@sendMessage']);
	
	Route::get('/verification', 'App\Http\Controllers\HomeController@verify')->name('verify');

	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
	
});



