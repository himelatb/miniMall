<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductAttribute;
use Session;
use Auth;

class ProductsController extends Controller
{
    public function getProduct($id){
        $product = Product::with(['attributes','images' => function ($query) {
            $query->orderBy('image_sort');},'brand'])->find($id);
        $products = Product::with('images')->where('status', 1)->where("is_featured", 'Yes')->get()->toArray();   
        $sizes = ProductAttribute::getProductSizes($id);
        $colors = ProductAttribute::getProductColors($id);

        // dd($colors, $sizes);

        return view('front/productDetails', compact('product','colors','sizes','products'));
    }

    public function getColorBySize(Request $request){
        $size = $request->size;
        $product_id = $request->product_id;
        $product_discount = $request->product_discount;


        $attributes = ProductAttribute::where(['product_id'=> $product_id,'size'=> $size])->get();
        foreach ($attributes as $attribute) {
            if($product_discount != null){
                $final_price = $attribute->price - ($product_discount * ( $product_discount /100));
            }
            else{
                $final_price = $attribute->price;
            }
            $attribute['final_price'] = $final_price;
        }

        
        return response()->json($attributes);
    }
}
