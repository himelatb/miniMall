<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class Cart extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasOne('App\Models\Product','id', 'product_id');
    }

    public function attribute()
    {
        return $this->hasOne('App\Models\ProductAttribute','id', 'sku_id');
    }
    public function images(){
        return $this->hasMany('App\Models\products_images','product_id','product_id');
    }

    public static function getCartItems(){
        $session_id = Session::get('session_id');
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $cart = Cart::with('product', 'attribute','images')
            ->where(['user_id' => $user_id])->get();
        }
        else{
            $cart = Cart::with('product', 'attribute','images')->where(['session_id' => $session_id])->get();
        }

        return $cart;
    }
}
