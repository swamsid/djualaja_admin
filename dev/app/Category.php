<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";

    public function children(){
    	return $this->hasMany('App\Category', 'parrent', 'id');
    }
}
