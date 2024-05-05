<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductAttribute;
use App\Models\Coupon;
use App\Models\Order;
use Session;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request){
        if($request['sku_id'] == null){
            return response()->json(['success' => false, 'message'=> 'please select size and color']);
        }
        else{
            $productAttr = ProductAttribute::find( $request['sku_id']);
            if( $productAttr['stock'] < $request['qty'] ){
                return response()->json(['success' => false, 'message'=> 'Required quantity is not available!']);
            }
            else{
                if(empty(Session::get('session_id'))){
                    $session_id = Session::getId();
                    $request->session()->put('session_id', $session_id);
                }
                else{
                    $session_id = Session::get('session_id');
                }

                if(Auth::check()){
                    $user_id = Auth::user()->id;
                    $countProducts = Cart::where(['product_id' => $request['product_id'], 
                    'sku_id'=> $request['sku_id'], 'user_id' => $user_id,
                    'session_id'=> $session_id])->count();
                }
                else{
                    $countProducts = Cart::where(['product_id' => $request['product_id'], 'sku_id'=> $request['sku_id'], 'session_id'=> $session_id])->count();
                }
                
                if($countProducts > 0){
                    return response()->json(['success' => false, 'message'=> 'This product is already in the Cart!']);
                }
                else{
                    $item = new Cart();
                    $item->session_id = $session_id;
                    if(Auth::check()){
                        $item->user_id = Auth::user()->id;
                    }
                    $item->product_id = $request['product_id'];
                    $item->product_qty = $request['qty'];
                    $item->price = $request['price'];
                    $item->sku_id = $request['sku_id'];
                    $item->save();
                    $totalCartItems = totalCartItems();
                    return response()->json(['success' => true, 'totalCartItems'=> $totalCartItems]);
                }
            } 
        }
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

        Session::forget('coupon_amount');
        Session::forget('coupon_type');
        Session::forget('coupon_code');

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

        Session::forget('coupon_amount');
        Session::forget('coupon_type');
        Session::forget('coupon_code');
        
        return response()->json(['cart' => $cart]);
    }


    public function addCoupon(Request $request){
        if (!Auth::check()) {
            return response()->json(['status' => 'failed', 'message' => 'Please login to use coupon.']);
        } else {
            $request->validate([
                'coupon_code' => 'required|exists:coupons',
            ],
            [
                'coupon_code.required' => 'Please provide a valid coupon code.',
            ]);

            $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
            $flag = true;

            if ($coupon['status'] == 0) {
               $flag = false;
            }
            else{

                if ($coupon['coupon_type'] == 'Single') {
                    $couponExist = Order::where(['coupon_code' => $request->coupon_code, 'user_id' => Auth::user()->id])->count();
                    if ($couponExist > 0) {
                        $flag = false;
                    }
                }
                else {
                        if ($coupon['categories'] != '') {
                            $carts = Cart::getCartItems();
                            $couponCategories = explode(',', $coupon['categories']);
                            foreach ($carts as $cart) {
                                if(!in_array($cart->product->category_id, $couponCategories)){
                                    $flag = false;
                                }
                            }
                        }
                        if ($coupon['brands'] != '') {
                            $carts = Cart::getCartItems();
                            $couponBrands = explode(',', $coupon['brands']);
                            foreach ($carts as $cart) {
                                if(!in_array($cart->product->brand_id, $couponBrands)){
                                    $flag = false;
                                }
                            }
                        }
                        if ($coupon['users'] != '') {
                            $carts = Cart::getCartItems();
                            $couponUsers = explode(',', $coupon['users']);
                            foreach ($carts as $cart) {
                                if(!in_array(Auth::user()->email, $couponUsers)){
                                    $flag = false;
                                }
                            }
                        }
                    }
                }
    
           if ($flag) {
            Session::put('coupon_amount', $coupon->amount);
            Session::put('coupon_code', $coupon->coupon_code);
            Session::put('coupon_type', $coupon->amount_type);
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

            return response()->json(['status' => 'success', 'message' => 'Coupon added.', 'coupon' => $coupon, 'cart' => $cart]);
           } 
           else {
            return response()->json(['status' => 'failed', 'message' => 'Please provide a valid coupon code.']);
           }
           
        }
        
    }

    public function removeCoupon(){
        Session::forget('coupon_amount');
        Session::forget('coupon_type');
        Session::forget('coupon_code');

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

        return response()->json(['status' => 'success', 'cart' => $cart]);
    }
}
