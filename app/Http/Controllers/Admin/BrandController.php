<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function view(Request $request){
        if($request->ajax()){
            return datatables()->of(Brand::select("*"))
            ->addColumn("action","admin/brand/brand-action")
            ->addColumn("brand_logo","admin/brand/showlogo")
            ->rawColumns(['action','brand_logo'])
            ->addIndexColumn()
            ->make(true);
        }
        $brands = Brand::get()->toArray();
        return view('admin/brand/view_brand', compact('brands'));
    }

    public function add(Request $request){
        $request->validate([
            'brand_name'=> 'required|unique:brands,brand_name',
            'brand_url'=> 'required|unique:brands,url',
            'brand_status' => 'required',
            'brand_image' => 'image',
            'brand_logo' => 'image',
        ],
        [
            'brand_name.required' => "Name is required",
            'brand_name.unique' => "Name exists",
            'brand_url.required' => "Url is required",
            'brand_url.unique' => "Url exists",
            'brand_status.required' => "Status is required",
            'brand_image.image' => "Image must be jpg, jpeg, png, bmp, gif, svg, or webp",
            'brand_logo.image' => "Logo must be jpg, jpeg, png, bmp, gif, svg, or webp"
        ]    
    );

        $brand = new Brand();
        if($request->has("brand_image")){
            $tmp_img = $request->brand_image;
            $extension = $tmp_img->getClientOriginalExtension();
            $imgName = rand(0,9999).'.'.$extension;
            $request->brand_image->move(public_path('front/images/brand/'), $imgName);
            $brand->brand_image = $imgName;
        }
        if($request->has("brand_logo")){
            $tmp_logo = $request->brand_logo;
            $extension = $tmp_logo->getClientOriginalExtension();
            $logoName = rand(0,9999).'.'.$extension;
            $request->brand_logo->move(public_path('front/brand/logos/'), $logoName);
            $brand->brand_logo = $logoName;
        }

        $brand->brand_name = ucwords($request->brand_name);
        $brand->url = $request->brand_url;
        $brand->description = ucfirst($request->brand_description);
        $brand->meta_title = $request->brand_meta_title;
        $brand->meta_description = $request->brand_meta_description;
        $brand->meta_keywords = $request->brand_meta_keywords;
        $brand->discount = $request->brand_discount;
        $brand->status = $request->brand_status;
        $brand->save();

        return response()->json(['status' => 'success']);
    }

    public function edit(Request $request){
        $brand = Brand::where('id', $request->id)->first()->toArray();

        return response()->json($brand);
    }

    public function update(Request $request){
        $request->validate([
            'ubrand_name'=> 'required|unique:brands,brand_name,'.$request->ubrand_id.',id',
            'ubrand_url'=> 'required|unique:brands,url,'.$request->ubrand_id.',id',
            'ubrand_status' => 'required',
            'ubrand_image' => 'image',
            'ubrand_logo' => 'image',
        ],
        [
            'ubrand_name.required' => "Name is required",
            'ubrand_name.unique' => "Name exists",
            'ubrand_url.required' => "Url is required",
            'ubrand_url.unique' => "Url exists",
            'ubrand_status.required' => "Status is required",
            'ubrand_image.image' => "Image must be jpg, jpeg, png, bmp, gif, svg, or webp",
            'ubrand_logo.image' => "Logo must be jpg, jpeg, png, bmp, gif, svg, or webp"
        ]    
    );

    $oldbrand = Brand::where('id',$request->ubrand_id)->first();
        
        if($request->has('deleteBrandImage') && $request->file('ubrand_image')==null){
            if($oldbrand['brand_image']!=''){
                $old_path = public_path('front/images/brand/'.$oldbrand['brand_image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            Brand::where('id',$request->ubrand_id)->update(['brand_image'=> '']);
        }

        if($request->has('deleteBrandImage') && $request->file('ubrand_logo')==null){
            if($oldbrand['brand_logo']!=''){
                $old_path = public_path('front/brand/logos/'.$oldbrand['brand_logo']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            Brand::where('id',$request->ubrand_id)->update(['brand_logo'=> '']);
        }

        $brand = new Brand();
        if($request->has("ubrand_image")){
            if($oldbrand['brand_image']!=''){
                $old_path = public_path('front/images/brand/'.$oldbrand['brand_image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            $tmp_img = $request->ubrand_image;
            $extension = $tmp_img->getClientOriginalExtension();
            $imgName = rand(0,9999).'.'.$extension;
            $request->ubrand_image->move(public_path('front/images/brand/'), $imgName);
            Brand::where('id',$request->ubrand_id)->update(['brand_image'=> $imgName]);
        }
        if($request->has("ubrand_logo")){
            if($oldbrand['brand_logo']!=''){
                $old_path = public_path('front/brand/logos/'.$oldbrand['brand_logo']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            $tmp_logo = $request->ubrand_logo;
            $extension = $tmp_logo->getClientOriginalExtension();
            $logoName = rand(0,9999).'.'.$extension;
            $request->ubrand_logo->move(public_path('front/brand/logos/'), $logoName);
            Brand::where('id',$request->ubrand_id)->update(['brand_logo'=> $logoName]);
        }

        Brand::where("id", $request->ubrand_id)->update([
            "brand_name" => $request->ubrand_name,
            "status" => $request->ubrand_status,
            "description" => $request->ubrand_description,
            "meta_title" => $request->ubrand_meta_title,
            "meta_description" => $request->ubrand_meta_description,
            "meta_keywords" => $request->ubrand_meta_keywords,
            "url" => $request->ubrand_url,
            "discount" => $request->ubrand_discount  
        ]);


        return response()->json(['status' => 'success']);
    }

    public function delete(Request $request){

        $brand = Brand::where('id',$request->id)->first();

        if($brand['brand_image']!=''){
            $old_path = public_path('front/images/brand/'.$brand['brand_image']);
            if(file_exists($old_path)){
            unlink($old_path);
            }
        }

        if($brand['brand_logo']!=''){
            $old_path = public_path('front/brand/logos/'.$brand['brand_logo']);
            if(file_exists($old_path)){
            unlink($old_path);
            }
        }
        $brand->delete();

        return response()->json(['status' => 'success']);
    }
}
