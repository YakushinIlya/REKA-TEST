<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolists extends Model
{
    use HasFactory;

    protected $table = "todolists";

    protected $fillable = [
        "title", "description", "image", "previous", "author",
    ];

    public function tag()
    {
        return $this->belongsToMany(Tags::class, 'tags_todolists', 'todo_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'access_permissions', 'todo_id', 'user_id');
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'access_permissions', 'todo_id', 'permission_id');
    }

    public function authorUser(){
        return $this->belongsTo(User::class, "author");
    }
}
