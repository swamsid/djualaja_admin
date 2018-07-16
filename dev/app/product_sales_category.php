<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_sales_category extends Model
{
    protected $table = "product_sales_category";
    protected $primaryKey = ["category_id", "product_id"];
    public $incrementing = false;
    public $timestamps = false;

    public function categories(){
    	return $this->belongsTo('App\Category', 'category_id', 'id');
    }
}
