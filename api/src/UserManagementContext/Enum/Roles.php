<?php

namespace App\UserManagementContext\Enum;

enum Roles: string
{
    case ADMIN = 'ROLE_ADMIN';
    case USER = 'ROLE_USER';
    case PROVIDER = 'ROLE_PROVIDER';
}
