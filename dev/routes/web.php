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

route::get("/", function(){
	if(Auth::check()){
		return redirect()->route("dashboard");
	}else{
		return redirect()->route("login");
	}
});


Route::group(['middleware' => 'guest'], function () {

// login

	Route::get("/login", function(){
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

Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', function () {
	    return view('admin.dashboard.index');
	})->name("dashboard");



	// route master user start

		Route::get("/master-user", [
			'uses' 	=> 'admin\data_master\master_user_controller@index',
			'as'	=> 'master_user.index'
		]);

	// route master user end

});
