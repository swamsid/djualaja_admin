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

Route::get('/riset', function () {
    return view("welcome");
});

Route::get('/test', function () {
    return view("admin.login.index");
});

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

	route::post("/authenticate", [
		'uses'	=> 'admin\login\login_controller@authenticate',
		'as'	=> 'login.authenticate'
	]);

	Route::get("/master-user/test/create", [
			'uses' 	=> 'admin\data_master\master_user_controller@test_create',
			'as'	=> 'master_user.test_create'
		]);

// end login

});

Route::group(['middleware' => 'auth'], function () {

	route::get("/logout", [
		'uses'	=> 'admin\login\login_controller@logout',
		'as'	=> 'logout'
	]);

	Route::get('/dashboard', function () {
	    return view('admin.dashboard.index');
	})->name("dashboard");



	// route master user start

		Route::get("/master_user", [
			'uses' 	=> 'admin\data_master\master_user_controller@index',
			'as'	=> 'master_user.index'
		]);

		Route::get("/master_user/list", [
			'uses' 	=> 'admin\data_master\master_user_controller@list',
			'as'	=> 'master_user.list'
		]);

		Route::post("/master_user/update", [
			'uses' 	=> 'admin\data_master\master_user_controller@update',
			'as'	=> 'master_user.update'
		]);

		// Route::post("/iklan_pengguna/update_status", [
		// 	'uses' 	=> 'admin\pengelola_iklan\ads_controller@update_status',
		// 	'as'	=> 'iklan_pengguna.update_status'
		// ]);

	// route master user end


	// route master kategori start

		Route::get("/master_kategori", [
			'uses' 	=> 'admin\data_master\master_kategori_controller@index',
			'as'	=> 'master_kategori.index'
		]);

		Route::get("/master_kategori/select_list", [
			'uses' 	=> 'admin\data_master\master_kategori_controller@select_list',
			'as'	=> 'master_kategori.select_list'
		]);

		Route::get("/master_kategori/list", [
			'uses'	=> 'admin\data_master\master_kategori_controller@list',
			'as'	=> 'master_kategori.list'
		]);

		Route::post("/master_kategori/save", [
			'uses' 	=> 'admin\data_master\master_kategori_controller@save',
			'as'	=> 'master_kategori.save'
		]);

		Route::post("/master_kategori/update", [
			'uses' 	=> 'admin\data_master\master_kategori_controller@update',
			'as'	=> 'master_kategori.update'
		]);

		Route::post("/master_kategori/delete", [
			'uses' 	=> 'admin\data_master\master_kategori_controller@delete',
			'as'	=> 'master_kategori.delete'
		]);

		Route::post("/master_kategori/get_form_add", [
			'uses'	=> 'admin\data_master\master_kategori_controller@get_form_add',
			'as'	=> 'master_kategori.get_form_add'
		]);

	// route master kategori end


	// route master Sub kategori start

		Route::get("/master_sub_kategori", [
			'uses' 	=> 'admin\data_master\master_sub_kategori_controller@index',
			'as'	=> 'master_sub_kategori.index'
		]);

		Route::get("/master_sub_kategori/list", [
			'uses'	=> 'admin\data_master\master_sub_kategori_controller@list',
			'as'	=> 'master_sub_kategori.list'
		]);

		Route::post("/master_sub_kategori/save", [
			'uses' 	=> 'admin\data_master\master_sub_kategori_controller@save',
			'as'	=> 'master_sub_kategori.save'
		]);

		Route::post("/master_sub_kategori/update", [
			'uses' 	=> 'admin\data_master\master_sub_kategori_controller@update',
			'as'	=> 'master_sub_kategori.update'
		]);

		Route::post("/master_sub_kategori/delete", [
			'uses' 	=> 'admin\data_master\master_sub_kategori_controller@delete',
			'as'	=> 'master_sub_kategori.delete'
		]);

	// route master kategori end
		

	// route master features start

		Route::get("/master_features_paid", [
			'uses' 	=> 'admin\data_master\master_features_paid_controller@index',
			'as'	=> 'master_features_paid.index'
		]);

		Route::get("/master_features_paid/list", [
			'uses'	=> 'admin\data_master\master_features_paid_controller@list',
			'as'	=> 'master_features_paid.list'
		]);

		Route::post("/master_features_paid/save", [
			'uses' 	=> 'admin\data_master\master_features_paid_controller@save',
			'as'	=> 'master_features_paid.save'
		]);

		Route::post("/master_features_paid/update", [
			'uses' 	=> 'admin\data_master\master_features_paid_controller@update',
			'as'	=> 'master_features_paid.update'
		]);

		Route::post("/master_features_paid/delete", [
			'uses' 	=> 'admin\data_master\master_features_paid_controller@delete',
			'as'	=> 'master_features_paid.delete'
		]);

	// route master features end


	// route iklan pengguna
		Route::get("/iklan_pengguna/{status}", [
			'uses' 	=> 'admin\pengelola_iklan\ads_controller@index',
			'as'	=> 'iklan_pengguna.index'
		]);

		Route::get("/iklan_pengguna/data/list", [
			'uses' 	=> 'admin\pengelola_iklan\ads_controller@list',
			'as'	=> 'iklan_pengguna.list'
		]);

		Route::post("/iklan_pengguna/data/get_iklan", [
			'uses' 	=> 'admin\pengelola_iklan\ads_controller@get_iklan',
			'as'	=> 'iklan_pengguna.get_iklan'
		]);

		Route::post("/iklan_pengguna/update_status", [
			'uses' 	=> 'admin\pengelola_iklan\ads_controller@update_status',
			'as'	=> 'iklan_pengguna.update_status'
		]);
	//route iklan pengguna end

});
