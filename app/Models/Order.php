<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\products_images;
use App\Models\Order;

class Order extends Model
{
    use HasFactory;

    public function orderProducts(){
        return $this->hasMany('App\Models\OrderProducts')->with('product','attribute','images');
    }

    public function customer(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function shippingAddress(){
        return $this->hasOne('App\Models\UserAddresses', 'id', 'shipping_id');
    }

    public function billingAddress(){
        return $this->hasOne('App\Models\UserAddresses', 'id', 'billing_id');
    }

    public static function getUsersOrder(){
        $orders = Order::with('orderProducts')->where('user_id', Auth::user()->id)->get();

        foreach ($orders as $order) {
            foreach ($order->orderProducts as $product) {
                $product->image = products_images::where(['product_id' => $product->product_id, 'image_sort' => 1])->first()->image ?? '';

                $product->name = Product::where(['id' => $product->product_id])->first()->product_name;
                $attribute = ProductAttribute::where(['id' => $product->attribute_id])->first();
                $product->size = $attribute->size;
                $product->color = $attribute->color;
            }
        }

        return $orders;
    }
}
