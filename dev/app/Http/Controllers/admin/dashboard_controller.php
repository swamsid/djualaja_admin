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

    	$iklan_bulan_ini = count(DB::table('tb_product_sales')->where([[DB::raw('month(product_created_at)'),'=',date('m')], [DB::raw('year(product_created_at)'),'=',date('Y')]])->get());
    	$user_bulan_ini = count(DB::table('users')->where([[DB::raw('month(created_at)'),'=',date('m')], [DB::raw('year(created_at)'),'=',date('Y')]])->get());

    	$iklan = DB::table('tb_product_sales')->get();
    	$users = DB::table('users')->get();

    	$total_token = DB::table('tb_token_transactions')->where(DB::raw('date(created_at)'), date('Y-m-d'))->sum('transaction_total');

    	return view ('admin.dashboard.index', compact('iklan_hari_ini', 'user_hari_ini', 'iklan_bulan_ini', 'user_bulan_ini', 'total_token', 'iklan', 'users'));
    }
}
