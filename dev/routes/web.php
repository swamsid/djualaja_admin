<?php

use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

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
    return $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(0));
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

	Route::get('/dashboard',[
		'uses'	=> 'admin\dashboard_controller@index',
	])->name("dashboard");



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


	// route koin
		Route::get("/transaksi", [
			'uses' 	=> 'admin\data_master\koin_controller@index',
			'as'	=> 'transaksi.index'
		]);

		Route::get("/transaksi/data/list", [
			'uses' 	=> 'admin\data_master\koin_controller@list',
			'as'	=> 'transaksi.list'
		]);

		Route::post("/transaksi/data/get_transaksi", [
			'uses' 	=> 'admin\data_master\koin_controller@get_transaksi',
			'as'	=> 'transaksi.get_transaksi'
		]);

		Route::post("/transaksi/update_status", [
			'uses' 	=> 'admin\data_master\koin_controller@update_status',
			'as'	=> 'transaksi.update_status'
		]);
	//route koin


	// route popup
		Route::get("/pop_up/", [
			'uses' 	=> 'admin\data_master\popup_controller@index',
			'as'	=> 'popup.index'
		]);

		Route::get("/pop_up/data/list", [
			'uses' 	=> 'admin\data_master\popup_controller@list',
			'as'	=> 'popup.list'
		]);

		Route::post("/pop_up/data/get_iklan", [
			'uses' 	=> 'admin\data_master\popup_controller@get_iklan',
			'as'	=> 'popup.get_iklan'
		]);

		Route::post("/pop_up/save", [
			'uses' 	=> 'admin\data_master\popup_controller@save',
			'as'	=> 'popup.save'
		]);

		Route::post("/pop_up/update", [
			'uses' 	=> 'admin\data_master\popup_controller@update',
			'as'	=> 'popup.update'
		]);

		Route::post("/pop_up/delete", [
			'uses' 	=> 'admin\data_master\popup_controller@delete',
			'as'	=> 'popup.delete'
		]);
	//route popup end

	// route voucher
		Route::get("/voucher/", [
			'uses' 	=> 'admin\data_master\voucher_controller@index',
			'as'	=> 'voucher.index'
		]);

		Route::get("/voucher/data/list", [
			'uses' 	=> 'admin\data_master\voucher_controller@list',
			'as'	=> 'voucher.list'
		]);

		Route::post("/voucher/save", [
			'uses' 	=> 'admin\data_master\voucher_controller@save',
			'as'	=> 'voucher.save'
		]);

		Route::post("/voucher/update", [
			'uses' 	=> 'admin\data_master\voucher_controller@update',
			'as'	=> 'voucher.update'
		]);

		Route::post("/voucher/delete", [
			'uses' 	=> 'admin\data_master\voucher_controller@delete',
			'as'	=> 'voucher.delete'
		]);
	//route voucher

	// route filter
		Route::get("/filter", [
			'uses' 	=> 'admin\data_master\filter_controller@index',
			'as'	=> 'filter.index'
		]);

		Route::get("/filter/data/list", [
			'uses' 	=> 'admin\data_master\filter_controller@list',
			'as'	=> 'filter.list'
		]);

		Route::post("/filter/save", [
			'uses' 	=> 'admin\data_master\filter_controller@save',
			'as'	=> 'filter.save'
		]);

		Route::post("/filter/update", [
			'uses' 	=> 'admin\data_master\filter_controller@update',
			'as'	=> 'filter.update'
		]);

		Route::post("/filter/delete", [
			'uses' 	=> 'admin\data_master\filter_controller@delete',
			'as'	=> 'filter.delete'
		]);
	//route filter

	// route laporan pengiklan
		Route::get("/laporan/laporan_pengiklan/setting", [
			'uses' 	=> 'admin\laporan\laporan_pengiklan_controller@setting',
			'as'	=> 'laporan_pengiklan.setting'
		]);

		Route::post("/laporan/laporan_pengiklan/submit", [
			'uses' 	=> 'admin\laporan\laporan_pengiklan_controller@submit',
			'as'	=> 'laporan_pengiklan.submit'
		]);
	//laporan pengiklan end

	// route laporan iklan
		Route::get("/laporan/laporan_iklan/setting", [
			'uses' 	=> 'admin\laporan\laporan_iklan_controller@setting',
			'as'	=> 'laporan_iklan.setting'
		]);

		Route::post("/laporan/laporan_iklan/submit", [
			'uses' 	=> 'admin\laporan\laporan_iklan_controller@submit',
			'as'	=> 'laporan_iklan.submit'
		]);
	//laporan iklan end

	// route laporan iklan
		Route::get("/laporan_user", [
			'uses' 	=> 'admin\laporan_user\laporan_user_controller@index',
			'as'	=> 'laporan_user.index'
		]);

		Route::get("/laporan_user/data/list", [
			'uses' 	=> 'admin\laporan_user\laporan_user_controller@list',
			'as'	=> 'laporan_user.list'
		]);

		Route::post("/laporan_user/data/get_info", [
			'uses' 	=> 'admin\laporan_user\laporan_user_controller@get_info',
			'as'	=> 'laporan_user.get_info'
		]);

		Route::post("/laporan_user/block", [
			'uses' 	=> 'admin\laporan_user\laporan_user_controller@block',
			'as'	=> 'laporan_user.blocl'
		]);
	//laporan iklan end

});
