<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Repository;

class UsersRepository extends Repository{
    public function __construct() {
        parent::__construct(new User());
    }
}