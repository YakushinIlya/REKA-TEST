<?php

namespace App\Http\Controllers\lk\trust;

use App\Http\Controllers\Controller;
use App\Models\Todolists;
use Illuminate\Support\Facades\Auth;

class ListsController extends Controller
{
    public function __invoke()
    {
        $title = 'Доверенные мне списки';
        $user  = Auth::user();
        $lists = Todolists::whereHas('user', function ($query) use ($user) {
            $query->select('*')->whereHas('accessPermission', function ($query) use ($user) {
                $query->whereRaw('user_id=? && permission_id=?', [$user->id, 1]);
            });
            $query->select('*')->where('user_id', $user->id);
        })
            ->orderBy('id', 'DESC')
            ->get();

        return view('dashboard.trust.lists', compact('title', 'lists'));
    }
}
