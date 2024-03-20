<?php

namespace App\Repositories;

use App\Models\Comprovante;
use App\Repositories\Repository;

class ComprovanteRepository extends Repository{
    public function __construct() {
        parent::__construct(new Comprovante());
    }
}