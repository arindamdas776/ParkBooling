<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    use SoftDeletes;

    public function scopeActive($query)
    {
        return $query->where('is_active', '1');
    }
}
