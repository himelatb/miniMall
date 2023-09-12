<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function login(Request $request){

        if($request->isMethod('post')){
            $req= $request->all();
             #echo "<pre";print_r($req);die;
            if(Auth::guard('admin')->attempt(['email' => $req['email'], 'password' => $req['password']])){
                return redirect('admin/dashboard');
            }
           else {
                return redirect()->back()->withErrors('Invalid credential!');
            }
        }
        return view('admin.login'); 

    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
