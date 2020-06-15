<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProtectedArea extends Model
{
    //
    use SoftDeletes;

    public function scopeActive($query)
    {
        return $query->where('is_active', '1');
    }

    public function Vehicles(){
    	return $this->belongsTo('App\Vehicles');
    }

}
