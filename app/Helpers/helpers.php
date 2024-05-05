<?php
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;

function totalCartItems() {
    if(Auth::check()) {
        $total = Cart::where("user_id", Auth::user()->id)->count();
    }
    else {
        $total = Cart::where("session_id", Session::get("session_id"))->count();
    }
    return $total;
}

function totalUsers() {
    $total = User::count();
    return $total;
}

function totalProducts() {
    $total = Product::count();
    return $total;
}


