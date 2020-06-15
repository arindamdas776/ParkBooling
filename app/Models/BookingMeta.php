<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingMeta extends Model
{
    //
    use SoftDeletes;
    protected $table = 'booking_meta';
    public function scopeActive($query) {
        return $query->where('is_active', '=', 1);
    }
}
