<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = "users";

    public function district(){
    	return $this->belongsTo('App\District', 'district_id', 'id');
    }

    public function iklan(){
    	return $this->hasMany('App\tb_product_sales', 'user_id', 'id');
    }
}
