<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = "users";

    public function district(){
    	return $this->belongsTo('App\district', 'district_id', 'id');
    }
}
