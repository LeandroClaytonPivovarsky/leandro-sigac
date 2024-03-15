<?php

use App\Models\Aluno;
use App\Repositories\Repository;

class AlunosRepository extends Repository{
    public function __construct() {
        parent::__construct(new Aluno());
    }
}