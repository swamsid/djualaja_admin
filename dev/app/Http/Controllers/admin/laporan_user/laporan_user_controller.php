<?php

namespace App\Http\Controllers\admin\laporan_user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tb_reports;

use DB;

class laporan_user_controller extends Controller
{
    public function index(){
    	return view('admin.laporan_user.index');
    }

    public function list(){
    	
    	$data = DB::table('tb_reports')
    				->join('tb_product_sales', 'tb_reports.product_id', '=', 'tb_product_sales.product_id')
    				->join('users', 'users.id', '=', 'tb_product_sales.user_id')
    				->where('tb_product_sales.product_status', '!=', 'blocked')
    				->select('tb_reports.*', 'tb_product_sales.product_name', 'tb_product_sales.product_id as p_id', 'users.name', 'users.id as u_id')->get();

    	return $data;
    }

    public function get_info(Request $request){
    	// return $request->all();
    	$data = tb_reports::with(['iklan' => function($query){
    		$query->with('photos', 'district.regency.province');
    	}, 'user'])->where('id', $request->id)->get();

    	return json_encode($data);
    }

    public function block(Request $request){
    	// return $request->all();
    	$id = tb_reports::where('id', $request->id)->first();

    	if($id){
    		DB::table('tb_product_sales')->where('product_id', $id->product_id)->update([
    			'product_status'	=> 'blocked'
    		]);
    	}else{
    		return json_encode([
    			'status'	=> 'not found',
    			'content'	=> $request->id
    		]);
    	}

    	return json_encode([
			'status'	=> 'berhasil',
			'content'	=> $request->id
		]);
    }
}
