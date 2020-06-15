<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    //
    use SoftDeletes;

    protected $table = 'vessels';
    public function scopeActive($query) {
        return $query->where('is_active', '=', 1);
    }

    public function booking() {
        return $this->belongsTo(Booking::class, 'id', 'vessel_id');
    }
}
