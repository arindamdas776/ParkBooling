<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;
    protected $table = 'modules';

    public function permisionRole()
    {
        return $this->hasMany(PermissionRole::class, 'module_id', 'id');
    }

}
