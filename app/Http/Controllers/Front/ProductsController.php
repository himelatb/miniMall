<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductAttribute;
use Session;
use Auth;

class ProductsController extends Controller
{
    public function catListing(Request $request){
        $Url = Route::getFacadeRoot()->current()->uri;
        
        if($Url == "shop"){
            $products = Product::productFilterSort($request);
            $categories = Category::tree();
            $sizes = ProductAttribute::getSizes();
            $colors = ProductAttribute::getColors();
            $CategoryDetails = $categories;
            $breadcrumbs = [ ['url' => 'shop', 'category_name' => 'Shop'] ];
        }
        else{
            $CategoryDetails = Category::Tree($Url);
            $catKey = array_keys($CategoryDetails)[0];
            $Id = $CategoryDetails[$catKey]['cat_id'];
            $catIds[] = $Id;
            $breadcrumbs = Category::parentTree($CategoryDetails[$catKey]['cat_id']);
    
            if($breadcrumbs[$catKey]['parent'] == null){
                $breadcrumbs = array($breadcrumbs[$catKey]);
            }
            else{
                $crumbKey = array_keys($breadcrumbs);
                $index = 0;
                $nextkey = array_keys($breadcrumbs)[0];
                $parentCrumbs[$index] = $breadcrumbs[$nextkey]; 
                do{
                    $index += 1;
                    $nextkey = array_keys($breadcrumbs[$crumbKey[0]]['parent'])[0]; 
                    $parentCrumbs[$index] = $breadcrumbs[$crumbKey[0]]['parent'][$nextkey];
                    $breadcrumbs = $breadcrumbs[$crumbKey[0]]['parent'];
                    $crumbKey = array_keys($breadcrumbs);
                }
                while($breadcrumbs[$crumbKey[0]]['parent'] != null);
              
                $crumbs = array();
                foreach ($parentCrumbs as $key => $value) {
                    array_push($crumbs, $value);
                }
                array_push($crumbs,['url' => 'shop', 'category_name' => 'Shop']); 
                $breadcrumbs = array_reverse($crumbs);
            }
    
            
            foreach ($CategoryDetails[$catKey]['children'] as $subcategory) {
                if (empty($subcategory['children'])) {
                    $catIds[] = $subcategory['cat_id'];
                } else {
                    $cats[] = self::getIds($subcategory);
                    foreach ($cats[0] as $value) {
                        $catIds[] = $value;
                    }
                }
            }
            $products = Product::productFilterSort($request, $catIds);
            $categories = Category::tree();
            $sizes = ProductAttribute::getSizes($catIds);
            $colors = ProductAttribute::getColors($catIds);
        }

        $filters = $request->all();

        if($filters != null) {
            if(isset($filters['colors'])){
                $filters['colors'] = array_keys($filters['colors']);
            }
            if(isset($filters['sizes'])){
                $filters['sizes'] = array_keys($filters['sizes']);
            }
        }
        //  dd($breadcrumbs);
        return view('front/productsPage', 
        compact(
            'products',
            'CategoryDetails', 
            'categories',
            'breadcrumbs',
            'sizes',
            'colors',
            'filters',   
        ));

    }

    private static function getIds($category){
        $catIds[] = $category['cat_id'];
        foreach ($category['children'] as $subcategory) {
            if (!empty($subcategory['children'])) {
                $cats[] = self::getIds($subcategory);
                foreach ($cats[0] as $value) {
                    $catIds[] = $value;
                }
            } else {
                $catIds[] = $subcategory['cat_id'];
            }
            
        }
        return $catIds;
    }

    public function getProduct($id){
        $product = Product::with(['attributes','images' => function ($query) {
            $query->orderBy('image_sort');},'brand'])->find($id);
        $products = Product::with('images')->where('status', 1)->where("is_featured", 'Yes')->get()->toArray();   
        $sizes = ProductAttribute::getProductSizes($id);
        $colors = ProductAttribute::getProductColors($id);

        // dd($colors, $sizes);

        return view('front/productDetails', compact('product','colors','sizes','products'));
    }

    public function getColorBySize(Request $request){
        $size = $request->size;
        $product_id = $request->product_id;
        $product_discount = $request->product_discount;


        $attributes = ProductAttribute::where(['product_id'=> $product_id,'size'=> $size])->get();
        foreach ($attributes as $attribute) {
            if($product_discount != null){
                $final_price = $attribute->price - ($product_discount * ( $product_discount /100));
            }
            else{
                $final_price = $attribute->price;
            }
            $attribute['final_price'] = $final_price;
        }

        
        return response()->json($attributes);
    }

    public function addToCart(Request $request){
        if($request['sku_id'] == null){
            return response()->json(['success' => false, 'message'=> 'please select size and color']);
        }
        else{
            $productAttr = ProductAttribute::find( $request['sku_id']);
            if( $productAttr['stock'] < $request['qty'] ){
                return response()->json(['success' => false, 'message'=> 'Required quantity is not available!']);
            }
            else{
                if(empty(Session::get('session_id'))){
                    $session_id = Session::getId();
                    $request->session()->put('session_id', $session_id);
                }
                else{
                    $session_id = Session::get('session_id');
                }

                if(Auth::check()){
                    $user_id = Auth::user()->id;
                    $countProducts = Cart::where(['product_id' => $request['product_id'], 
                    'sku_id'=> $request['sku_id'], 'user_id' => $user_id,
                    'session_id'=> $session_id])->count();
                }
                else{
                    $user_id = 0;
                    $countProducts = Cart::where(['product_id' => $request['product_id'], 'sku_id'=> $request['sku_id'], 'session_id'=> $session_id])->count();
                }
                
                if($countProducts > 0){
                    return response()->json(['success' => false, 'message'=> 'This product is already in the Cart!']);
                }
                else{
                    $item = new Cart();
                    $item->session_id = $session_id;
                    if(Auth::check()){
                        $item->user_id = Auth::user()->id;
                    }
                    $item->product_id = $request['product_id'];
                    $item->product_qty = $request['qty'];
                    $item->price = $request['price'];
                    $item->sku_id = $request['sku_id'];
                    $item->save();
                    $totalCartItems = totalCartItems();
                    return response()->json(['success' => true, 'totalCartItems'=> $totalCartItems]);
                }
            } 
        }
    }
}
