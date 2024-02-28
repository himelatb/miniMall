<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
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
        // dd($cart);
        return view('front/cart', compact('cart'));
    }

    public function updateQty(Request $request){
        
        $id = $request->id;
        $qty = $request->qty;
        $stock = ProductAttribute::where('id', $request->sku_id)->get()->first();
        
        if($qty > $stock['stock']){
            return response()->json(['status' => false, 'massage' => 'Stock quantity is not available!!']);
        }
        else{

            Cart::where('id', $id)->update(['product_qty'=> $qty]);
            return response()->json(['status' => true]);
        }
        
    }

    public function deleteCartItem(Request $request){
        
        Cart::destroy($request->id);

        return response()->json(['success' => true]);
    }
}
