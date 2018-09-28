<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

use DB;

class dashboard_controller extends Controller
{
    public function index(){

        $today = date_create(date('Y-m-d'));
        $date_week = date_create(date('Y-m-d', strtotime('-7 days')));
        $date_mobth = date_create(date('Y-m-d', strtotime('-30 days')));

        $tanggal_chart = []; $nilai_chart = [];

        for ($i = 5; $i >= 1; $i--) {
           $date_create = date_create(date('Y-m-d', strtotime('-'.$i.' days')));
           array_push($tanggal_chart, date('j M', strtotime('-'.$i.' days')));
           array_push($nilai_chart, count(Analytics::fetchVisitorsAndPageViews(Period::create($date_create, $date_create))));
        }

        $encode_tanggal_chart = json_encode($tanggal_chart);
        $encode_nilai_chart = json_encode($nilai_chart);

        // return $nilai_chart;

        // return Analytics::fetchMostVisitedPages(Period::create($today, $today), 3);
        // return Analytics::fetchTopBrowsers(Period::create($today, $today), 10);

        $top_browser = Analytics::fetchTopBrowsers(Period::create($today, $today), 4);

        // return $date_week;

        $top_iklan = DB::table('tb_product_sales')->select('product_id', 'product_no', 'product_name', DB::raw('max(product_counter) as counter'))
                        ->whereNull('product_deleted_at')
                        ->whereNull('banned_at')
                        ->where('product_status', 'approved')
                        ->groupBy('product_id', 'product_name', 'product_no')
                        ->orderBy('counter', 'desc')->first();

        // return json_encode($top_iklan);

        $day = count(Analytics::fetchVisitorsAndPageViews(Period::create($today, $today)));
        $week = count(Analytics::fetchVisitorsAndPageViews(Period::create($date_week, $today)));
        $month = count(Analytics::fetchVisitorsAndPageViews(Period::create($date_mobth, $today)));

    	$iklan_hari_ini = count(DB::table('tb_product_sales')->where(DB::raw('date(product_created_at)'), date('Y-m-d'))->get());
    	$user_hari_ini = count(DB::table('users')->where(DB::raw('date(created_at)'), date('Y-m-d'))->get());

    	$iklan_bulan_ini = count(DB::table('tb_product_sales')->where([[DB::raw('month(product_created_at)'),'=',date('m')], [DB::raw('year(product_created_at)'),'=',date('Y')]])->get());
    	$user_bulan_ini = count(DB::table('users')->where([[DB::raw('month(created_at)'),'=',date('m')], [DB::raw('year(created_at)'),'=',date('Y')]])->get());

    	$iklan = DB::table('tb_product_sales')->get();
    	$users = DB::table('users')->get();

    	$total_token = DB::table('tb_token_transactions')->where(DB::raw('date(created_at)'), date('Y-m-d'))->sum('transaction_total');

    	return view ('admin.dashboard.index', compact('iklan_hari_ini', 'user_hari_ini', 'iklan_bulan_ini', 'user_bulan_ini', 'total_token', 'iklan', 'users', 'month', 'week', 'day', 'encode_nilai_chart', 'encode_tanggal_chart', 'top_browser', 'top_iklan'));
    }
}
