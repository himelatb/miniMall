<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Order;
use App\Models\UserAddresses;
use App\Models\OrderProducts;
use App\Models\Product;
use App\Models\productAttribute;
use App\Models\OrderLog;
use Hash;
use Auth;
use Session;
use Validator;
use Mail;

class UserController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('POST')){
            $request->validate([
                'email'=> 'required|email',
                'password'=> 'required',
            ]);
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                if (isset($request['remember'])&&!empty($request['remember'])) {
                    setcookie('email',$request["email"]);
                    setcookie('password',$request["password"]);
                } else {
                    setcookie('email','');
                    setcookie('password','');
                }
                if(!empty(Session::get('session_id'))){
                    Cart::where('session_id', Session::get('session_id'))->update(['user_id' => Auth::id()]);
                }
                return redirect('/miniMall');
            }
            else{
                return view('front/login_register')->with(['error'=> 'Wrong Credentials!!','login'=> true]);
            }
        }
        $login = true;
        return view('front/login_register', compact('login'));
    }

    public function register(Request $request){

        if($request->isMethod('POST')){
            $validator = Validator::make($request->all(),[
                'email'=> 'required|email|unique:users,email',
                'password'=> 'required|confirmed',
                'name'=> 'required|max:255',
                'terms' => 'accepted',
            ]);
            if($validator->passes()){
                $user = User::create([
                    'email'=> $request->email,
                    'password'=> Hash::make($request->password),
                    'name'=> $request->name,
                ]);
                $user->save();
                    $message = "An activation link has been sent to your email. Please confirm your email address.";
                    $userData = ['name' => $request->name, 'email' => $request->email, 'code' => base64_encode($request->email)];
                    Mail::send('email.register', $userData, function ($message) use($userData){
                        $message->to($userData['email'], $userData['name']);
                        $message->subject('Confirm Registration. miniMall');
                    });
                    return view('front/confirmationNotification',compact('message'));
            }
            else{
                $errors = $validator->errors();
                $data = $request->all();
                // dd($data);
                $login = false;
                return view('front/login_register', compact('login','errors','data'));
            }

        }

        $login = false;
        return view('front/login_register', compact('login'));
    }

    public function confirmRegistration($code){
        $email = base64_decode($code);
        $userCount = User::where('email', $email)->count();
        if($userCount > 0){
            $user = User::where('email', $email)->first();
            Auth::login($user);
            if(Auth::check()){
                if(!empty(Session::get('session_id'))){
                    Cart::where('session_id', Session::get('session_id'))->update(['user_id' => Auth::id()]);
                }
            }
            if($user->status == 1 && $user->email_verified_at != null){
                $message = "Your account had already been confimed";
                return view('front/confirmationNotification',compact('message'));
            }
            else{
                User::where('email', $email)->update([
                    'status' => 1,
                    'email_verified_at' => now()
                ]);
                $message = "Your account has been confirmed. If you didn't create an account with".$email." you can safely delete this email.";
                $userData = ['name' => $user->name, 'email' => $user->email, 'msg' => $message];
                    
                Mail::send('email.confirm', $userData, function ($message) use($userData){
                    $message->to($userData['email'], $userData['name']);
                    $message->subject('Registration Successful. miniMall');
                });
            }
        }
        else{
            abort(404);
        }
        return redirect('/miniMall');
    }

    public function logout(){
        Auth::logout();
        return redirect('/miniMall');
    }

    public function forgetPassword(Request $request){   
        if($request->isMethod('post')){
            $email = $request->email;
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
            ]);
            if($validator->fails()){
                $errors = $validator->errors();
                setcookie('email',$email);

                return back()->with(compact('errors'));    
            }
            else{
                $user = User::where('email', $request->email)->first();
                // dd($user);
                $user = ['email' => $user->email,'name'=> $user->name, 'token' => base64_encode($user->email)];
                Mail::send('email.password_reset', $user, function ($message) use($user){
                    $message->to($user['email'], $user['name']);
                    $message->subject('Forget Password?. miniMall');
                });
                
                $message = "Password reset link has been sent to your email address";
               
                Auth::logout();
                
                return view('front/confirmationNotification',compact('message'));
            }
        }
        else{
            setcookie('message','');

            return view('front/password_forget');
        }
    }

    public function resetPassword(Request $request, $token = null){

        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed',
            ]);
            if($validator->fails()){
                $errors = $validator->errors();

                return back()->with(compact('errors'));    
            }
            else{
                $user = User::where('email',base64_decode($request->token))->first();
                User::where('email', $user->email)->update(['password'=> Hash::make($request->password)]);
                Auth::login($user);
                // dd($user);
                $message = "Reset Password Successful!";
                $user = ['email' => $user->email,'name'=> $user->name, 'token' => base64_encode($user->email), 'msg' => $message];
                Mail::send('email.confirm', $user, function ($message) use($user){
                    $message->to($user['email'], $user['name']);
                    $message->subject('Reset Password Successful. miniMall');
                });
                return view('front/confirmationNotification',compact('message'));

            }
        }
        else {
            return view('front/password_form',compact('token'));
        }

    }

    public function profile(Request $request){

        $email = Auth::user()->email;
        $id = Auth::user()->id;
        $countries = Country::with('state')->get();
        $user = User::where('email', $email)->first();
        $address = UserAddresses::where(['user_id' => $id, 'status' => true])->first();

        $countrycode = $countries->where('name', $address->country)->first()->phonecode;
        $states = $countries->where('name', $address->country)->first()->state;
        
        if($request->isMethod('post')){
            $request->validate([
                'email'=> 'required|email|unique:users,email,'.$request->email.',email',
                'name'=> 'required|max:255',
            ]);
                        $user->name = $request->name;

                        $address->mobile  = $request->mobile;
                        $address->country   = $request->country;
                        $address->town   = $request->town;
                        $address->district  = $request->district;
                        $address->zipcode   = $request->zipcode;
                        $address->address  = $request->address;
                        $address->name  = $request->name;
                        $address->save();

                    if($request->email != $user->email){
                        $user->email_verified_at = null;
                        $user->status = 0;
                        $user->email = $request->email;
                    }
                        $user->save();

                        return response()->json(['status' => 'success']);

        }

        return view('front/profile',compact('user','countries','countrycode','states','address'));
    }

    public function getCountryDetails(Request $request){
        $country = Country::where('name', $request->name)->with('state')->get()->toArray();
        
        return response()->json($country);
    }
    public function changePassword(Request $request){
        
        if($request->isMethod('POST')){
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed',
            ]);
            $user = User::where('email', Auth::user()->email)->first();
            
            if(Hash::check($request->old_password, $user->password)) { 
                $user->password = Hash::make($request->password);
                $user->save();
                $message = "Password changed successfully!!";
                return response()->json(['msg' => $message, 'success' => true]);
            }
            else{
                return response()->json(['msg' => 'Incorrect password!!', 'success' => false]);
            }
        }
        else{
            return view('front/pass_change');
        }                
    }

    public function myAddresses(Request $request){

        $countries = Country::get();
        $states = Country::get();
        $addresses = UserAddresses::where('user_id', Auth::user()->id)->get();

        return view('front/addresses', compact('countries', 'addresses','states'));
    }

    public function defaultAddress(Request $request){

        $addresses = UserAddresses::all();

        foreach ($addresses as $key => $address) {
            if($address->id == $request->id){
                $address->status = true;
                $address->save();
                User::where('id', Auth::user()->id)->update([
                    'name' => $address->name,
                ]);
            }
            else{
                $address->status = false;
                $address->save();
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function myOrders(){
        $orders = Order::getUsersOrder();
        // dd($orders->toArray());
        return view('front/my_orders', compact('orders'));
    }

    public function orderDetail($id){
        $order = Order::with('orderProducts','customer', 'billingAddress', 'shippingAddress')->where('id', $id)->get()->first()->toArray();
        $orderLog = OrderLog::where('order_id', $id)->get()->toArray();
        //  dd($order);
        return view('front/order_details')->with(['order' => $order, 'orderLog' => $orderLog]);
    }

    public function cancelOrder(Request $request){
        DB::beginTransaction();
        $order = Order::where('id', $request->id)->first();
        $order->status = 'Cancelled';
        $order->save();

        $orderLog = new OrderLog;
        $orderLog->order_id = $request->id;
        $orderLog->status = 'Cancelled';
        $orderLog->save();

        $message = " Order has been Cancelled (Order ID: ".$order->id.").";
        $products = OrderProducts::with('images')->where('order_id', $order->id)->get();
        foreach ($products as $product) {
            $product->name = Product::where('id', $product->product_id)->first()->product_name;
            $product->color = productAttribute::where('id', $product->attribute_id)->first()->color;
            $product->size = productAttribute::where('id', $product->attribute_id)->first()->size;
            
            productAttribute::where('id', $product->attribute_id)->increment('stock', $product->qty);
            
        }

        $userData = ['email' => Auth::user()->email,'name'=> Auth::user()->name, 
        'msg' => $message, 
        'order' => $order, 
        'billingAddress' => UserAddresses::where('id', $order->billing_id)->first(), 
        'shippingAddress' => UserAddresses::where('id', $order->shipping_id)->first(), 
        'products' => $products];

        Mail::send('email.order', $userData, function ($message) use($userData){
            $message->to($userData['email'], $userData['name']);
            $message->subject('Order Cancelled. miniMall');
        });
        DB::commit();

        return response()->json(['status' => 'success']);
        
    }

}
