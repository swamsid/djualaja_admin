<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

use Auth;

use Session;

use URL;

class koin_controller extends Controller
{
    public function index(){
    	return view('admin.master_koin.index');
    }
}
