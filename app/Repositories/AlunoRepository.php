<?php

namespace App\Repositories;

use App\Models\Aluno;
use App\Repositories\Repository;

class AlunoRepository extends Repository{
    public function __construct() {
        parent::__construct(new Aluno());
    }
}