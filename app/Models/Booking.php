<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    //
    use SoftDeletes;
    protected $table = 'booking';
    public function scopeActive($query) {
        return $query->where('is_active', '=', 1);
    }

    public function booking_metas() {
    	return $this->hasMany(BookingMeta::class);
    }

    public function booking_metas_count() {
    	return $this->hasMany(BookingMeta::class)->count;
    }
}
