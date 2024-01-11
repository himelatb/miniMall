<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function view()
    {
        $products = Product::with('category')->get()->toArray();
        $catOptions = Category::getCategoryOptions();
        $productsFilters = Product::productsFilters();
        //dd($productsFilters);
        return view('admin/product/view_product', compact('products','catOptions','productsFilters'));
        
    }

    public function add(Request $request)
    {
        $product = New Product();
        $request->validate([
            'product_name'=> 'required',
            'product_status' => 'required',
            'product_color' => 'required',
            'color_family' => 'required',
            'product_code' => 'required',
            'product_description' => 'required',
            'product_color' => 'required',
            'product_price' => 'required|numeric',
            'product_category' => 'required',
            'product_material' => 'required',
        ]);

        if($request->has('product_image')){
            $img_tmp = $request->product_image;
            $extension = $img_tmp->getClientOriginalExtension();
            $imgName = rand(1,99999).'.'.$extension;
            $request->product_image->move(public_path('product/images/'), $imgName);
            $product->product_image = $imgName;
        }

        $product->product_name = ucwords($request->product_name);
        $product->product_code = $request->product_code;
        $product->product_color = $request->product_color;
        $product->group_code = $request->group_code;
        $product->size = $request->product_size;
        $product->height = $request->product_height;
        $product->width = $request->product_width;
        $product->weight = $request->product_weight;
        $product->product_discount = $request->product_discount;
        $product->product_price = $request->product_price;
        $product->description = ucfirst($request->product_description);
        $product->wash_care = $request->product_wash;
        $product->category_id = $request->product_category;
        $product->material = $request->product_material;
        $product->color_family = $request->color_family;
        $product->fit = $request->has(['product_fit']) ? $request->product_fit : "";
        $product->occasion = $request->has(['product_occasion']) ? $request->product_occasion : "";
        $product->sleeve = $request->has(['product_sleeve']) ? $request->product_sleeve : "";
        $product->status = $request->product_status;
        $product->keywords = $request->product_keywords;
        $product->meta_keywords = $request->product_meta_keywords;
        $product->meta_description = $request->product_meta_description;
        $product->meta_title = $request->product_meta_title;
        $product->is_featured = $request->has(['product_featured']) ? $request->product_featured : "No";
        $product->save();

        return  response()->json(['status' => 'success']);


    }

    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        if($product['product_image']!=''){   
        $image_path = public_path('product/images/'.$product['product_image']);
        if(file_exists($image_path)){
          unlink($image_path);
        }}
        Product::find($request->id)->delete();
        
        return response()->json(['status' => 'success']);
    }
}
