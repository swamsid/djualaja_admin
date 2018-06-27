<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Auth;

class master_kategori_controller extends Controller
{
    public function index(){
    	return view("admin.master_kategori.index");
    }

    public function list(){
    	$data = DB::table("categories")->select("id", "category_id", "name", "icon", "level", "parrent", "created_by", DB::raw("date(created_at) as created_at"))->where("level", 1)->whereNull("deleted_at")->orderBy("id", "desc")->get();

    	return $data;
    }

    public function select_list(){
        $data = DB::table("categories")->select("category_id as parrent", "name as name")->where("level", 1)->whereNull("deleted_at")->orderBy("id", "desc")->get();

        $response = [
            'status'    => 'berhasil',
            'content'   => $data
        ];

        return json_encode($response);
    }

    public function save(Request $request){
    	return json_encode($request->all());

    	$id = (DB::table('categories')->max("id") + 1);

    	$data = [
            "id"            => $id,
    		"category_id"	=> 'CT-'.date("ynj/iH").'/'.$id,
    		"name"			=> ucfirst($request->name),
    		"icon"			=> $request->icon,
    		"level"			=> 1,
    		"parrent"		=> null,
    		"created_by"	=> Auth::user()->employee_id,
            "deleted_at"    => null
    	];

    	if(DB::table("categories")->insert($data)){
    		$response = [
	    		'status' 	=> 'berhasil',
	    		'content'	=> array_merge($data, ["created_at" => date("Y-m-d")])
	    	];
    		return json_encode($response);
    	}
    }

    public function update(Request $request){
    	// return json_encode($request->all());
    	$id = DB::table("categories")->where("category_id", $request->category_id)->select("id")->first()->id;

    	$data = [
    		'name'	=> ucfirst($request->name),
    		'icon'	=> $request->icon
    	];

    	if(DB::table("categories")->where("id", $id)->update($data)){

    		$response = [
	    		'status' 	=> 'berhasil',
	    		'content'	=> $data = DB::table("categories")->where("id", $id)->select("id", "category_id", "name", "icon", "level", "parrent", "created_by", DB::raw("date(created_at) as created_at"))->orderBy("id", "desc")->first()
	    	];

    		return json_encode($response);
    	}
    }

    public function delete(Request $request){
    	// return json_encode($request->all());

        DB::table("categories")->whereIn("id", $request->all())->orWhereIn("parrent", $request->all())->update([
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
 