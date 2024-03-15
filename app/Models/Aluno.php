<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Aluno extends Model
{
    use SoftDeletes;
    
    use HasFactory;

    public function comprovantes()
    {
        return $this->hasMany(Comprovante::class);
    }

    public function declaracao()
    {
        return $this->hasMany(Declaracao::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }
    
}
