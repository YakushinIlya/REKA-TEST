<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $table = "tags";

    protected $fillable = [
        "title",
    ];

    public $timestamps = false;

    public function todo()
    {
        return $this->belongsToMany(Todolists::class, 'tags_todolists', 'tag_id', 'todo_id');
    }
}
