<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use app\Models\Admin;
use validator;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function login(Request $request){

        if($request->isMethod('post')){
            $req= $request->all();
             #echo "<pre";print_r($req);die;

            $this->validate($request,[
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

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

    public function viewAdmins(){
        $admins = Admin::orderBy("id", "asc")->paginate(5);
        return view('admin.users.view_admins', compact('admins'));
        //echo "<pre";print_r($admins);die;
        
    }
    public function addAdmins(Request $request){
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:admins',
            'mobile'=> 'required',
            'type'=> 'required',
            'status'=> 'required',
            'password' => 'required',
        ],
        [
            'name.required'=> 'name is required',
            'email.required'=> 'email is required',
            'email.email'=> 'must be an email address',
            'type.required'=> 'type is required',
            'mobile.required'=> 'mobile is required',
            'password.required'=> 'password is required'
        ]
        );

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->type = $request->type;
        $admin->password = Hash::make($request->password);
        $admin->status = $request->status;
        $admin->save();
        


        return response()->json(['status' => 'success']);


    }

    public function updateAdmins(Request $request){
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'mobile'=> 'required',
            'type'=> 'required',
            'status'=> 'required',
        ],
        [
            'name.required'=> 'name is required',
            'email.required'=> 'email is required',
            'email.email'=> 'must be an email address',
            'type.required'=> 'type is required',
            'mobile.required'=> 'mobile is required',
        ]
        );

        Admin::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'status' => $request->status,
        ]);
        return response()->json(['status' => 'success']);


    }

    public function deleteAdmins(Request $request){
            
        Admin::find($request->id)->delete();
        
        return response()->json(['status' => 'success']);
    }

    public function pagination(Request $request){
        $admins = Admin::orderBy("id", "asc")->paginate(5);
        return view('admin.users.pagination', compact('admins'))->render();
    }

    public function search(Request $request){
        $admins = Admin::where("name","LIKE",'%'.$request->str.'%')
        ->orwhere("mobile","LIKE",'%'.$request->str.'%')
        ->orwhere("type","LIKE",'%'.$request->str.'%')
        ->orwhere("status","LIKE",'%'.$request->str.'%')
        ->orwhere("email","LIKE",'%'.$request->str.'%')
        ->paginate(5);
        if($admins->count()>=1){
            return view('admin.users.view_admins', compact('admins'))->render();
        }else {
            return response()->json(['status' => 'empty']);
        }
        
    }

    public function passwordAdmins(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                "oldPassword" => "required",
                "newPassword" => "required",
                "confirmPassword" => "required",
                ]);
            if(Hash::check($request->oldPassword, Auth::guard('admin')->user()->password)){
                if($request->newPassword== $request->confirmPassword){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update([
                        'password' => Hash::make($request->newPassword)
                    ]);
                    return response()->json(['status'=> "success"]);
                }
                else {
                    return response()->json(['status'=> "not_matched"]);
                }
            }
            else {
                return response()->json(['status'=> "wrong_pass"]);
            }

        }
        return view('admin.users.password_change');
    }

}
