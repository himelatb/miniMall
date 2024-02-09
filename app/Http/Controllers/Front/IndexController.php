<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(){
        $banners = Banner::where(['status' => 1])->get()->sortBy('sort')->toArray();
        $products = Product::with('images')->where('status', 1)->get()->sortBy('created_at')->toArray();
        $categories = Category::tree();
        //dd($products);

        return view('front/index', compact('banners', 'products','categories'));
    }
}
