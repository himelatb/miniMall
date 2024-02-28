<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    public static function getSizes($ids = null){

        if($ids == null){
            $sizes = ProductAttribute::distinct()->get('size')->toArray();
        }
        else{
            $sizes = ProductAttribute::whereIn('category_id', $ids)->distinct()->get('size')->toArray();
        }
        
        return $sizes;
    }
    public static function getColors($ids = null){

        if($ids == null){
            $color = ProductAttribute::select('color','color_code')->distinct()->get()->toArray();
        }
        else{
            $color = ProductAttribute::select('color','color_code')->whereIn('category_id', $ids)->distinct()->get()->toArray();
        }

        return $color;
    }

    public static function getProductSizes($id){
            $sizes = ProductAttribute::where('product_id', $id)->distinct()->get('size')->toArray();
        
        return $sizes;
    }
    public static function getProductColors($id){

            $color = ProductAttribute::select('color','color_code')->where('product_id', $id)->distinct()->get()->toArray();

        return $color;
    }
}
