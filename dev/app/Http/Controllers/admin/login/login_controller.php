<?php

namespace App\Http\Controllers\admin\login;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\tb_employee;
use Session;

class login_controller extends Controller
{
    
	public function authenticate(Request $request){

		$ret = [
			"status" => "gagal",
			"message" => "Kombinasi Username Dan Password Tidak Sesuai"
		];

		$employee = tb_employee::where("employee_number", $request->username)->first();

		if($employee && Hash::check('secret_'.$request->password, $employee->employee_password)){
			Auth::login($employee);
			$ret = [
				"status" => "berhasil",
				"message" => "Kombinasi Username Dan Password Tidak Sesuai"
			];
		}

		return json_encode($ret);
	}

	public function logout(){
        Auth::logout();
        return redirect('/');
	}

}
