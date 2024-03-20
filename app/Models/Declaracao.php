<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Declaracao extends Model
{
    use HasFactory;


    protected $table = "declaracoes";


    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function comprovante()
    {
        return $this->belongsTo(Comprovante::class);
    }
}
