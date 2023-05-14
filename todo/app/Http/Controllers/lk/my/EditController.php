<?php

namespace App\Http\Controllers\lk\my;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use App\Models\Todolists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EditController extends Controller
{
    public function __invoke(int $id): string
    {
        $title = 'Редактировать список';
        $list  = Todolists::find($id);
        $user  = Auth::user();
        $tags  = Tags::all();
        if($user->can('update', $list)) {
            return view('dashboard.my.edit', compact('title', 'list', 'tags'));
        }

        return redirect()->route('lk.trust-lists')->with('warning', 'Доступ к редактированию запрещен');
    }
}
