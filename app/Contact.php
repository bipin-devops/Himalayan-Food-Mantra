<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded=['id'];

    public function getAllData($data=array())
    {
        $news = Contact::query();
        if (isset($data['keywords'])) {
            $data = str_replace(' ', '', $data['keywords']);
            $news->whereRaw(" 		(CONCAT_WS('',full_name)) LIKE LOWER('%".(trim($data)) ."%')");
        }
        return $news->orderBy('created_at', 'desc')->paginate(20);
    }
}
