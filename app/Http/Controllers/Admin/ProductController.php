<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\products_images;
use App\Models\ProductAttribute;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use DB;
use Datatables;

class ProductController extends Controller
{
    public function view(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(Product::with('category','brand')->select("*"))
            ->addColumn('action','admin/product/product-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $categories = Category::tree();
        $productsFilters = Product::productsFilters();
        $brands = Brand::get()->toArray();
        return view('admin/product/view_product', compact('categories','productsFilters','brands'));
        // dd($products);
        
    }

    public function add(Request $request)
    {
        $product = New Product();
        $request->validate([
            'product_name'=> 'required',
            'product_status' => 'required',
            'product_code' => 'required|unique:products,product_code',
            'product_description' => 'required',
            'sort.*' => 'required|distinct',
            'product_price' => 'required|numeric',
            'product_discount'=> 'numeric|max:100',
            'product_category' => 'required',
            'product_material' => 'required',
            'product_video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:8000',
        ],
        [
            'sort.*.required' => 'Sorting number beside each image is required',
            'sort.*.distinct' => 'Sorting number beside each image must be unique',
        ]);

        if($request->has('product_video')){
            $vid_tmp = $request->product_video;
            $extension = $vid_tmp->getClientOriginalExtension();
            $vidName = rand(1,99999).'.'.$extension;
            $request->product_video->move(public_path('front/images/product/videos/'), $vidName);
            $product->product_video = $vidName;
        }

        $product->product_name = ucwords($request->product_name);
        $product->product_code = $request->product_code;
        $product->group_code = $request->group_code;
        $product->weight = $request->product_weight;

        if(!empty($request->product_discount) && $request->product_discount > 0)
        {
            $product->discount_type = "Product";
            $product->final_price = ($request->product_price) - ($request->product_price * ($request->product_discount / 100));
            $product->product_discount =  $request->product_discount;
        }
        else
        {
            $category = Category::where('cat_id',$request->product_category)->get()->first();
            if($category['category_discount']  != null){
                $product->discount_type = "Category";
                $product->final_price = $request->product_price - ($request->product_price * ($category['category_discount'] / 100));
                $product->product_discount =  $category['category_discount'];
            }
            else{
                $brand = Brand::where('id',$request->product_brand)->get()->first();
                if($brand['discount']  != null){
                    $product->discount_type = "Brand";
                    $product->final_price = $request->product_price - ($request->product_price * ($brand['discount'] / 100));
                    $product->product_discount =  $brand['discount'];
                }
                else{
                    $product->discount_type = '';
                    $product->final_price = $request->product_price;
                    $product->product_discount =  0;

                }
            }
        }
        $product->product_price = $request->product_price;
        $product->brand_id = $request->product_brand;
        $product->description = ucfirst($request->product_description);
        $product->wash_care = $request->product_wash;
        $product->category_id = $request->product_category;
        $product->material = $request->product_material;
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

        $id = DB::getPdo()->lastInsertId();

                

        if($request->has('product_images')){
            $manager = new ImageManager(new Driver());
            
            foreach ($request->product_images  as $key => $image) {
                $img_tmp = $manager->read($image);
                $extension = $image->getClientOriginalExtension();
                $imgName = rand(1,99999).'.'.$extension;

                $img_tmp->resize(1040,1200)->save(public_path('front/images/product/large/'.$imgName));
                $img_tmp->resize(520,600)->save(public_path('front/images/product/medium/'.$imgName));
                $img_tmp->resize(260,300)->save(public_path('front/images/product/small/'.$imgName));
                
                $image_upload = new products_images();
                $image_upload->image = $imgName;
                $image_upload->image_sort = $request->sort[$key];
                $image_upload->product_id = $id;
                $image_upload->save();
            }
            
        }

        foreach ($request->sku as $key => $sku) {
            if(!empty($sku)){
                $countSku = ProductAttribute::where('sku', $sku)->count();
                if($countSku > 0){
                    return response()->json(["error" => "Sku must be unique"]);
                }
                $attribute = new ProductAttribute();
                $attribute->product_id = $id;
                $attribute->category_id = $request->product_category;
                $attribute->size = $request->size[$key];
                $attribute->sku = $request->sku[$key];
                $attribute->color = $request->color[$key];
                $attribute->color_code = $request->colorCode[$key];
                $attribute->price = $request->price[$key];
                $attribute->stock = $request->stock[$key];
                $attribute->save();
            }
        }

        return  response()->json(['status' => 'success']);


    }

    public function edit(Request $request)
    {
        $product = Product::with('category','images', 'attributes')->where('id',$request->id)->first();
        //dd($product);
        return response()->json($product);
    }

    public function changeAttributeStatus(Request $request)
    {

        ProductAttribute::where('id', $request->id)->update([
            'status' => $request->status == 1 ? 0: 1,
        ]);

        $productAttributeStatus = ProductAttribute::where('id', $request->id)->get(["status","id","product_id"])->toArray();

        return response()->json($productAttributeStatus);

    }

    public function attributeDelete(Request $request)
    {

        ProductAttribute::where('id', $request->id)->delete();

        $productAttributes = ProductAttribute::where('product_id', $request->product_id)->get()->toArray();

        return response()->json($productAttributes);

    }



    public function deleteImage(Request $request){

        $image = products_images::find($request->id);

                $image_largepath = public_path('front/images/product/large/'.$image['image']);
                $image_mediumpath = public_path('front/images/product/medium/'.$image['image']);
                $image_smallepath = public_path('front/images/product/small/'.$image['image']);

                $image_paths = [$image_largepath, $image_mediumpath, $image_smallepath ];
                
                foreach ($image_paths as $image_path) {
                    
                    if(file_exists($image_path)){
                        unlink($image_path);
                    }
                }
        products_images::find($request->id)->delete();

        $productImages = products_images::where("product_id", $request->product_id)->get();
        
        return response()->json($productImages);
    }

    public function update(Request $request)
    {   
        $request->validate([
            'uproduct_name'=> 'required',
            'uproduct_status' => 'required',
            'uproduct_code' => 'required|unique:products,product_code,'.$request->uproduct_id.',id',
            'uproduct_description' => 'required',
            'usort.*' => 'required|distinct',
            'uproduct_price' => 'required|numeric',
            'uproduct_discount'=> 'numeric|max:100',
            'uproduct_category' => 'required',
            'uproduct_material' => 'required',
            'uproduct_video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:8000',
        ],
        [
            'usort.*.required' => 'Sorting number beside each image is required',
            'usort.*.distinct' => 'Sorting numbers of images must be unique',
        ]
    );
        
        if($request->has('uproduct_video')){
            $vid_tmp = $request->uproduct_video;
            $extension = $vid_tmp->getClientOriginalExtension();
            $vidName = rand(1,99999).'.'.$extension;
            $request->uproduct_video->move(public_path('front/images/product/videos/'), $vidName);
            Product::where('id',$request->uproduct_id)->update(['product_video'=> $vidName]);
        }
        if(!empty($request->uproduct_discount) && $request->uproduct_discount > 0)
        {
            $discount_type = "Product";
            $final_price = ($request->uproduct_price) - ($request->uproduct_price * ($request->uproduct_discount / 100));
            $product_discount =  $request->uproduct_discount;
        }
        else
        {
            $category = Category::where('cat_id',$request->uproduct_category)->get()->first();
            if($category['category_discount']  != null){
                $discount_type = "Category";
                $final_price = $request->uproduct_price - ($request->uproduct_price * ($category['category_discount'] / 100));
                $product_discount =  $category['category_discount'];
            }
            else{
                $brand = Brand::where('id',$request->uproduct_brand)->get()->first();
                if($brand['discount']  != null){
                    $discount_type = "Brand";
                    $final_price = $request->uproduct_price - ($request->uproduct_price * ($brand['discount'] / 100));
                    $product_discount =  $brand['discount'];
                }
                else{
                    $discount_type = '';
                    $final_price = $request->uproduct_price;
                    $product_discount =  0;

                }
            }
        }
        Product::where('id',$request->uproduct_id)->update([
            'product_name' => ucwords($request->uproduct_name),
            'product_code' => $request->uproduct_code,
            'final_price' => $final_price,
            'product_discount' => $product_discount,
            'discount_type' => $discount_type,
            'weight' => $request->uproduct_weight,
            'product_price' => $request->uproduct_price,
            'description' => ucfirst($request->uproduct_description),
            'wash_care' => $request->uproduct_wash,
            'category_id' => $request->uproduct_category,
            'brand_id' => $request->uproduct_brand,
            'material' => $request->uproduct_material,
            'fit' => $request->uproduct_fit,
            'occasion' => $request->uproduct_occasion,
            'sleeve' => $request->uproduct_sleeve,
            'status' => $request->uproduct_status,
            'keywords' => $request->uproduct_keywords,
            'meta_keywords' => $request->uproduct_meta_keywords,
            'meta_description' => $request->uproduct_meta_description,
            'meta_title' => $request->uproduct_meta_title,
            'is_featured' => $request->uproduct_featured ,
        ]);

         if($request->has('uproduct_images')){
            $manager = new ImageManager(new Driver());

            foreach ($request->uproduct_images as $key => $image) {
                $img_tmp = $manager->read($image);
                $extension = $image->getClientOriginalExtension();
                $imgName = rand(1,99999).'.'.$extension;

                $img_tmp->resize(1040,1200)->save(public_path('front/images/product/large/'.$imgName));
                $img_tmp->resize(520,600)->save(public_path('front/images/product/medium/'.$imgName));
                $img_tmp->resize(260,300)->save(public_path('front/images/product/small/'.$imgName));
                $image_upload = new products_images();
                $image_upload->image = $imgName;
                $image_upload->image_sort = $request->sort[$key];
                $image_upload->product_id = $request->uproduct_id;
                $image_upload->save();
            }
            
        }

        if($request->has('usort')){

            foreach ($request->uimage as $key => $image) {
                products_images::where(["product_id" => $request->uproduct_id, "image" => $image])
                ->update(["image_sort" => $request->usort[$key]]);
            }
        }
        if ($request->has('attributeId')) {
            foreach ($request->attributeStocks as $key => $stocks) {
                ProductAttribute::where('id', $request->attributeId[$key])->update([
                    "price" => $request->attributePrices[$key],
                    "stock" => $stocks,
                ]);
            }
        }

        foreach ($request->sku as $key => $sku) {
            if(!empty($sku)){
                $countSku = ProductAttribute::where('sku', $sku)->count();
                if($countSku > 0){
                    return response()->json(["error" => "Sku must be unique"]);
                }
                $attribute = new ProductAttribute();
                $attribute->product_id = $request->uproduct_id;
                $attribute->category_id = $request->uproduct_category;
                $attribute->size = $request->size[$key];
                $attribute->sku = $request->sku[$key];
                $attribute->color = $request->color[$key];
                $attribute->color_code = $request->colorCode[$key];
                $attribute->price = $request->price[$key];
                $attribute->stock = $request->stock[$key];
                $attribute->save();
            }
        }

        $productImages = products_images::where("product_id", $request->uproduct_id)->get();
        return response()->json($productImages);
    }

    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        $images = products_images::where('product_id',$request->id)->get()->toArray();

        if(!empty($images)){
            foreach ($images as $image) {
                $image_largepath = public_path('front/images/product/large/'.$image['image']);
                $image_mediumpath = public_path('front/images/product/medium/'.$image['image']);
                $image_smallepath = public_path('front/images/product/small/'.$image['image']);

                $image_paths = [$image_largepath, $image_mediumpath, $image_smallepath ];
                
                foreach ($image_paths as $image_path) {
                    
                    if(file_exists($image_path)){
                        unlink($image_path);
                    }
                }
                
            }   
        }
         if($product['product_video']!=''){   
                    $vid_path = public_path('front/images/product/videos/'.$product['product_video']);
                    if(file_exists($vid_path)){
                    unlink($vid_path);
                    }
                }
        Product::find($request->id)->delete();
        products_images::where('product_id',$request->id)->delete();
        ProductAttribute::where('product_id', $request->id)->delete();
        
        return response()->json(['status' => 'success']);
    }
}
