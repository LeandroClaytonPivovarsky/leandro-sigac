<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Repositories\Repository;

class CategoriaRepository extends Repository{
    public function __construct() {
        parent::__construct(new Categoria());
    }
}