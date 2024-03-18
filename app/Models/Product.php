<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','cat_id')->with('parent');
    }

    public static function productsFilters()
    {
        $productsFilters['materialArray'] = array('Cotton','Polyester','Wool');
        $productsFilters['sleeveArray'] = array('Full','Half','Short','Sleeveless');
        $productsFilters['patternArray'] = array('Checked','Printed','Solid');
        $productsFilters['fitArray'] = array('Regular','Slim','Lose');
        $productsFilters['occasionArray'] = array('Casual','Semi-formal','Formal');
        return $productsFilters;
    }

    public function images()
    {
        return $this->hasMany('App\Models\products_images');
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\ProductAttribute');
    }

    public function brand()
    {
        return $this->hasOne('App\Models\Brand','id', 'brand_id');
    }

    public static function productFilterSort($request, $ids = null){

        if($ids == null) {
            $products = Product::with(['images', 'attributes', 'brand'])->where('status', 1);
        } 
        else{
            $products = Product::with(['images', 'attributes', 'brand'])->where('status', 1)
            ->WhereIn('category_id', $ids);
        }   
            
            if ($request->all() != null) {
                $sizes = array();
                $colors = array();
                
                if(!$request->has('allColors') && $request->colors != null) {
                    foreach ($request->colors as $key => $value) {
                        $colors[] = $key;
                    }
                    $products = $products->whereHas('attributes', function($query) use ($colors){
                        $query->whereIn('color', $colors);
                    });
                }
                if(!$request->has('allSizes') && $request->sizes != null) {
                    foreach ($request->sizes as $key => $value) {
                        $sizes[] = $key;
                    }
                    $products = $products->whereHas('attributes', function($query) use ($sizes){
                        $query->whereIn('size', $sizes);
                    }); 
                }
                //dd($request->has('colors'),$request->has('sizes'),$products->get());
        
                if($request->has('price')){
                    $products = $products->where('final_price',"<=", $request['price']);
                }
        
                if($request->has('sorting')) {
                    switch ($request['sorting']) {
                        case 'Latest first':
                            $products = $products->orderBy('created_at');
                            break;
                        case 'Price (Highest first)':
                            $products = $products->orderByDesc('final_price')->orderByDesc('product_price');
                            break;
                        case 'Price (Lowest first)':
                            $products = $products->orderBy('final_price')->orderBy('product_price');
                            break;
                    }
                }
            }
            $products = $products->paginate(20);
            //dd($products);

            return $products;


    }
    
}
