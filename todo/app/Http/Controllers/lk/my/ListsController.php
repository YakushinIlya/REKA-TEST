<?php

namespace App\Http\Controllers\lk\my;

use App\Http\Controllers\Controller;
use App\Models\Todolists;
use Illuminate\Support\Facades\Auth;

class ListsController extends Controller
{
    public function __invoke()
    {
        $title = 'Мои списки';
        $user  = Auth::user();
        $lists = Todolists::where('author', $user->id)->orderByDesc('id')->paginate();

        return view('dashboard.my.lists', compact('title', 'lists'));
    }
}
