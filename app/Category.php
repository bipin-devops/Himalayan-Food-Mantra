<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Category extends Model
{
    protected $guarded=['id'];

    public function getAllData($data=array())
    {
        $news = Category::query();
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

    public function product()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
}
