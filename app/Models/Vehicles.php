<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Vehicles extends Model
{
    use softDeletes;

    protected $fillable = ['vehicle_name', 'logo', 'description', 'type', 'protected_area', 'daily_ticket_price_usd', 'daily_ticket_price_ESD', 'safari_ticket_price_USD', 'safary_ticket_price_ESD'];
    protected $dates = ['deleted_at'];

    public function scopeActive($query) {
        return $query->where('stauts', '=', 1);
    }

    public function ProtectedAreas(){
    	return $this->hasMany('App\ProtectedArea');
    }
}