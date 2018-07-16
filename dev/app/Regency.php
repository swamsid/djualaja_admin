<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{

	protected $table = "regencies";

    public function province()
    {
    	return $this->belongsTo('App\Province');
    }

    public function districts()
    {
    	return $this->hasMany('App\District');
    }
}
