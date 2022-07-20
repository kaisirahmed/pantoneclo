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

Route::get('/home', ['as'=>'home','uses'=>'HomeController@index']);


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
		});
		
	});
});