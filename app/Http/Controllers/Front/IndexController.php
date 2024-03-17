<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;



class IndexController extends Controller
{
    public function index(){
        $banners = Banner::where(['status' => 1])->get()->sortBy('sort')->toArray();
        $products = Product::with('images')->where('status', 1)->get()->sortBy('created_at')->toArray();
        $categories = Category::tree();
        //dd($products);

        return view('front/index', compact('banners', 'products','categories'));
    }

    public function showCart(){
        
        $cart = Cart::getCartItems();
        foreach ($cart as $key => $value) {
            if($value['product_qty'] == $value['attribute']['stock']){
                $value['maxStock'] = true;
            }
            else{
                $value['maxStock'] = false;
            }
            $value['total'] = $value['product_qty'] * $value['price'];
        }
        return view('front/cart', compact('cart'));
    }

    public function updateQty(Request $request){
        
        $id = $request->id;
        $qty = $request->qty;
        
        Cart::where('id', $id)->update(['product_qty'=> $qty]);
        $cart = Cart::getCartItems();
        foreach ($cart as $key => $value) {
            if($value['product_qty'] == $value['attribute']['stock']){
                $value['maxStock'] = true;
            }
            else{
                $value['maxStock'] = false;
            }
            $value['total'] = $value['product_qty'] * $value['price'];
        }

        return response()->json(['cart' => $cart]);
    }

    public function deleteCartItem(Request $request){
        
        Cart::destroy($request->id);

        $cart = Cart::getCartItems();
        foreach ($cart as $key => $value) {
            if($value['product_qty'] == $value['attribute']['stock']){
                $value['maxStock'] = true;
            }
            else{
                $value['maxStock'] = false;
            }
            $value['total'] = $value['product_qty'] * $value['price'];
        }
        
        return response()->json(['cart' => $cart]);
    }

    public function checkout(Request $request){
        return view('front/checkout');
    }
}
