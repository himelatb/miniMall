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
            ->rawColumns(['action'])
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
        ],
        [
            'customers_email.required' => "Email is required",
            'customers_email.unique' => "Email exists",
            'customers_mobile.required' => "Mobile is required",
            'customers_mobile.unique' => "Mobile exists",
            'customers_status.required' => "Status is required",
            'customers_name.required' => "Name is required",
            'customers_password.required' => "Password is required",
        ]    
    );

        $customers = new User();

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
            'ucustomers_email'=> 'required|unique:users,email,'.$request->ucustomers_id.',id',
            'ucustomers_mobile'=> 'required|unique:users,mobile,'.$request->ucustomers_id.',id',
            'ucustomers_status' => 'required',
            'ucustomers_name' => 'required',
        ],
        [
            'ucustomers_email.required' => "Email is required",
            'ucustomers_email.unique' => "Email exists",
            'ucustomers_mobile.required' => "Mobile is required",
            'customers_mobile.unique' => "Mobile exists",
            'ucustomers_status.required' => "Status is required",
            'ucustomers_name.required' => "Name is required",
        ]  );

        $oldcustomers = User::where('id',$request->ucustomers_id)->first();
            
    

        $customers = new User();

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
        $customer->delete();

        return response()->json(['status' => 'success']);
    }

}
