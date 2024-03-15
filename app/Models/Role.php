<?php

namespace App\Models;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model{

    use HasFactory;

    use SoftDeletes;

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function permission()
    {
        return $this->belongsToMany(Resource::class, 'permisson');
    }

}