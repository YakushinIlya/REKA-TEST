<?php

namespace App\Http\Controllers\lk\my;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Models\Tags;
use App\Models\Todolists;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(TodoRequest $updateRequest, int $id)
    {
        $user = Auth::user();
        $todo = Todolists::find($id);

        if(!$user->can('update', $todo)) {
            return response()->json([
                "status"  => 403,
                "message" => "Доступ к редактированию запрещен",
            ], 403);
        }

        $data = $updateRequest->validated();

        if ($updateRequest->hasFile('image')) {
            Storage::delete('public/'.$todo->previous);
            Storage::delete('public/'.$todo->image);
            $file = $updateRequest->file('image');
            $data["image"]    = ImageHelper::fullImage($file);
            $data["previous"] = ImageHelper::previous($file);
        }

        $data["author"] = $user->id;
        $todo->update($data);
        $todo->tag()->detach();
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
            "message" => "Редактирование прошло успешно",
        ], 201);
    }
}
