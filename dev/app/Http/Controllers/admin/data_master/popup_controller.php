<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class popup_controller extends Controller
{
    public function index(){
    	return view('admin.master_popup.index');
    }

    public function save(Request $request){
    	return json_encode($request->all());
    }
}
