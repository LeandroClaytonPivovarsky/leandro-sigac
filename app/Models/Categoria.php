<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    use HasFactory;

    public function documento()
    {
        return $this->hasMany(Documento::class);
    }

    public function comprovante()
    {
        return $this->hasMany(Comprovante::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
