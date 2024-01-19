<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function viewCat(){
        $categoryView= Category::with('parent')->get()->toArray();
        $categories= Category::tree();
        //dd($categoryOptions);
        return view('admin.category.view_category', compact('categories','categoryView'));
    }
    public function updateCat(Request $request){
        $request->validate([
            'ucategory_name'=> 'required',
            'ucategory_url'=> 'required|unique:categories,url,'.$request->ucategory_id.',cat_id',
            
        ]);
        if($request->has('deleteCategoryImage') && $request->file('ucategory_image')==null){
            $category = Category::where('cat_id',$request->ucategory_id)->first();
            if($category['category_image']!=''){
                $old_path = public_path('category/images/'.$category['category_image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }
            Category::where('cat_id',$request->ucategory_id)->update(['category_image'=> '']);
        }
        if($request->has('ucategory_image')){
            $category = Category::where('cat_id',$request->ucategory_id)->first();
            if($category['category_image']!=''){
                $old_path = public_path('category/images/'.$category['category_image']);
                if(file_exists($old_path)){
                unlink($old_path);
                }
            }   
                $img_tmp = $request->ucategory_image;
                $extension = $img_tmp->getClientOriginalExtension();
                $imgName = rand(1,99999).'.'.$extension;
                $request->ucategory_image->move(public_path('category/images/'), $imgName);
                Category::where('cat_id',$request->ucategory_id)->update(['category_image'=> $imgName]);
        }
        Category::where('cat_id',$request->ucategory_id)->update([
            'category_name' => ucwords($request->ucategory_name),
            'category_discount' => $request->ucategory_discount,
            'description' => ucfirst($request->ucategory_description),
            'parent_id' => $request->ucategory_parent,
            'url' => $request->ucategory_url,
            'meta_title' => $request->ucategory_meta_title,
            'meta_description' => $request->ucategory_meta_description,
            'meta_keywords' => $request->ucategory_meta_keywords,
            'status' => $request->ucategory_status,
        ]);
        return  response()->json(['status' => 'success']);
    }
    public function addCat(Request $request){
        $request->validate([
            'category_name'=> 'required',
            'category_url'=> 'required|unique:categories,url',
            'category_status' => 'required'
            
        ]);
        $category = new Category();
        if($request->has('category_image')){
                $img_tmp = $request->category_image;
                $extension = $img_tmp->getClientOriginalExtension();
                $imgName = rand(1,99999).'.'.$extension;
                $request->category_image->move(public_path('category/images/'), $imgName);
                $category->category_image = $imgName;
        }
        
        
        $category->category_name = ucwords($request->category_name);
        $category->category_discount = $request->category_discount;
        $category->description = ucfirst($request->category_description);
        $category->parent_id = $request->category_parent;
        $category->url = $request->category_url;
        $category->meta_title = $request->category_meta_title;
        $category->meta_description = $request->category_meta_description;
        $category->meta_keywords = $request->category_meta_keywords;
        $category->status = $request->category_status;
        $category->save();

        return  response()->json(['status' => 'success']);
    }
    public function deleteCat(Request $request){
        
        $category = Category::where('cat_id',$request->id)->first();
        if($category['category_image']!=''){   
        $image_path = public_path('category/images/'.$category['category_image']);
        if(file_exists($image_path)){
          unlink($image_path);
        }}
        Category::where('cat_id',$request->id)->delete();
        
        return response()->json(['status' => 'success']);
    }
}
