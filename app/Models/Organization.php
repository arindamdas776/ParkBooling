<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Organization extends Authenticatable
{
    //
    protected $table = 'organization';

    public function OrganizationLog()
    {
        return $this->hasMany(OrganizationLog::class, 'org_id','id');
    }
}
