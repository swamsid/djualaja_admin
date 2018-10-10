<?php

namespace App\Http\Controllers\admin\laporan;

use App\Exports\Excel\test_export;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tb_product_sales;
use App\Category;

use DB;
use Excel;

class laporan_iklan_controller extends Controller
{
    public function setting(){
    	$province = DB::table('provinces')->select('*')->orderBy('name', 'asc')->get();
    	$kategori = Category::whereNull('parrent')->whereNull('deleted_at')->with('children')->get();

    	// return $kategori;

    	return view('admin.report.laporan_iklan.setting', compact('province', 'kategori'));
    }

    public function submit(Request $request){
    	// return $request->all();

    	$mth = (!is_null($request->bulan)) ? explode('-', $request->bulan)[0] : null;
    	$province = ($request->province != 'all') ? DB::table('provinces')->where('id', $request->province)->first()->name : 'Semua' ; 

    	$data = tb_product_sales::select('*')->with('category', 'district.regency.province')->where('product_status', $request->status);

		if($request->province != 'all'){
			$data = $data->whereHas('district.regency.province', function($query) use ($request){
				$query->where('id', $request->province);
			});
		}

		if($request->kategori != 'all'){
			$data = $data->whereHas('category', function($query) use ($request){
				$query->where('category_id', $request->kategori);
			});
		}

		if(!is_null($request->bulan)){
			$mth = (explode('-', $request->bulan)[0] < 10) ? str_replace('0', '', explode('-', $request->bulan)[0]) : explode('-', $request->bulan)[0];
			$data = $data->where(DB::raw('month(product_created_at)'), $mth);
		}

		$data = $data->get();
    	return view('admin.report.laporan_iklan.index', compact('data', 'request', 'province'));
    }

    public function export_pdf(Request $request){
    	// return $request->all();
    	$mth = (!is_null($request->bulan)) ? explode('-', $request->bulan)[0] : null;
    	$province = ($request->province != 'all') ? DB::table('provinces')->where('id', $request->province)->first()->name : 'Semua' ; 

    	$data = tb_product_sales::select('*')->with('category', 'district.regency.province')->where('product_status', $request->status);

		if($request->province != 'all'){
			$data = $data->whereHas('district.regency.province', function($query) use ($request){
				$query->where('id', $request->province);
			});
		}

		if($request->kategori != 'all'){
			$data = $data->whereHas('category', function($query) use ($request){
				$query->where('category_id', $request->kategori);
			});
		}

		if(!is_null($request->bulan)){
			$mth = (explode('-', $request->bulan)[0] < 10) ? str_replace('0', '', explode('-', $request->bulan)[0]) : explode('-', $request->bulan)[0];
			$data = $data->where(DB::raw('month(product_created_at)'), $mth);
		}

		$data = $data->get();

		$title = "Laporan_Iklan.xlsx";

    	return Excel::download(new test_export('admin.report.laporan_iklan.export.pdf', $data), $title);
    }
}
