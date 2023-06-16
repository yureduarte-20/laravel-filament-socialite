<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as ModelPermission;
class Permission extends ModelPermission
{
    const GRANT_ACCESS_PANEL = "access_panel";
    use HasFactory;
}
