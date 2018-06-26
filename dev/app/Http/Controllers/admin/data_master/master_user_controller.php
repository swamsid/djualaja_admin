<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

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
}
