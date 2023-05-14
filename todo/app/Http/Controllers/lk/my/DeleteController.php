<?php

namespace App\Http\Controllers\lk\my;

use App\Http\Controllers\Controller;
use App\Models\Todolists;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(int $id)
    {
        $user = Auth::user();
        $todo = Todolists::find($id);

        if($user->can('delete', $todo)) {
            Storage::delete('public/'.$todo->previous);
            Storage::delete('public/'.$todo->image);
            $todo->user()->detach();
            $todo->tag()->detach();
            $todo->delete();

            return true;
        }

        return false;
    }
}
