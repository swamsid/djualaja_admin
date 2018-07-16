<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_sales_feature extends Model
{
    protected $table = "product_sales_feature";
    protected $primaryKey = ["product_id", "features_paid_id"];
    public $incrementing = false;
    public $timestamps = false;
}
