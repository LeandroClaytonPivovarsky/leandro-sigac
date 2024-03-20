<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Resource extends Model
{
    use HasFactory;


    public function role()
    {
        return $this->belongsToMany(Role::class, 'permission');
    }
}
