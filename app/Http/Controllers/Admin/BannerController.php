<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(Banner::get()->toArray())
            ->addColumn("action","admin/banner/banner-action")
            ->addColumn("image","admin/banner/showimage")
            ->addColumn("status","admin/banner/showstatus")
            ->rawColumns(['action', 'image', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin/banner/view_banner');
    }

    public function add(Request $request){
        $request->validate([
            'banner_type' => 'required',
            'banner_status' => 'required',
            'banner_sort' => 'required',
            'banner_url' => 'required|unique:banners,url',
            'banner_image' => 'required|image',
        ],
        [
            'banner_type.required' => 'Select a type',
            'banner_status.required' => 'Select status',
            'banner_sort.required' => 'Enter serial',
            'banner_url.required' => 'Enter url',
            'banner_url.unique' => 'Url exist',
            'banner_image.required' => 'Image is required',
        ]);

        $banner = new Banner();
        if($request->has("banner_image")){
            $tmp_img = $request->banner_image;
            $extension = $tmp_img->getClientOriginalExtension();
            $imgName = rand(0,9999).'.'.$extension;
            $request->banner_image->move(public_path('front/images/banner/'), $imgName);
            $banner->image = $imgName;
        }

        $banner->title = $request->banner_title;
        $banner->text = $request->banner_text;
        $banner->type = $request->banner_type;
        $banner->sort = $request->banner_sort;
        $banner->url = $request->banner_url;
        $banner->status = $request->banner_status;
        $banner->save();

        return response()->json(['status' => 'success']);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $banner = Banner::find($request->id)->toArray();
        return response()->json($banner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'ubanner_type' => 'required',
            'ubanner_status' => 'required',
            'ubanner_sort' => 'required',
            'ubanner_url' => 'required|unique:banners,url,'.$request->ubanner_id.',id',
        ],
        [
            'ubanner_type.required' => 'Select a type',
            'ubanner_status.required' => 'Select status',
            'ubanner_sort.required' => 'Enter serial',
            'ubanner_url.required' => 'Enter url',
            'ubanner_url.unique' => 'Url exist',
        ]);

        $oldbanner = Banner::where('id',$request->ubanner_id)->first();
            
        if($request->has('deleteBannerImage') && $request->file('ubanner_image')==null){
            if($oldbanner['image']!=''){
                $old_path = public_path('front/images/banner/'.$oldbanner['image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            Banner::where('id',$request->ubanner_id)->update(['image'=> '']);
        }

        $banner = new Banner();
        if($request->has("ubanner_image")){
            $request->validate([
                'ubanner_image' => 'image',
            ],
            [
                'ubanner_image.image' => 'Image must be jpg, jpeg, png, bmp, gif, svg, or webp'
            ]
        );
            if($oldbanner['image']!=''){
                $old_path = public_path('front/images/banner/'.$oldbanner['image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            $tmp_img = $request->ubanner_image;
            $extension = $tmp_img->getClientOriginalExtension();
            $imgName = rand(0,9999).'.'.$extension;
            $request->ubanner_image->move(public_path('front/images/banner/'), $imgName);
            Banner::where('id',$request->ubanner_id)->update(['image'=> $imgName]);
        }

        Banner::where("id", $request->ubanner_id)->update([
            "title" => $request->ubanner_title,
            "status" => $request->ubanner_status,
            "type" => $request->ubanner_type,
            "text" => $request->ubanner_text,
            "sort" => $request->ubanner_sort,
            "url" => $request->ubanner_url, 
        ]);


        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $banner = Banner::where('id',$request->id)->first();
            if($banner['image']!=''){
                $old_path = public_path('front/images/banner/'.$banner['image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            $banner->delete();

        return response()->json(['status' => 'success']);
    }
}
