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
    	$data = DB::table("categories")
                ->leftjoin("categories_add_form", "categories_add_form.id_categories", "=", "categories.id")
                ->select("categories.id", "category_id", "name", "icon", "level", "parrent", "created_by", DB::raw("date(created_at) as created_at"), DB::raw("count(categories_add_form.id) as count"))
                ->where("level", 1)->whereNull("deleted_at")->groupBy("categories.id", "category_id", "name", "icon", "level", "parrent", "created_by", "created_at")->orderBy("id", "desc")->get();

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
    	// return json_encode($request->data["name"]);

    	$id = (DB::table('categories')->max("id") + 1);

    	$data = [
            "id"            => $id,
    		"category_id"	=> 'CT-'.date("ynj/iH").'/'.$id,
    		"name"			=> ucfirst($request->data["name"]),
    		"icon"			=> $request->data["icon"],
    		"level"			=> 1,
    		"parrent"		=> null,
    		"created_by"	=> Auth::user()->employee_id,
            "deleted_at"    => null
    	];

    	if(DB::table("categories")->insert($data)){

            foreach ($request->formAd as $key => $value) {

                $ids = (DB::table('categories_add_form')->where("id_categories", $id)->max("id") + 1);

                DB::table("categories_add_form")->insert([
                    "id"                => $ids,
                    "id_categories"     => $id,
                    "form_name"         => ucfirst($value["nama"])
                ]);
            }

    		$response = [
	    		'status' 	=> 'berhasil',
	    		'content'	=> array_merge($data, ["created_at" => date("Y-m-d"), "count" => count($request->formAd)]),
	    	];
    		return json_encode($response);
    	}
    }

    public function update(Request $request){
    	// return json_encode($request->all());
    	$id = DB::table("categories")->where("category_id", $request->data['category_id'])->select("id")->first()->id;

    	$data = [
    		'name'	=> ucfirst($request->data["name"]),
    		'icon'	=> $request->data['icon']
    	];

        DB::table("categories")->where("id", $id)->update($data);
        DB::table('categories_add_form')->where("id_categories", $id)->whereIn('id', $request->deleted)->delete();

        foreach($request->formAd as $key => $value) {
            if($value["id"] == "null"){

                $ids = (DB::table('categories_add_form')->where("id_categories", $id)->max("id") + 1);

                DB::table("categories_add_form")->insert([
                    "id"                => $ids,
                    "id_categories"     => $id,
                    "form_name"         => $value["nama"]
                ]);

            }else{
                DB::table("categories_add_form")->where("id_categories", $id)->where("id", $value["id"])->update([
                    "form_name"         => $value["nama"]
                ]);
            }
        }

		$response = [
    		'status' 	=> 'berhasil',
    		'content'	=> DB::table("categories")->where("id", $id)->select("id", "category_id", "name", "icon", "level", "parrent", "created_by", DB::raw("date(created_at) as created_at"))->orderBy("id", "desc")->first(),
            'category_add_form' => DB::table("categories_add_form")
                                        ->where("id_categories", $id)
                                        ->select("id", "form_name as nama")->get()
    	];

		return json_encode($response);

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

    public function get_form_add(Request $request){
        $data = DB::table("categories_add_form")
                    ->join("categories", "categories_add_form.id_categories", "=", "categories.id")
                    ->where("categories.category_id", $request->id)
                    ->select("categories_add_form.id", "categories_add_form.form_name as nama")->get();


        return json_encode($data);
    }
}
 