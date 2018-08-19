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
    	return view('admin.transaksi_koin.index');
    }

    public function list(){
    	$data = DB::table('tb_token_transactions')->whereNull('deleted_at')->orderBy('created_at', 'desc')->get();

    	return json_encode($data);
    }

    public function get_transaksi(Request $request){
    	$data = DB::table('tb_token_transactions')->where('id', $request->id)->whereNull('deleted_at')->first();
    	
    	return json_encode($data);
    }

    public function update_status(Request $request){
        // return json_encode($request->all());

        $data = DB::table('tb_token_transactions')->where("id", $request->id);

        if(!$data->first()){
            $response = [
                'status'    => 'invalid',
            ];
        
            return json_encode($response);
        }

        // update koin user -> belumm

        $data->update([ "transaction_status"    => 'Confirmed' ]);

        $response = [
            'status'    => 'berhasil',
            'content'   => $request->status,
        ];
        
        return json_encode($response);
    }
}
