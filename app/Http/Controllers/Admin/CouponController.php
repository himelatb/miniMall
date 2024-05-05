<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(Coupon::get()->toArray())
            ->addColumn("action","admin/coupon/coupon-action")
            ->addColumn("status","components/showstatus")
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        $categories = Category::tree();
        $brands = Brand::get()->toArray();
        $users = User::get()->toArray();
        return view('admin/coupon/view_coupon', compact('categories','brands','users'));
    }

    public function add(Request $request){
       $request->validate([
        'coupon_option' => 'required',
        'coupon_type' => 'required',
        'amount_type' => 'required',
        'coupon_amount' => 'required|numeric',
        'coupon_code' => 'required_if:coupon_option,Manual|unique:coupons,coupon_code',
        'coupon_status' => 'required',
        'expiry_date' => 'required'
       ],
       [ 
            'coupon_option.required' => 'Please select an option!',
            'amount_type.required' => 'Please select an amount type!',
            'coupon_type.required' => 'Please select an coupon type!',
            'coupon_amount.required' => 'Amount is required!',
            'coupon_amount.numeric' => 'Amount must be numeric!',
            'coupon_code.reqired_if' => 'Coupon code is required!',
            'coupon_code.unique' => 'Coupon code must be unique! Try writing the code manually.',
            'coupon_status.reqired' => 'Status is required!',
            'expiry_date.reqired' => 'Expiry date is required!',
       ]
    );
    if(isset($request->categories) && $request->categories[0] != null){
        $categories = implode(',', $request->categories);
    }
    else{
        $categories = '';
    }
    if(isset($request->brands) && $request->brands[0] != null){
        $brands = implode(',', $request->brands);
    }
    else{
        $brands = '';
    }
    if(isset($request->users) && $request->users[0] != null){
        $users = implode(',', $request->users);
    }
    else{
        $users = '';
    }

        $coupon = new Coupon();
        $coupon->coupon_option = $request->coupon_option;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->categories = $categories;
        $coupon->brands = $brands;
        $coupon->amount = $request->coupon_amount;
        $coupon->amount_type = $request->amount_type;
        $coupon->users = $users;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->status = $request->coupon_status;
        $coupon->save();

        return response()->json(['status' => 'success']);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $coupon = Coupon::find($request->id)->toArray();
        $coupon['categories'] = explode(',', $coupon['categories']);
        $coupon['brands'] = explode(',', $coupon['brands']);
        $coupon['users'] = explode(',', $coupon['users']);
        return response()->json($coupon);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'ucoupon_option' => 'required',
            'ucoupon_type' => 'required',
            'uamount_type' => 'required',
            'ucoupon_amount' => 'required|numeric',
            'ucoupon_code' => 'required_if:coupon_option,Manual|unique:coupons,coupon_code,'.$request->ucoupon_id.',id',
            'ucoupon_status' => 'required',
            'uexpiry_date' => 'required'
           ],
           [ 
                'ucoupon_option.required' => 'Please select an option!',
                'uamount_type.required' => 'Please select an amount type!',
                'ucoupon_type.required' => 'Please select an coupon type!',
                'ucoupon_amount.required' => 'Amount is required!',
                'ucoupon_amount.numeric' => 'Amount must be numeric!',
                'ucoupon_code.reqired_if' => 'Coupon code is required!',
                'ucoupon_code.unique' => 'Coupon code must be unique! Try writing the code manually.',
                'ucoupon_status.reqired' => 'Status is required!',
                'uexpiry_date.reqired' => 'Expiry date is required!',
           ]
        );

        if(isset($request->ucategories) && $request->ucategories[0] != null){
            $categories = implode(',', $request->ucategories);
        }
        else{
            $categories = '';
        }
        if(isset($request->ubrands) && $request->ubrands[0] != null){
            $brands = implode(',', $request->ubrands);
        }
        else{
            $brands = '';
        }
        if(isset($request->uusers) && $request->uusers[0] != null){
            $users = implode(',', $request->uusers);
        }
        else{
            $users = '';
        }

        $coupon = Coupon::where('id',$request->ucoupon_id)->first();
        $coupon->coupon_option = $request->ucoupon_option;
        $coupon->coupon_type = $request->ucoupon_type;
        $coupon->coupon_code = $request->ucoupon_code;
        $coupon->categories = $categories;
        $coupon->brands = $brands;
        $coupon->amount = $request->ucoupon_amount;
        $coupon->amount_type = $request->uamount_type;
        $coupon->users = $users;
        $coupon->expiry_date = $request->uexpiry_date;
        $coupon->status = $request->ucoupon_status;
        $coupon->save();

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
       Coupon::find($request['id'])->delete();

        return response()->json(['status' => 'success']);
    }
}
