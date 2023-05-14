<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function fullImage($file)
    {
        $img = Storage::disk('public')->put('images/full-img/', $file);

        return $img;
    }

    public static function previous($file)
    {
        $fileName = 'images/previous/'.Str::random(35) . '.' . $file->getClientOriginalExtension();
        $image = Image::make($file)->fit(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->stream();
        Storage::disk('public')->put($fileName, $image, 'public');

        return $fileName;
    }
}
