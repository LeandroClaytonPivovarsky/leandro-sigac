<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Permission extends Model
{
    use HasFactory;

    use SoftDeletes;

    private static $keys = ['role_id', 'resource_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function resource()
    {
        return $this->belongsToMany(Resource::class);
    }

    public static function getKeys()
    {
        return self::$keys;
    }
}
