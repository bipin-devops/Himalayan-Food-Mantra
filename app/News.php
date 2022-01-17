<?php

namespace App;
use URL;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded=['id'];

    public function getAllData($data=array())
    {
        $news = News::query();
        if (isset($data['keywords'])) {
            $data = str_replace(' ', '', $data['keywords']);
            $news->whereRaw(" 		(CONCAT_WS('',title)) LIKE LOWER('%".(trim($data)) ."%')");
        }
        return $news->orderBy('created_at', 'desc')->paginate(20);
    }



    /**
     * Image url attribute
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('storage/'. $this->image))) {
            return URL::to('/storage/'. $this->image);
        }
        return asset('admin/images/no_img.png');
    }
}
