<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
// use Image;
use Intervention\Image\Facades\Image As Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function uploadFile($file, $dir)
    {
        $filename = Str::random() . '.' . $file->extension();
        $image = Image::make($file)->resize(450, 450, function($constraint) { $constraint->aspectRatio(); });
        $destinationPath = public_path('uploads/' . $dir . '/thumbs/');
        $image->save($destinationPath.$filename);
        $file->move(public_path('uploads/' . $dir), $filename);
        return $filename;
    }

    protected function removeFile($file, $dir)
    {
        $path = public_path('uploads/' . $dir . '/' . $file);
        if (is_file($path)) { unlink($path); }
        $thumb_path = public_path('uploads/' . $dir . '/thumbs/' . $file);
        if (is_file($thumb_path)) { unlink($thumb_path); }
    }
}
