<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class dashboard_controller extends Controller
{
    public function index(){
    	$iklan_hari_ini = count(DB::table('tb_product_sales')->where(DB::raw('date(product_created_at)'), date('Y-m-d'))->get());
    	$user_hari_ini = count(DB::table('users')->where(DB::raw('date(created_at)'), date('Y-m-d'))->get());
    	$total_token = DB::table('tb_token_transactions')->where(DB::raw('date(created_at)'), date('Y-m-d'))->sum('transaction_total');

    	return view ('admin.dashboard.index', compact('iklan_hari_ini', 'user_hari_ini', 'total_token'));
    }
}
