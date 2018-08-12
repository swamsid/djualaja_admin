<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_reports extends Model
{
    protected $table = 'tb_reports';
    protected $primaryKey = ['product_id', 'user_id'];
    public $incrementing = false;

    function iklan(){
    	return $this->belongsTo('App\tb_product_sales', 'product_id', 'product_id');
    }

    function user(){
    	return $this->belongsTo('App\user', 'user_id', 'id');
    }
}
