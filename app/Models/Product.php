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

    /**
     * This function sorts and filters the products based on the request and ids.
     *
     * @param object $request The request object containing the filtering parameters.
     * @param array|null $ids The array of category ids to filter the products.
     * @return \Illuminate\Pagination\LengthAwarePaginator The paginated collection of sorted products.
     */
    public static function productFilterSort($request, $ids = null){
        // Initialize the product query
        if($ids == null) {
            if (isset($request->search)) {
                $search = $request->search;
                $products = Product::with(['images', 'attributes', 'brand'])
                    ->where(function ($query) use ($search) {
                        return $query->where('product_name', 'like', '%'.$search.'%')
                            ->orWhere('description', 'like', '%'.$search.'%')
                            ->orWhere('keywords', 'like', '%'.$search.'%')
                            ->orWhere('meta_keywords', 'like', '%'.$search.'%')
                            ->orWhere('meta_description', 'like', '%'.$search.'%')
                            ->orWhere('meta_title', 'like', '%'.$search.'%')
                            ->orWhereHas('category', function ($query) use ($search) {
                                $query->where('category_name', 'like', '%'.$search.'%');
                            });
                    });
            }
            else {
                $products = Product::with(['images', 'attributes', 'brand']);
            }
        } 
        else{
            // Filter the products by category ids
            $products = Product::with(['images', 'attributes', 'brand'])
            ->WhereIn('category_id', $ids);
        }   
            
        // Apply the filtering conditions
        if ($request->all() != null) {

            // Initialize the size and color arrays
            $sizes = array();
            $colors = array();
            
            // Filter the products by color
            if(!$request->has('allColors') && $request->colors != null) {
                foreach ($request->colors as $key => $value) {
                    $colors[] = $key;
                }
                // Apply the color filter
                $products = $products->whereHas('attributes', function($query) use ($colors){
                    $query->whereIn('color', $colors);
                });
            }

            // Filter the products by size
            if(!$request->has('allSizes') && $request->sizes != null) {
                foreach ($request->sizes as $key => $value) {
                    $sizes[] = $key;
                }
                // Apply the size filter
                $products = $products->whereHas('attributes', function($query) use ($sizes){
                    $query->whereIn('size', $sizes);
                }); 
            }

            // Filter the products by price
            if($request->has('price')){
                $products = $products->where('final_price',"<=", $request['price']);
            }

            // Sort the products
            if($request->has('sorting')) {
                switch ($request['sorting']) {
                    case 'Latest first':
                        // Sort the products by latest first
                        $products = $products->orderBy('created_at');
                        break;
                    case 'Price (Highest first)':
                        // Sort the products by highest price first and then by product price
                        $products = $products->orderByDesc('final_price')->orderByDesc('product_price');
                        break;
                    case 'Price (Lowest first)':
                        // Sort the products by lowest price first and then by product price
                        $products = $products->orderBy('final_price')->orderBy('product_price');
                        break;
                }
            }
        }

        // Apply the status filter and paginate the results
        $products = $products->where('status', 1)->paginate(20);

        // Return the paginated collection of sorted products
        return $products;
    
    }

}
