<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Auth;

class master_features_paid_controller extends Controller
{
    public function index(){
    	return view("admin.master_features_paid.index");
    }

    public function list(){
    	$data = DB::table("tb_features_paid")->select("id", "paid_code", "paid_name", "paid_description", "paid_price", "paid_duration", "created_by", DB::raw("date(created_at) as created_at"))->whereNull("deleted_at")->orderBy("id", "desc")->get();

    	return $data;
    }

    public function save(Request $request){
    	// return json_encode($request->paid_description);

    	$id = (DB::table('tb_features_paid')->max("id") + 1);

    	$data = [
            "id"            	=> $id,
    		"paid_code"			=> 'FTR-'.date("ynj/iH").'/'.$id,
    		"paid_name"			=> $request->paid_name,
    		"paid_description"	=> $request->paid_description,
    		"paid_price"		=> $request->paid_price,
    		"paid_duration"		=> $request->paid_duration,
    		"created_by"		=> Auth::user()->employee_id
    	];

    	if(DB::table("tb_features_paid")->insert($data)){
    		$response = [
	    		'status' 	=> 'berhasil',
	    		'content'	=> array_merge($data, ["created_at" => date("Y-m-d")])
	    	];
    		return json_encode($response);
    	}
    }

    public function update(Request $request){
    	// return json_encode($request->all());
    	$id = DB::table("tb_features_paid")->where("paid_code", $request->paid_code)->select("id")->first()->id;

    	$data = [
    		'paid_name'			=> ucfirst($request->paid_name),
    		'paid_description'	=> $request->paid_description,
    		'paid_price'		=> $request->paid_price,
    		'paid_duration'		=> $request->paid_duration
    	];

    	if(DB::table("tb_features_paid")->where("id", $id)->update($data)){

    		$response = [
	    		'status' 	=> 'berhasil',
	    		'content'	=> $data = DB::table("tb_features_paid")->where("id", $id)->select("id", "paid_code", "paid_name", "paid_description", "paid_price", "paid_duration", "created_by", DB::raw("date(created_at) as created_at"))->orderBy("id", "desc")->first()
	    	];

    		return json_encode($response);
    	}
    }

    public function delete(Request $request){
    	// return json_encode($request->all());

        DB::table("tb_features_paid")->whereIn("id", $request->all())->update([
            "deleted_at"   => date("Y-m-d H:i:s"),
            "deleted_by"   => Auth::user()->employee_id
        ]);

    	$response = [
	    		'status' 	=> 'berhasil',
	    		'content'	=> $request->all()
	    	];

    		return json_encode($response);
    }
}
