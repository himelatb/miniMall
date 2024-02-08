<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;

class IndexController extends Controller
{
    public function index(){
        $sliders = Banner::where(['type' => 'Slider', 'status' => 1])->get()->sortBy('sort')->toArray();
        $offers = Banner::where(['type' => 'Offer', 'status' => 1])->get()->sortBy('sort')->toArray();
        $categories = Category::tree();
        //dd($categories);

        return view('front/index', compact('sliders', 'offers','categories'));
    }
}
