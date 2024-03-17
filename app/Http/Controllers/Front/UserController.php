<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Country;

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
                'email'=> 'required|email|unique:users',
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

        $countries = Country::with('state')->get();
        $user = User::where('email', Auth::user()->email)->first();

        if($request->isMethod('post')){
            $request->validate([
                'email'=> 'required|email|unique:users,email,'.$request->email.',email',
                'name'=> 'required|max:255',
            ]);
                        $user->name = $request->name;
                        $user->mobile = $request->mobile;
                        $user->country = $request->country;
                        $user->town = $request->town;
                        $user->district = $request->district;
                        $user->zipcode = $request->zipcode;
                        $user->address = $request->address;

                    if($request->email != $user->email){
                        $user->email_verified_at = null;
                        $user->status = 0;
                        $user->email = $request->email;
                    }
                        $user->save();

                        return response()->json(['status' => 'success']);

        }
        $countrycode = $countries->where('name', $user->country)->first()->phonecode;
        $states = $countries->where('name', $user->country)->first()->state;

        return view('front/profile',compact('user','countries','countrycode','states'));
    }

    public function getCountryDetails(Request $request){
        $country = Country::where('name', $request->name)->with('state')->get()->toArray();
        
        return response()->json($country);
    }


}
