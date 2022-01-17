<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories=Category::orderBy('created_at', "DESC")->get();
        return view('Frontend.menu',compact('categories'));
    }

    public function productDetail($slug)
    {

        $productDetail = Product::where('slug', $slug)->first();
        $products = Product::take(3)->orderBy('created_at', "DESC")->get();

        return view('Frontend.product-detail', compact('productDetail','products'));

    }


    public function categoryProduct($id)
    {

        $products = Product::where('category_id', $id)->get();

        $category = Category::where('id', $id)->first();


        return view('Frontend.category-product', compact('products','category'));

    }
}
