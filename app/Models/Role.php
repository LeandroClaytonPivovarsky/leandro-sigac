<?php

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

}