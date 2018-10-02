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
        // $data = user::join('districts', 'districts.id', '=', 'users.district_id')
        //         ->join('regencies', 'regencies.id', '=', 'districts.regency_id')
        //         ->with(['iklan' => function($query){
        //             return $query->whereNull('banned_at')
        //                             ->whereNull('product_deleted_at')
        //                             ->where('product_status', '!=', 'blocked')
        //                             ->where('product_status', '!=', 'delete')
        //                             ->select('user_id', DB::raw('count(product_id) as iklan'))
        //                             ->groupBy('user_id');
        //         }])
        //         ->select('users.*', 'districts.name as kecamatan', 'regencies.name as kota')
        //         ->get();

        $data = DB::select(DB::raw("
                    select a.*, c.name as kecamatan, d.name as kota, count(b.product_id) as iklan from users a
                        left join tb_product_sales b 
                            on a.id = b.user_id
                            and b.product_status != 'blocked'
                            and b.product_status != 'delete'
                            and b.product_deleted_at is null
                            and b.banned_at is null
                        join districts c on a.district_id = c.id
                        join regencies d on c.regency_id = d.id
                    group by a.id, a.district_id, a.name, a.slug_name, a.email, 
                    a.`password`, a.phone, a.address, a.longtitude, a.latitude, a.token, a.facebook, a.instagram, 
                    a.photo, a.`status`, a.state, a.remember_token, a.created_at, a.updated_at, a.confirmed, a.confirmation_code, 
                    kecamatan, kota
                "));

        // return "okee";
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
