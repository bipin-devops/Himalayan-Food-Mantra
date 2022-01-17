<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view('Frontend.gallery');
    }

    public function galleryDetail()
    {
        return view('Frontend.single-gallery');
    }
}
