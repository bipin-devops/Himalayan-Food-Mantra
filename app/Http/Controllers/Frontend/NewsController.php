<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function newsList()
    {
        $news = News::all();
        return view('Frontend.news-list', compact('news'));
    }


    public function newsDetail($slug)
    {
        $newsDetail = News::where('slug', $slug)->first();

        return view('Frontend.news-detail', compact('newsDetail'));

    }
}
