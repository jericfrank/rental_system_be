<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|'middleware' => ['jwt.auth', 'rbac']
*/

Route::get('/', function()
{
    return 'backend api.......';
});

Route::group([ 'prefix' => 'api', ], function () {
	Route::post('/auth/register', 'AuthController@signup');
	Route::post('/auth/login', 'AuthController@signin');
	Route::post('/auth/logout', 'AuthController@signout');

	Route::get('/users', 'UserController@index');
	
	Route::group([ 'middleware' => [ 'jwt.auth' ] ], function () {
		// Route::get('/users', 'UserController@index');
		Route::post('/rentals', 'RentalController@create');
		Route::get('/rentals', 'RentalController@index');

		Route::post('/uploader', 'UploaderController@upload');
	});
});