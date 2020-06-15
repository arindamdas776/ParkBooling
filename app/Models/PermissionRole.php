<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    //
    protected $table = 'permission_role';

    public function ModuleName()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
