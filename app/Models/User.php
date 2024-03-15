<?php

namespace App\Models;

use App\Models\Aluno;
use App\Models\Comprovante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Curso;
use App\Models\Documento;

class User extends Model{

    use HasFactory;
    
    use SoftDeletes;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function documento()
    {
        return $this->hasMany(Documento::class);

    }

    public function aluno()
    {
        return $this->hasOne(Aluno::class);
    }

    public function comprovante()
    {
        return $this->hasManyTo(Comprovante::class);
    }
}