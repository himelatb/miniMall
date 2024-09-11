<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\productAttribute;
use App\Models\OrderProducts;
use App\Models\UserAddresses;
use App\Models\OrderLog;
use Auth;
use Session;
use Mail;
Use DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request){
        $cart = Cart::getCartItems();
        if ($request->isMethod('post')) {
            $request->validate([
                'billing' => 'required',
                'payment' => 'required',
            ],[
                'billing.required' => 'Please select a billing address.',
                'payment.required' => 'Please select a payment method.',
            ]);

            $shipping = $request->billing;

            if (isset($request->shipping)) {
               $shipping = $request->shipping;
            }

            Session::put('billingAddress', $request->billing);
            Session::put('shippingAddress', $shipping);
            Session::put('paymentMethod', $request->payment);
            $billingAddress = UserAddresses::where('id', $request->billing)->first();
            $shippingAddress = UserAddresses::where('id', $shipping)->first();
            $email = Auth::user()->email;
            
        $delivery_charge = 10;
        $totalCost = $delivery_charge;

        foreach($cart as $product){
            $totalCost += $product['product_qty'] * $product['price'];
        }

        if (Session::has('coupon_amount')) {
            $totalCost += Session::get('coupon_type') == 'Fixed'? Session::get('coupon_amount') : $totalCost * Session::get('coupon_amount') / 100;
        }

        // return view('front/summary', compact('cart', 'billingAddress', 'shippingAddress','email','totalCost'));
        
        if ($request->payment == 'cod') {
            return view('front/summary', compact('cart', 'billingAddress', 'shippingAddress','email','totalCost'));
        }
        else{
            return view('front/exampleEasycheckout', compact('cart', 'billingAddress', 'email','totalCost'));
        }
        }
        else{
            $countries = Country::get();
            $states = Country::get();
            $addresses = UserAddresses::where('user_id', Auth::user()->id)->get();
    
            return view('front/checkout', compact('countries', 'addresses','states', 'cart'));
        }
    }

    public function getAddress(Request $request){
        $address = UserAddresses::where('id', $request->id)->first();
        $states = Country::with('state')->where('name', $request->country)->get()->first()->state;
        return response()->json(['address' => $address, 'states' => $states]);
    }

    public function addAddress(Request $request){

            $request->validate([
                'country'=> 'required',
                'address'=> 'required',
                'district'=> 'required',
            ]);
            $name = $request->name != null ? $request->name: Auth::user()->name;
            $mobile = $request->mobile != null ? $request->mobile: Auth::user()->mobile;
            UserAddresses::insert([
                'user_id' => Auth::user()->id,
                'name' => $name,
                'mobile' => $mobile,
                'address' => $request->address,
                'country' => $request->country,
                'district' => $request->district,
                'town' => $request->town,
                'road_house' => $request->road_house,
                'zipcode' => $request->zipcode
            ]);
            return response()->json(['status' => 'success']);
    }

    public function updateAddress(Request $request){
        $request->validate([
            'edit_country'=> 'required',
            'edit_address'=> 'required',
            'edit_district'=> 'required',
        ],
        [
            'edit_country.required' => 'country field can not be empty.',
            'edit_district.required' => 'district field can not be empty.',
            'edit_address.required' => 'address field can not be empty.',
        ]
        );
        $name = $request->edit_name != null ? $request->edit_name: Auth::user()->name;
        $mobile = $request->edit_mobile != null ? $request->edit_mobile: Auth::user()->mobile;
        UserAddresses::where('id', $request->id)->update([
            'user_id' => Auth::user()->id,
            'name' => $name,
            'mobile' => $mobile,
            'address' => $request->edit_address,
            'country' => $request->edit_country,
            'district' => $request->edit_district,
            'town' => $request->edit_town,
            'road_house' => $request->edit_road_house,
            'zipcode' => $request->edit_zipcode
        ]);
        $address= UserAddresses::where('id', $request->id)->first();
        return response()->json($address);
    }

    public function deleteAddress(Request $request){
        UserAddresses::where('id', $request->id)->delete();
        
        return response()->json(['status' => 'success']);
    }

    public function placeOrder(){
        $cart = Cart::getCartItems();
        $delivery_charge = 10;
        $total = $delivery_charge;

        foreach($cart as $product){
            $total += $product['product_qty'] * $product['price'];
        }

        if (Session::has('coupon_amount')) {
            $total += Session::get('coupon_type') == 'Fixed'? Session::get('coupon_amount') : $total * Session::get('coupon_amount') / 100;
        }

        DB::beginTransaction();

        $order = new Order;

        $order->user_id = Auth::user()->id;
        $order->billing_id = Session::get('billingAddress');
        $order->shipping_id = Session::get('shippingAddress');
        $order->total = $total;
        $order->coupon_code = Session::get('coupon_code');
        $order->coupon_amount = Session::get('coupon_amount');
        $order->payment_method = Session::get('paymentMethod');
        $order->delivery_charge = $delivery_charge;
        $order->save();

        foreach($cart as $product){
            $orderProduct = new OrderProducts;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->product_id;
            $orderProduct->attribute_id = $product->sku_id;  
            $orderProduct->qty = $product->product_qty; 
            $orderProduct->price = $product->product_qty * $product->price;
            $orderProduct->save();

            productAttribute::where('id', $product->sku_id)->decrement('stock', $product->product_qty);
            $product->delete();
        }

        Session::forget('billingAddress');
        Session::forget('shippingAddress');
        Session::forget('paymentMethod');
        Session::forget('coupon_type');
        Session::forget('coupon_amount');
        Session::forget('coupon_code');

        $message = " Order has been placed (Order ID: ".$order->id."). Thank you for shopping with us.";
        $products = OrderProducts::with('images')->where('order_id', $order->id)->get();
        foreach ($products as $product) {
            $product->name = Product::where('id', $product->product_id)->first()->product_name;
            $product->color = productAttribute::where('id', $product->attribute_id)->first()->color;
            $product->size = productAttribute::where('id', $product->attribute_id)->first()->size;
            
        }

        $orderLog = new OrderLog;

        $orderLog->order_id = $order->id;
        $orderLog->status = 'Pending';
        $orderLog->save();

        $userData = ['email' => Auth::user()->email,'name'=> Auth::user()->name, 
        'msg' => $message, 
        'order' => $order, 
        'billingAddress' => UserAddresses::where('id', $order->billing_id)->first(), 
        'shippingAddress' => UserAddresses::where('id', $order->shipping_id)->first(), 
        'products' => $products];
        Mail::send('email.order', $userData, function ($message) use($userData){
            $message->to($userData['email'], $userData['name']);
            $message->subject('Order Placed. miniMall');
        });

        DB::commit();

        return view('front/confirmationNotification',compact('message'));

    }

}
