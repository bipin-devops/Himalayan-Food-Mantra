<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Banner;
use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use App\Page;
use App\Product;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::take(6)->orderBy('created_at', "DESC")->get();
        $categories = Category::orderBy('created_at', "DESC")->get();
        $orderDish = Page::where('slug', 'order-dish')->first();
        $makePayment = Page::where('slug', 'make-payment')->first();
        $receiveFood = Page::where('slug', 'receive-food')->first();
        return view('Frontend.home.index', ['products' => $products, 'category' => $categories, 'orderDish' => $orderDish, 'makePayment' => $makePayment, 'receiveFood' => $receiveFood]);
    }
}
