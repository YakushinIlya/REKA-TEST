<?php

namespace App\Http\Controllers\lk\my;

use App\Http\Controllers\Controller;
use App\Models\TodoAccessPermissions;
use Illuminate\Http\Request;

class UpdatePermissionController extends Controller
{
    public function __invoke(Request $request, int $id)
    {
        TodoAccessPermissions::create([
            'user_id'       => $request->user,
            'todo_id'       => $id,
            'permission_id' => $request->permission,
        ]);

        return response()->json([
            "status"  => 201,
            "message" => "Права пользователю предоставлены",
        ], 201);
    }
}
