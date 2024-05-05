<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductAttribute;
use App\Models\Banner;
use App\Models\Category;
use Auth;
use Session;

class IndexController extends Controller
{
    public function index(){
        $banners = Banner::where(['status' => 1])->get()->sortBy('sort')->toArray();
        $products = Product::with('images')->where('status', 1)->get()->sortBy('created_at')->toArray();
        $categories = Category::tree();
        //dd($products);

        return view('front/index', compact('banners', 'products','categories'));
    }

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
            if ($Url == "search") {
                $products = Product::productFilterSort($request);
                $categories = Category::tree();
                $sizes = ProductAttribute::getSizes();
                $colors = ProductAttribute::getColors();
                $CategoryDetails = $categories;
                $crumb = 'Shop / Search / '.$request->search;
                $breadcrumbs = [ ['url' => 'shop' , 'category_name' => $crumb, 'search' => $request->search] ];
            } 
            else {
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

}
