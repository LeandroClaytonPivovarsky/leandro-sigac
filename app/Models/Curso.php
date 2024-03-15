<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Curso extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function eixo()
    {
        return $this->belongsTo(Eixo::class);
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function aluno()
    {
        return $this->hasManyTo(Aluno::class);
    }

    public function turma()
    {
        return $this->hasManyTo(Turma::class);
    }

    public function categoria()
    {
        return $this->hasManyTo(Categoria::class);
    }
}
