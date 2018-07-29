<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\user;

use DB;
use Session;

class master_user_controller extends Controller
{
    public function index(){
    	return view("admin.master_user.index");
    }

    public function test_create(){
    	$data = [
    		"employee_number"	=> "13410100128",
    		"employee_name"		=> "Dirga Ambara",
    		"employee_password"	=> Hash::make("secret_226874")
    	];

    	DB::table("tb_employee")->insert($data);

    	return "sukses";
    }

    public function list(){
        $data = DB::table('users')
                ->join('districts', 'districts.id', '=', 'users.district_id')
                ->join('regencies', 'regencies.id', '=', 'districts.regency_id')
                ->select('users.*', 'regencies.name as kota')->get();

        return $data;
    }

    public function update(Request $request){
        $response = [
            "status"    => "berhasil",
            "content"   => $request->sts,
        ];

        $det = DB::table('users')->where("id", $request->id);
        $det->update([ "status"    => ($request->sts == 'null') ? null : $request->sts ]);

        if($request->sts == 'banned'){
            DB::table('tb_product_sales')->where('user_id', $request->id)->update([
                'banned_at'    => date('Y-m-d H:i:s')
            ]);
        }else{
            DB::table('tb_product_sales')->where('user_id', $request->id)->update([
                'banned_at'    => null
            ]);
        }

        return json_encode($response);
    }
}
