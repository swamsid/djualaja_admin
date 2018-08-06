<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;

use DB;

use Auth;

use Session;

use URL;

class filter_controller extends Controller
{
    public function index(){
    	return view('admin.master_filter.index');
    }

    public function list(){
    	$data = DB::table('filter')->select('id', 'kalimat', 'created_at')->whereNull('deleted_at')->get();

    	return json_encode($data);
    }

    public function save(Request $request){
    	
    	$id = (DB::table('filter')->max('id')) ? (DB::table('filter')->max('id') + 1) : 1;

    	DB::table('filter')->insert([
    		'id'			=> $id,
    		'kalimat'		=> $request->kalimat,
    		'created_by'	=> Auth::user()->employee_id
    	]);

    	return json_encode([
    		'status'	=> 'berhasil',
    		'content'	=> [
    			'id'			=> $id,
    			'kalimat'		=> $request->kalimat,
    			'created_at'	=> date('Y-m-d H:i:s')
    		]
    	]);
    }

    public function update(Request $request){
    	$data = DB::table('filter')->where('id', $request->id);

    	if(!$data->first()){
    		return json_encode([
    			'status'	=> 'invalid',
    			'content'	=> null
    		]);
    	}

    	$data->update([
    		'kalimat'	=> $request->data['kalimat'],
    	]);

    	return json_encode([
    			'status'	=> 'berhasil',
    			'content'	=> [
    				'id'		=> $request->id,
    				'kalimat'	=> $request->data['kalimat']
    			]
    		]);
    }

    public function delete(Request $request){
    	DB::table('filter')->whereIn('id', $request->all())->update([
    		'deleted_at'	=> date('Y-m-d'),
    		'deleted_by'	=> Auth::user()->employee_id
    	]);

    	return json_encode([
    		'status'	=> 'berhasil',
    		'content'	=> null
    	]);
    }
}
