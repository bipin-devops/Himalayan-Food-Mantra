<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;
class Setting extends Model
{
    protected $guarded=['id'];
    private static $path = '/uploads/setting';
//    public function upload($file)
//    {
//        $imageName = $file->getClientOriginalName();
//
//        $fileName = date('Y-m-d-h-i-s') . '-' . preg_replace('[ ]', '-', $imageName);
//        $file->move(public_path() . self::$path, $fileName);
//
//        return $fileName;
//    }


    public function getImageUrlAttribute()
    {
        if ($this->logo && file_exists(public_path('storage/'. $this->logo))) {
            return URL::to('/storage/'. $this->logo);
        }
        return asset('admin/images/no_img.png');
    }


}