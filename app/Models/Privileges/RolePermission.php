<?php

namespace App\Models\Privileges;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $table = "role_has_permissions";

    public $timestamps = false;

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
