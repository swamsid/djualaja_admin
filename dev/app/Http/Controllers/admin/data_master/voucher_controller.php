<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;

use DB;

use Auth;

use Session;

use URL;


class voucher_controller extends Controller
{
    public function index(){
    	return view('admin.master_voucher.index');
    }

    public function list(){
    	$data = DB::table('tb_voucher_code')->whereNull('deleted_at')->select('id', 'voucher_code', 'voucher_description', 'voucher_uses', 'voucher_max_users_uses', 'voucher_type', 'voucher_discount', 'voucher_ends_at', 'is_fixed')->get();

    	return json_encode($data);
    }

    public function save(Request $request){
    	// return json_encode($request->all());

    	$id = (DB::table('tb_voucher_code')->max('id')) ? (DB::table('tb_voucher_code')->max('id') + 1) : 1; 
    	$cek = DB::table('tb_voucher_code')->where("voucher_code", $request->voucher_code)->first();

    	if($cek){
    		return json_encode([
    			'status'	=> 'exist',
    			'content'	=> $request->voucher_code,
    		]);
    	}

    	DB::table('tb_voucher_code')->insert([
    		'voucher_code'				=> strtoupper($request->voucher_code),
    		'voucher_description'		=> $request->voucher_description,
    		'voucher_uses'				=> $request->voucher_uses,
    		'voucher_max_users_uses'	=> $request->voucher_max_users_uses,
    		'voucher_type'				=> $request->voucher_type,
    		'voucher_discount'			=> $request->voucher_discount,
    		'is_fixed'					=> $request->is_fixed,
    		'voucher_ends_at'			=> $request->voucher_ends_at,
    		'created_by'				=> Auth::user()->employee_id
    	]);

    	return json_encode([
    		'status'	=> 'berhasil',
    		'content'	=> [
    			'id'						=> $id,
    			'voucher_code'				=> $request->voucher_code,
    			'voucher_description'		=> $request->voucher_description,
    			'voucher_uses'				=> $request->voucher_uses,
    			'voucher_max_users_uses'	=> $request->voucher_max_users_uses,
    			'voucher_type'				=> $request->voucher_type,
    			'voucher_discount'			=> $request->voucher_discount,
    			'voucher_ends_at'			=> $request->voucher_ends_at,
    			'is_fixed'					=> $request->is_fixed	
    		]
    	]);
    }

    public function update(Request $request){
    	// return json_encode($request->all());

    	$data = DB::table('tb_voucher_code')->where('id', $request->id);

    	if(!$data->first()){
    		return json_encode([
    			'status'	=> 'invalid',
    			'content'	=> null
    		]);
    	}

    	$data->update([
    		'voucher_code'				=> $request->data['voucher_code'],
    		'voucher_description'		=> $request->data['voucher_description'],
    		'voucher_uses'				=> $request->data['voucher_uses'],
    		'voucher_max_users_uses'	=> $request->data['voucher_max_users_uses'],
    		'voucher_type'				=> $request->data['voucher_type'],
    		'voucher_discount'			=> $request->data['voucher_discount'],
    		'is_fixed'					=> $request->data['is_fixed'],
    		'voucher_ends_at'			=> $request->data['voucher_ends_at'],
    	]);

    	return json_encode([
    		'status'	=> 'berhasil',
    		'content'	=> [
    			'id'						=> $request->id,
    			'voucher_code'				=> strtoupper($request->data['voucher_code']),
    			'voucher_description'		=> $request->data['voucher_description'],
    			'voucher_uses'				=> $request->data['voucher_uses'],
    			'voucher_max_users_uses'	=> $request->data['voucher_max_users_uses'],
    			'voucher_type'				=> $request->data['voucher_type'],
    			'voucher_discount'			=> $request->data['voucher_discount'],
    			'voucher_ends_at'			=> $request->data['voucher_ends_at'],
    			'is_fixed'					=> $request->data['is_fixed']	
    		]
    	]);
    }

    public function delete(Request $request){
    	DB::table('tb_voucher_code')->whereIn('id', $request->all())->update([
    		'deleted_at'	=> date('Y-m-d'),
    		'deleted_by'	=> Auth::user()->employee_id
    	]);

    	return json_encode([
    		'status'	=> 'berhasil',
    		'content'	=> null
    	]);
    }
}
