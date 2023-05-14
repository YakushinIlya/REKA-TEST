<?php

namespace App\Http\Controllers\lk\my;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Models\Permission;
use App\Models\Tags;
use App\Models\TodoAccessPermissions;
use App\Models\Todolists;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ImageHelper;

class CreateController extends Controller
{
    public function __invoke(TodoRequest $createRequest)
    {
        $user = Auth::user();
        $data = $createRequest->validated();
        if ($createRequest->hasFile('image')) {
            $file = $createRequest->file('image');
            $data["image"]    = ImageHelper::fullImage($file);
            $data["previous"] = ImageHelper::previous($file);
        }

        $data["author"] = $user->id;

        $todo = Todolists::create($data);
        foreach(Permission::all() as $permission){
            TodoAccessPermissions::create([
                'user_id'       => $data["author"],
                'todo_id'       => $todo->id,
                'permission_id' => $permission->id,
            ]);
        }
        foreach(json_decode($data["tags"]) as $tag){
            $tags = Tags::updateOrCreate([
                'title' => $tag,
            ],
                [
                'title' => $tag,
            ]);
            $todo->tag()->attach($tags->id);
        }

        return response()->json([
            "status"  => 201,
            "message" => "Создание записи прошло успешно",
        ], 201);
    }
}
