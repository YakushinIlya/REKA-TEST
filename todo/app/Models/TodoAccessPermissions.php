<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoAccessPermissions extends Model
{
    use HasFactory;

    protected $table = 'access_permissions';

    protected $fillable = [
        'user_id', 'todo_id', 'permission_id'
    ];
}
