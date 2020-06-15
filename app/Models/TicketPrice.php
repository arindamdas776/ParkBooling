<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class TicketPrice extends Model
{
    use softDeletes;

    protected $fillable = ['name','VisitType','protected_area','adult_ticket_price(usd)','adult_ticket_price(egp)','child_ticket_price(usd)','child_ticket_price(egp'];

       public function scopeActive($query) {
        return $query->where('stauts', '=', 1);
    }
}
