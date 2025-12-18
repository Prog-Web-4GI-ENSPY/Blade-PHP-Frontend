<?php

namespace App\Enums;

enum Roles: string
{
    case SUPERADMIN = 'superAdmin';
    case ADMIN = 'admin';
    case USER = 'user';
}
