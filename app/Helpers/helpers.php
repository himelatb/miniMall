<?php
use App\Models\Cart;

function totalCartItems() {
    if(Auth::check()) {
        $total = Cart::where("user_id", Auth::user()->id)->count();
    }
    else {
        $total = Cart::where("session_id", Session::get("session_id"))->count();
    }
    return $total;
}
