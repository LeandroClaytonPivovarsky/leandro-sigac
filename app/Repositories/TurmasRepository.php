<?php

namespace App\Repositories;

use App\Models\Turma;
use App\Repositories\Repository;

class TurmasRepository extends Repository{

    public function __construct() {
        parent::__construct(new Turma());
    }
}