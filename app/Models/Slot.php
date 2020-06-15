<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //
    use SoftDeletes;
    protected $table = 'slots';

    public function sites()
    {
    	return $this->belongsTo(Site::class);
    }

    public function postBookings()
    {
        return $this->hasMany(Booking::class)->whereDate('date', '>=', date('Y-m-d'));
    }
}
