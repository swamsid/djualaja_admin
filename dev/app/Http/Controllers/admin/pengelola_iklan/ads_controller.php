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
    public function index($status){
        if($status == "pending")
    	   return view("admin.iklan_pengguna.index_pending");
        else if($status == "approved")
            return view("admin.iklan_pengguna.index_approved");
        else if($status == "reject")
            return view("admin.iklan_pengguna.index_rejected");
    }

    public function list(Request $request){
        // return $request->all();
    	$data = DB::table("tb_product_sales")
                        ->join("users", "users.id", "=", "tb_product_sales.user_id")
                        ->leftjoin("tb_product_photo", "tb_product_photo.product_id", "=", "tb_product_sales.product_id")
                        ->where("tb_product_sales.product_status", $request->data)
                        ->select("tb_product_sales.product_id as id", "tb_product_sales.product_name", "tb_product_sales.product_location", "tb_product_sales.product_price", "tb_product_sales.product_created_at", "users.name", "tb_product_sales.product_pre_filter", DB::raw("count(tb_product_photo.photo_id) as photo_count"))
                        ->groupby("tb_product_sales.product_id", "tb_product_sales.product_name", "tb_product_sales.product_location", "tb_product_sales.product_price", "tb_product_sales.product_created_at", "users.name", "tb_product_sales.product_pre_filter")->get();

    	return json_encode($data);

    }

    public function get_iklan(Request $request){
    	$data = tb_product_sales::where("product_id", $request->id)->with('photos', 'district.regency.province')->get();

    	return json_encode($data);
    }

    public function update_status(Request $request){
        // return json_encode($request->all());

    	$data = DB::table('tb_product_sales')->where("product_id", $request->id);
        $banned = null;

        if($request->status == 'blocked'){
            $banned = date('Y-m-d H:i:s');
        }

    	$data->update([ 
            "product_status" 	=> $request->status,
            "banned_at"         => $banned
        ]);

		$response = [
    		'status' 	=> 'berhasil',
    		'content'	=> $request->status,
    	];
    	
		return json_encode($response);
    }
}
