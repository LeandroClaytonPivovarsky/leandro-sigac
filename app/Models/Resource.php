<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Role;

class Resource extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function permission()
    {
        return $this->belongsToMany(Role::class, 'permission');
    }
}