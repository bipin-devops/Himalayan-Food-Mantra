<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Product extends Model
{
    protected $guarded=['id'];

    public function getAllData($data=array())
    {
        $news = Product::query();
        if (isset($data['keywords'])) {
            $data = str_replace(' ', '', $data['keywords']);
            $news->whereRaw(" 		(CONCAT_WS('',title)) LIKE LOWER('%".(trim($data)) ."%')");
        }
        return $news->orderBy('created_at', 'desc')->paginate(20);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
