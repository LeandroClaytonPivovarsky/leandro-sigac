<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Repository;

class PermissionRepository extends Repository{
    public function __construct() {
        parent::__construct(new Permission());
    }
}