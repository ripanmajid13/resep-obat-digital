<?php

namespace App\Models\Privileges;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Navigation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('position');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function getPermissionParent($child)
    {
        $data = array();
        foreach ($child as $getChildOne) {
            if ($getChildOne->url) {
                $data[] = $getChildOne->permissions->first()->name;
            } else {
                foreach ($getChildOne->children as $getChildTwo) {
                    $data[] = $getChildTwo->permissions->first()->name;
                }
            }
        }
        return $data;
    }

    public function getPermissionChild($child)
    {
        $data = array();
        foreach ($child as $getChildTwo) {
            $data[] = $getChildTwo->permissions->first()->name;
        }
        return $data;
    }
}
