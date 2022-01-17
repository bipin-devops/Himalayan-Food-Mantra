<?php

namespace App\Helper;

use Intervention\Image\Facades\Image as Image;

class ImageUploadHelper
{
    public static function uploadImage($file = null, $path = null, $returnPath = null)
    {
        $image = $file;

        $paths = public_path() . $path;

        if (is_dir($paths) != true) {
            \File::makeDirectory($paths, $mode = 0755, true);
        }
        if ($file->getClientOriginalExtension() == 'jfif') {
            $filename = uniqid() . '.' . 'jpeg';
        } else {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        }

        $img = Image::make($image->getRealPath());

        $img->resize($img->width(), $img->height(), function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($paths . '/' . $filename);

        if ($returnPath) {
            return implode(DIRECTORY_SEPARATOR, [$returnPath, $filename]);
        }

        return $filename;
    }


    public static function uploadImages($files, $key_name, $path)
    {
        $filePath = [];
        $paths = public_path() . $path;
        foreach ($files as $file) {
            $image = $file;
            if (isset($key_name)) {
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $img = \Image::make($image->getRealPath());

                $img->resize($img->width(), $img->height(), function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->save($paths . '/' . $fileName);

                $filePath[] = $fileName;
            }
        }

        return $filePath;
    }
}
