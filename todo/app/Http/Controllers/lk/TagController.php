<?php

namespace App\Http\Controllers\lk;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use App\Models\Todolists;

class TagController extends Controller
{
    public function __invoke($id)
    {
        $tag   = Tags::findOrFail($id);
        $title = "Тег: ".$tag->title;
        $lists = $tag->todo()->get();

        return view('dashboard.tag', compact('title', 'tag', 'lists'));
    }
}
