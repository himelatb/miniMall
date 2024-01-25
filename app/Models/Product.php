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
    
}
