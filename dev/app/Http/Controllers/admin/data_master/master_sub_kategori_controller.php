<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Auth;

class master_sub_kategori_controller extends Controller
{
    public function index(){
    	return view("admin.master_sub_kategori.index");
    }

    public function list(){
    	$data = DB::table("categories as a")
    			->leftJoin("categories as b", "a.parrent", "=", "b.id")
    			->select("a.id", "a.category_id", "a.name", "a.icon", "a.level", "a.parrent", "a.created_by", "b.name as parrent_name", "b.category_id as parrent_cat_id", DB::raw("date(a.created_at) as created_at"))
    			->where("a.level", 2)->whereNull("a.deleted_at")->orderBy("a.id", "desc")->get();

    	$parrent =  DB::table("categories")->select("category_id as parrent", "name as name")->where("level", 1)->whereNull("deleted_at")->orderBy("id", "desc")->get();

    	$response = [
    		"data"		=> $data,
    		"parrent"	=> $parrent
    	];

    	return json_encode($response);
    }

    public function save(Request $request){
    	// return json_encode($request->all());

    	$id = (DB::table('categories')->max("id") + 1);
    	$parrent = DB::table("categories")->where("category_id", $request->parrent)->select("id", "name", "category_id", "deleted_at")->first();

    	if(!is_null($parrent->deleted_at)){
    		$response = [
	    		'status' 	=> 'invalid parrent',
	    		'content'	=> $parrent->name
	    	];
    		return json_encode($response);
    	}

    	$data = [
            "id"            => $id,
    		"category_id"	=> 'CT-'.date("ynj/iH").'/'.$id,
    		"name"			=> ucfirst($request->name),
    		"icon"			=> 'none',
    		"level"			=> 2,
    		"parrent"		=> $parrent->id,
    		"created_by"	=> Auth::user()->employee_id,
            "deleted_at"    => null
    	];

    	$merge = [
    		"created_at" 		=> date("Y-m-d"),
    		"parrent_name"		=> $parrent->name,
    		"parrent_cat_id"	=> $parrent->category_id,
    	];

    	if(DB::table("categories")->insert($data)){
    		$response = [
	    		'status' 	=> 'berhasil',
	    		'content'	=> array_merge($data, $merge)
	    	];
    		return json_encode($response);
    	}
    }

    public function update(Request $request){
    	// return json_encode($request->all());

    	$myData = DB::table("categories")->where("category_id", $request->category_id)->select("id", "deleted_at")->first();
    	$id = DB::table("categories")->where("category_id", $request->category_id)->select("id")->first()->id;
    	$parrent = DB::table("categories")->where("category_id", $request->parrent)->select("id", "name", "category_id", "deleted_at")->first();
    	
    	if(!is_null($parrent->deleted_at)){
    		$response = [
	    		'status' 	=> 'invalid parrent',
	    		'content'	=> $parrent->name
	    	];
    		return json_encode($response);
    	}else if(!is_null($myData->deleted_at)){
            $response = [
                'status'    => 'invalid data',
                'content'   => "null"
            ];
            return json_encode($response);
        }

    	$data = [
    		'name'	=> ucfirst($request->name),
    		'parrent'	=> $parrent->id
    	];

    	if(DB::table("categories")->where("id", $id)->update($data)){

    		$response = [
	    		'status' 	=> 'berhasil',
	    		'content'	=> $data = DB::table("categories as a")
                                            ->leftJoin("categories as b", "a.parrent", "=", "b.id")
                                            ->select("a.id", "a.category_id", "a.name", "a.icon", "a.level", "a.parrent", "a.created_by", "b.name as parrent_name", "b.category_id as parrent_cat_id", DB::raw("date(a.created_at) as created_at"))
                                            ->where("a.id", $id)->orderBy("a.id", "desc")->first()
	    	];

    		return json_encode($response);
    	}
    }

    public function delete(Request $request){
        // return json_encode($request->all());

        DB::table("categories")->whereIn("id", $request->all())->update([
            "deleted_at"   => date("Y-m-d H:i:s"),
            "deleted_by"   => Auth::user()->employee_id
        ]);

        $response = [
                'status'    => 'berhasil',
                'content'   => $request->all()
            ];

            return json_encode($response);
    }
}
