<?php

namespace App\Http\Controllers\admin\pengelola_iklan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tb_product_sales;

use DB;
use Session;
use Auth;

class ads_controller extends Controller
{
    public function index(){
    	return view("admin.iklan_pengguna.index");
    }

    public function list(){

    	$data = tb_product_sales::select("tb_product_sales.product_id", "product_name", "product_price", "user_id")->with(["photos" => function($query){
    		$query->limit(1);
    	}])->get();
    	return json_encode($data);

    }

    public function get_iklan(Request $request){
    	$data = tb_product_sales::where("product_id", $request->id)->with('photos', 'district.regency.province')->get();

    	return json_encode($data);
    }

    public function update_status(Request $request){
    	$data = DB::table('tb_product_sales')->where("product_id", $request->id);

    	$data->update([ "product_status" 	=> $request->status ]);

		$response = [
    		'status' 	=> 'berhasil',
    		'content'	=> $request->status,
    	];
    	
		return json_encode($response);
    	

    }
}
