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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', ['as'=>'home','uses'=>'PantonecloController@index']);
Route::get('/shop', ['as'=>'shop','uses'=>'ShopController@index']);
Route::get('/shop/{slug}',['as'=>'product.show','uses'=>'ShopController@show']);
Route::get('/category/{cat}',['as'=>'category.products','uses'=>'ShopController@categoryProducts']);
Route::post('/cart/add',['as'=>'cart.add','uses'=>'CartController@addToCart']);
Route::post('/cart/clear',['as'=>'cart.clear','uses'=>'CartController@clearCart']);
Route::post('/cart/item/update',['as'=>'cart.item.update','uses'=>'CartController@itemUpdate']);
Route::post('/cart/update',['as'=>'cart.update','uses'=>'CartController@update']);
Route::post('/cart/delete',['as'=>'cart.delete','uses'=>'CartController@delete']);
Route::get('/contact',['as'=>'contact','uses'=>'ContactController@index']);
Route::get('/cart',['as'=>'cart','uses'=>'CartController@index']);
Route::get('/variation/product',['as'=>'variation.product','uses'=>'ProductController@variationProduct']);

Route::get('temp-email',['as'=>'temp.email','uses'=>'PantonecloController@demoEmail']);

Auth::routes([ 'verify' => true ]);

Route::group(['middleware' => ['auth']], function () {//'verified'
	Route::get('/checkout',['as'=>'checkout','uses'=>'CheckoutController@index'])->middleware('checkout');
	//Ajax Routes
	Route::post('/checkout/state',['as'=>'checkout.state','uses'=>'CheckoutController@state']);
	Route::post('/checkout/city',['as'=>'checkout.city','uses'=>'CheckoutController@city']);
	// End
	Route::post('/checkout/store',['as'=>'checkout.store','uses'=>'CheckoutController@store'])->middleware('checkout');
	Route::get('/checkout/payment/{id}',['as'=>'checkout.payment','uses'=>'CheckoutController@payment']);
	Route::post('/order/purchage',['as'=>'order.purchage','uses'=>'CheckoutController@purchage']);

	Route::get('/account',['as'=>'account','uses'=>'AccountController@index']);
	Route::get('/account/orders',['as'=>'account.orders','uses'=>'AccountController@orders']);
	// Ajax routes
	Route::post('/account/user/edit',['as'=>'account.user.edit','uses'=>'AccountController@userEdit']);
	Route::post('/account/user/update',['as'=>'account.user.update','uses'=>'AccountController@userUpdate']);
	
});



Route::namespace('Admin')->group(function(){

	Route::prefix('admin')->name('admin.')->namespace('Auth')->group(function(){
			 
        Route::post('/logout',['as'=>'logout','uses'=>'LoginController@logout']);

		Route::get('/login', ['as'=>'login','uses'=>'LoginController@showLoginForm']);

		Route::post('/login', ['as'=>'login','uses'=>'LoginController@login']);

        //Forgot Password Routes
        Route::get('/password/reset',['as'=>'password.request','uses'=>'ForgotPasswordController@showLinkRequestForm']);

        Route::post('/password/email',['as'=>'password.email','uses'=>'ForgotPasswordController@sendResetLinkEmail']);

        //Reset Password Routes
        Route::get('/password/reset/{token}',['as'=>'password.reset','uses'=>'ResetPasswordController@showResetForm']);

        Route::post('/password/reset',['as'=>'password.update','uses'=>'ResetPasswordController@reset']);

        // Email Verification Route(s)
        Route::get('/email/verify',['as'=>'verification.notice','uses'=>'VerificationController@show']);

        Route::get('/email/verify/{id}',['as'=>'verification.verify','uses'=>'VerificationController@verify']);

        Route::get('/email/resend',['as'=>'verification.resend','uses'=>'VerificationController@resend']);
	});

	Route::group(['middleware' => ['auth:admin','guard.verified:admin,admin.verification.notice']], function () {

		Route::prefix('admin')->name('admin.')->namespace('Auth')->group(function(){

			Route::get('/register', ['as'=>'register','uses'=>'RegisterController@showRegistrationForm']);

			Route::post('/register', ['as'=>'register','uses'=>'RegisterController@create']);
		});
	

		Route::prefix('admin')->name('admin.')->group(function() {
			Route::resource('/','AdminController');
			Route::get('/{admin}/edit',['as'=>'edit','uses'=>'AdminController@edit']);
			Route::post('/update/{admin}',['as'=>'update','uses'=>'AdminController@update']);
			Route::delete('/{admin}',['as'=>'destroy','uses'=>'AdminController@destroy']);

			Route::get('/dashboard',['as'=>'dashboard','uses'=>'AdminController@admin']);
			
			// Categories Routes
			Route::resource('categories','CategoryController');
			//Route::get('/categories/pdf',['as'=>'categories.pdf','uses'=>'CategoryController@pdf']);

			Route::resource('products','ProductController');
			Route::post('products/imageupload',['as'=>'products.imageupload','uses'=>'ProductController@imageUpload']);
			//Route::post('products/delete',['as'=>'products.delete','uses'=>'ProductController@delete']);
			Route::get('/products/pdf',['as'=>'products.pdf','uses'=>'ProductController@pdf']);
		});
		
	
		
	});
	
});