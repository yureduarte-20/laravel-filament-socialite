<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelRole;
class Role extends ModelRole
{
    const ADMIN_ROLE_NAME = "admin";
    const SIMPLE_USER_ROLE_NAME = "simple_user";
    use HasFactory;
}
