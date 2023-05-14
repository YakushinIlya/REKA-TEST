<?php

namespace App\Http\Controllers\lk;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use App\Models\Todolists;

class SearchController extends Controller
{
    public function __invoke($search)
    {
        $list = Todolists::where('title', 'LIKE', '%'.$search.'%')->get();

        return response()->json([
            "status"  => 200,
            "list" => $list,
        ], 200);
    }
}
