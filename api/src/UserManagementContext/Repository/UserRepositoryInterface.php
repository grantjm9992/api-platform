<?php

namespace App\UserManagementContext\Repository;

use App\UserManagementContext\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
}
