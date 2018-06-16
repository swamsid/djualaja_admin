<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class master_user_controller extends Controller
{
    public function index(){
    	return view("admin.master_user.index");
    }
}
