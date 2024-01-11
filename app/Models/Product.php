<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','cat_id')->with('parentcategory');
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
}
