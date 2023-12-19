<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $cmsPages = CmsPage::get()->toArray();
        #dd($cmsPages);
        return view('admin.pages.cms_pages')->with(compact('cmsPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required',
            'description'=> 'required',
            'url'=> 'required',
            'meta_title'=> 'required',
            'status'=> 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ],
        [
            'title.required'=> 'title is required',
            'description.required'=> 'description is required',
            'url.required'=> 'type is required',
            'meta_title.required'=> 'meta_title is required',
            'status.required'=> 'status is required',
            'meta_description.required'=> 'meta_description is required',
            'meta_keywords.required'=> 'meta_keywords is required',
            
        ]
        );
        $cmsPage = new CmsPage();

        
        $cmsPage->title = $request->title;
        $cmsPage->description = $request->description;
        $cmsPage->url = $request->url;
        $cmsPage->meta_title = $request->meta_title;
        $cmsPage->meta_description = $request->meta_description;
        $cmsPage->meta_keywords = $request->meta_keywords;
        $cmsPage->status = $request->status;
        $cmsPage->save();
        
        $cmsPages= CmsPage::get()->toArray();

        return response()->json(['status' => 'success','data'=> compact('cmsPages')]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request)
    {
        $request->validate([
            'ucmstitle'=> 'required',
            'ucmsdescription'=> 'required',
            'ucmsurl'=> 'required',
            'ucmsmeta_title'=> 'required',
            'ucmsstatus'=> 'required',
            'ucmsmeta_description' => 'required',
        ],
        [
            'ucmstitle.required'=> 'title is required',
            'ucmsdescription.required'=> 'description is required',
            'ucmsurl.required'=> 'type is required',
            'ucmsmeta_title.required'=> 'meta title is required',
            'ucmsstatus.required'=> 'status is required',
            'ucmsmeta_description.required'=> 'meta description is required',
        ]
        );
        CmsPage::where('id', $request->ucmsid)->update([
            "title" => $request->ucmstitle,
            "description" => $request->ucmsdescription,
            "url" => $request->ucmsurl,
            "meta_title" => $request->ucmsmeta_title,
            "meta_description" => $request->ucmsmeta_description,
            "meta_keywords" => $request->ucmsmeta_keywords,
            "status" => $request->ucmsstatus,
        ]);
        $cmsPages= CmsPage::get()->toArray();
        return response()->json(['status' => 'success', compact('cmsPages')]);
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $cmsPage)
    {
        CmsPage::where('id', $cmsPage->id)->delete();
        $cmsPages= CmsPage::get()->toArray();

        return response()->json(['status' => 'success', 'data'=> compact('cmsPages')]);
    }
}
