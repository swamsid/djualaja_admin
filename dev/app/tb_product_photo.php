<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_product_photo extends Model
{
    protected $table = "tb_product_photo";
    protected $primaryKey = "photo_id";
    public $timestamps = false;
}
