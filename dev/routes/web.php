<?php

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

// Route::get('test', function () {
//     return "aaa";
// });


Route::group(['middleware' => 'guest'], function () {

// login

	Route::get("/", function(){
		return view("admin.login.index");
	})->name("login");

	route::post("/login", [
		'uses'	=> 'admin\login\login_controller@authenticate',
		'as'	=> 'login.authenticate'
	]);

	route::get("/logout", [
		'uses'	=> 'admin\login\login_controller@logout',
		'as'	=> 'logout'
	]);

// end login

});

Route::group(['middleware' => 'guest'], function () {

	Route::get('/dashboard', function () {
	    if(Session::has("login_name"))
	    	return view('admin.dashboard.index');
	    else
	    	return redirect()->route("login");
	})->name("dashboard");



	// route master user start

		Route::get("/master-user", [
			'uses' 	=> 'data_master\master_user_controller@index',
			'as'	=> 'master_user.index'
		]);

	// route master user end

});
