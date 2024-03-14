<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Eixo extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['nome'];


    public function curso()
    {
        return $this->hasMany(Curso::class);
    }
}
