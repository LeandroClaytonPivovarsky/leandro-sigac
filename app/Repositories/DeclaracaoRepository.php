<?php

use App\Models\Declaracao;
use App\Repositories\Repository;

class DeclaracaoRepository extends Repository{
    public function __construct() {
        parent::__construct(new Declaracao());
    }
}