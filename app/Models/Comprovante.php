<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use User;

class Comprovante extends Model
{
    use SoftDeletes;

    use HasFactory;

    public function declaracao()
    {
        return $this->hasMany(Declaracao::class);
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
