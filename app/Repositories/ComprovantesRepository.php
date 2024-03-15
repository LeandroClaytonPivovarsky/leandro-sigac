<?php

use App\Models\Comprovante;
use App\Repositories\Repository;

class ComprovantesRepository extends Repository{
    public function __construct() {
        parent::__construct(new Comprovante());
    }
}