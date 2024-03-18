<?php

namespace App\Repositories;

use App\Models\Permissions;
use App\Repositories\Repository;

class PermissionsRepository extends Repository{
    public function __construct() {
        parent::__construct(new Permissions());
    }
}