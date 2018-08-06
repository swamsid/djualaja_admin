<?php

namespace App\Http\Controllers\admin\laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user;

use DB;

class laporan_pengiklan_controller extends Controller
{
	public function setting(){
		$province = DB::table('provinces')->select('*')->orderBy('name', 'asc')->get();
		return view('admin.report.laporan_pengiklan.setting', compact('province'));
	}

	public function submit(Request $request){
		$data = user::select('*')->with('district.regency.province');

		if($request->province != 'all'){
			$data = $data->whereHas('district.regency.province', function($query) use ($request){
						$query->where('id', $request->province);
					});
		}

		$data = $data->get();

		$province = ($request->province != 'all') ? DB::table('provinces')->where('id', $request->province)->first()->name : 'Semua' ; 

		return view('admin.report.laporan_pengiklan.index', compact('data', 'request', 'province'));
	} 
}
