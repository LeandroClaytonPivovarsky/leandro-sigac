<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{
    use HasFactory;

    protected $table = "permission_resource";

    private static $keys = ['role_id', 'resource_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public static function getKeys()
    {
        return self::$keys;
    }
}
