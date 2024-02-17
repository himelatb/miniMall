<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{

    public function catListing(){
        $Url = Route::getFacadeRoot()->current()->uri;
        $CategoryDetails = Category::Tree($Url);
        $catKey = array_keys($CategoryDetails)[0];
        $catIds[] = $CategoryDetails[$catKey]['cat_id'];
        $breadcrumbs = Category::parentTree($CategoryDetails[$catKey]['cat_id']);

        if($breadcrumbs[$catKey]['parent'] == null){
            $breadcrumbs = array((object) $breadcrumbs[$catKey]);
        }
        else{
            $crumbKey = array_keys($breadcrumbs);
            $index = 0;
            $nextkey = array_keys($breadcrumbs)[0];
            $parentCrumbs[$index] = json_encode($breadcrumbs[$nextkey]); 
            do{
                $index += 1;
                $nextkey = array_keys($breadcrumbs[$crumbKey[0]]['parent'])[0]; 
                $parentCrumbs[$index] = json_encode($breadcrumbs[$crumbKey[0]]['parent'][$nextkey]);
                $breadcrumbs = $breadcrumbs[$crumbKey[0]]['parent'];
                $crumbKey = array_keys($breadcrumbs);
            }
            while($breadcrumbs[$crumbKey[0]]['parent'] != null);
          
            $crumbs = array();
            foreach ($parentCrumbs as $key => $value) {
                array_push($crumbs, json_decode($value));
            }
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

        $products = Product::with(['images', 'attributes', 'brand'])->where('status', 1)
        ->WhereIn('category_id', $catIds)->paginate(20);
        $categories = Category::tree();

        $sortingOrder = null;

        if(isset($_GET['sorting']) && !empty($_GET['sorting'])) {
            switch ($_GET['sorting']) {
                case 'Latest first':
                    $products = Product::with(['images', 'attributes', 'brand'])->where('status', 1)
                    ->WhereIn('category_id', $catIds)
                    ->orderBy('created_at')->paginate(20);
                    $sortingOrder =$_GET['sorting'];
                    break;
                case 'Price (Highest first)':
                    $products = Product::with(['images', 'attributes', 'brand'])->where('status', 1)
                    ->WhereIn('category_id', $catIds)
                    ->orderByDesc('final_price')
                    ->orderByDesc('product_price')->paginate(20);
                    $sortingOrder = $_GET['sorting'];
                    break;
                case 'Price (Lowest first)':
                    $products = Product::with(['images', 'attributes', 'brand'])->where('status', 1)
                    ->WhereIn('category_id', $catIds)
                    ->orderBy('final_price')
                    ->orderBy('product_price')->paginate(20);
                    $sortingOrder = $_GET['sorting'];
                    break;
            }
             //dd($sortingOrder);
        }
        
        return view('front/productsPage', compact('products', 'CategoryDetails', 'categories', 'breadcrumbs','Url', 'sortingOrder'));


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
