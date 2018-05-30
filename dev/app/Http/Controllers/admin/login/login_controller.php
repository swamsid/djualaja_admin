<?php

namespace App\Http\Controllers\admin\login;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class login_controller extends Controller
{
    
	public function authenticate(Request $request){

		$ret = [
			"status" => "gagal",
			"message" => "Kombinasi Username Dan Password Tidak Sesuai"
		];
		
		if($request->username == "admin" && $request->password == "123456"){
			Session()->put("login_name", "Admin");
			$ret = [
				"status" => "berhasil",
				"message" => "Kombinasi Username Dan Password Tidak Sesuai"
			];
		}

		return json_encode($ret);
	}

	public function logout(){
		Session()->forget("login_name");

		return redirect()->route("login");
	}

}
