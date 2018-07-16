<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class tb_product_sales extends Model
{
    protected $table = "tb_product_sales";
    protected $primaryKey = "product_id";

    public function photos(){
    	return $this->hasMany('App\tb_product_photo', 'product_id', 'product_id');
    }

    public function features(){
    	return $this->hasMany('App\product_sales_feature', 'product_id', 'product_id');
    }

    public function category(){
    	return $this->hasMany('App\product_sales_category', 'product_id', 'product_id');
    }

    public function district(){
    	return $this->belongsTo('App\District', 'product_district', 'id');
    }

    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comment(){
        return $this->hasMany('App\tb_comment', 'ads_id', 'product_id');
    }

    public function count_comment($id){
        return DB::table("tb_comment")->where("ads_id", $id)->count();
    }
}
