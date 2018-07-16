<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function regency()
    {
    	return $this->belongsTo('App\Regency');
    }
}
