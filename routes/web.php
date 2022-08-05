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
Route::get('/category/{cat}',['as'=>'category.products','uses'=>'ShopController@categoryShow']);
Route::post('/cart/add',['as'=>'cart.add','uses'=>'CartController@addToCart']);
Route::post('/cart/clear',['as'=>'cart.clear','uses'=>'CartController@clearCart']);
Route::post('/cart/delete',['as'=>'cart.delete','uses'=>'CartController@delete']);


Auth::routes();

Route::get('/cart',['as'=>'cart','uses'=>'CartController@index']);


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