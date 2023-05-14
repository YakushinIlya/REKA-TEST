<?php

namespace App\Http\Controllers\lk\my;

use App\Http\Controllers\Controller;
use App\Models\Tags;

class AddController extends Controller
{
    public function __invoke()
    {
        $title = 'Добавить список';
        $tags  = Tags::all();

        return view('dashboard.my.add', compact('title', 'tags'));
    }
}
