<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\TodoAccessPermissions;
use App\Models\Todolists;

trait HasPermissionForTodo
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function todolists()
    {
        return $this->belongsToMany(Todolists::class);
    }

    public function todoAccessPermissions()
    {
        return $this->belongsToMany(TodoAccessPermissions::class);
    }
}
