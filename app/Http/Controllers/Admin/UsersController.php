<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
class UsersController extends Controller
{
    public function view(Request $request){
        if($request->ajax()){
            return datatables()->of(User::select("*"))
            ->addColumn("action","admin/customers/customers-action")
            ->addColumn("image","admin/customers/customers_image")
            ->rawColumns(['action','image'])
            ->addIndexColumn()
            ->make(true);
        }
        $users = User::get()->toArray();
        return view('admin/customers/view_customers', compact('users'));

    }


    public function add(Request $request){
        $request->validate([
            'customers_email'=> 'required|unique:users,email',
            'customers_mobile'=> 'required|unique:users,mobile',
            'customers_password' => 'required',
            'customers_status' => 'required',
            'customers_name' => 'required',
            'customers_image' => 'image',
        ],
        [
            'customers_email.required' => "Email is required",
            'customers_email.unique' => "Email exists",
            'customers_mobile.required' => "Mobile is required",
            'customers_mobile.unique' => "Mobile exists",
            'customers_status.required' => "Status is required",
            'customers_name.required' => "Name is required",
            'customers_password.required' => "Password is required",
            'customers_image.image' => "Image must be jpg, jpeg, png, bmp, gif, svg, or webp",
        ]    
    );

        $customers = new User();
        if($request->has("customers_image")){
            $tmp_img = $request->customers_image;
            $extension = $tmp_img->getClientOriginalExtension();
            $imgName = rand(0,9999).'.'.$extension;
            $request->customers_image->move(public_path('front/images/customer/'), $imgName);
            $customers->image = $imgName;
        }

        $customers->name = ucwords($request->customers_name);
        $customers->email = $request->customers_email;
        $customers->mobile = $request->customers_mobile;
        $customers->password = Hash::make($request->customers_password);
        $customers->status = $request->customers_status;
        $customers->save();

        return response()->json(['status' => 'success']);
    }

    public function edit(Request $request){
        $customer = User::find($request->id)->toArray();

        return response()->json($customer);
    }

    public function update(Request $request)
    {
        $request->validate([
            'ucustomers_email'=> 'required|unique:users,email,'.$request->ucustomers_email.',email',
            'ucustomers_mobile'=> 'required|unique:users,mobile,'.$request->ucustomers_mobile.',mobile',
            'ucustomers_status' => 'required',
            'ucustomers_name' => 'required',
            'ucustomers_image' => 'image',
        ],
        [
            'ucustomers_email.required' => "Email is required",
            'ucustomers_email.unique' => "Email exists",
            'ucustomers_mobile.required' => "Mobile is required",
            'customers_mobile.unique' => "Mobile exists",
            'ucustomers_status.required' => "Status is required",
            'ucustomers_name.required' => "Name is required",
            'ucustomers_image.image' => "Image must be jpg, jpeg, png, bmp, gif, svg, or webp",
        ]  );

        $oldcustomers = User::where('id',$request->ucustomers_id)->first();
            
        if($request->has('deleteUserImage') && $request->file('ucustomers_image')==null){
            if($oldcustomers['image']!=''){
                $old_path = public_path('front/images/customer/'.$oldcustomers['image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            User::where('id',$request->ucustomers_id)->update(['image'=> '']);
        }

        $customers = new User();
        if($request->has("ucustomers_image")){
            $request->validate([
                'ucustomers_image' => 'image',
            ],
            [
                'ucustomers_image.image' => 'Image must be jpg, jpeg, png, bmp, gif, svg, or webp'
            ]
        );
            if($oldcustomers['image']!=''){
                $old_path = public_path('front/images/customer/'.$oldcustomers['image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            $tmp_img = $request->ucustomers_image;
            $extension = $tmp_img->getClientOriginalExtension();
            $imgName = rand(0,9999).'.'.$extension;
            $request->ucustomers_image->move(public_path('front/images/customer/'), $imgName);
            User::where('id',$request->ucustomers_id)->update(['image'=> $imgName]);
        }

        User::where("id", $request->ucustomers_id)->update([
            "email" => $request->ucustomers_email,
            "status" => $request->ucustomers_status,
            "mobile" => $request->ucustomers_mobile,
            "name" => $request->ucustomers_name,
        ]);


        return response()->json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $customer = User::where('id',$request->id)->first();
            if($customer['image']!=''){
                $old_path = public_path('front/images/customer/'.$customer['image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            $customer->delete();

        return response()->json(['status' => 'success']);
    }

}
