<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class tb_comment extends Model
{
    protected $table = "tb_comment";


    public function user(){
	    return $this->belongsTo('App\User', "user_id", "id");
    }

    public function reply_count($id){
	    return count(DB::table("tb_comment")->where("reply_from", $id)->get());
    }

    public function reply(){
	    return $this->hasMany('App\tb_comment', "reply_from", "id");
    }
}
