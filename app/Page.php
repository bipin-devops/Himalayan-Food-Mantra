<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;
class Page extends Model
{
    protected $guarded = ['id'];

    public function getAllData($data = array())
    {

        $news = Page::query();
        if (isset($data['keywords'])) {
            $data = str_replace(' ', '', $data['keywords']);
            $news->whereRaw("(CONCAT_WS('',title)) LIKE LOWER('%" . (trim($data)) . "%')");
        }
        return $news->orderBy('created_at', 'desc')->paginate(20);
    }


    public function getImageUrlAttribute()
    {
        if ($this->cover_image && file_exists(public_path('storage/'. $this->cover_image))) {
            return URL::to('/storage/'. $this->cover_image);
        }
        return asset('admin/images/no_img.png');
    }
}
