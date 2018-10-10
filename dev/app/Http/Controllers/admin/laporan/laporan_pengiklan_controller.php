<?php

namespace App\Http\Controllers\admin\laporan;

use App\Exports\Excel\test_export;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user;

use DB;
use Excel;

class laporan_pengiklan_controller extends Controller
{
	public function setting(){
		$province = DB::table('provinces')->select('*')->orderBy('name', 'asc')->get();
		return view('admin.report.laporan_pengiklan.setting', compact('province'));
	}

	public function submit(Request $request){
		// return json_encode($request->all());
		$data = user::select('*')->with(['district.regency.province', 'iklan' => function($query){
			$query->select(DB::raw('count(product_id) as total_iklan'), 'user_id')->groupBy('user_id')->first();
		}]);

		if($request->province != 'all'){
			$data = $data->whereHas('district.regency.province', function($query) use ($request){
						$query->where('id', $request->province);
					});
		}

		if($request->status == "verified")
			$data = $data->where('confirmed', 1);
		else if($request->status == "unverified")
			$data = $data->where('confirmed', 0);
		else
			$data = $data->where('status', 'inactive');

		$data = $data->get();

		$province = ($request->province != 'all') ? DB::table('provinces')->where('id', $request->province)->first()->name : 'Semua' ; 

		// return $data;

		return view('admin.report.laporan_pengiklan.index', compact('data', 'request', 'province'));
	} 

	public function export_pdf(Request $request){
		$data = user::select('*')->with(['district.regency.province', 'iklan' => function($query){
			$query->select(DB::raw('count(product_id) as total_iklan'), 'user_id')->groupBy('user_id')->first();
		}]);

		if($request->province != 'all'){
			$data = $data->whereHas('district.regency.province', function($query) use ($request){
						$query->where('id', $request->province);
					});
		}

		if($request->status == "verified")
			$data = $data->where('confirmed', 1);
		else if($request->status == "unverified")
			$data = $data->where('confirmed', 0);
		else
			$data = $data->where('status', 'inactive');

		$data = $data->get();

		$province = ($request->province != 'all') ? DB::table('provinces')->where('id', $request->province)->first()->name : 'Semua' ;

		if($request->province != 'all')
			$title = "Laporan_Pengiklan_Provinsi_".DB::table('provinces')->where('id', $request->province)->first()->name.'_Dengan_Status_'.ucfirst($request->status).'.xlsx';
		else
			$title = "Laporan_Pengiklan_Semua_Provinsi_Dengan_Status_".ucfirst($request->status).".xlsx";

		// return $title;

		return Excel::download(new test_export('admin.report.laporan_pengiklan.export.pdf', $data), $title);
	}

	public function tes_excel(Request $request){
		$data = [
			[
				"nama"	=> "Dirga Ambara",
				"email"	=> "swamsid@gmail.com"
			],

			[
				"nama"	=> "Yulainda Kiki Nabelahh",
				"email"	=> "kiki1234@gmail.com"
			]
		];


		return Excel::download(new test_export('admin.report.tes_excel', $data), 'tes.xlsx');
	}
}
