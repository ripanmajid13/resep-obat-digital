<?php

namespace App\Models\Privileges;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as Model;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function navigation()
    {
        return $this->belongsTo(Navigation::class);
    }
}
