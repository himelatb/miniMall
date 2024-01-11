<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parentcategory(){
        return $this->hasOne('App\models\Category','cat_id','parent_id')
        ->select('cat_id','category_name','url')->where('status',2);
    }
    public function subcategory(){
        return $this->hasMany('App\models\Category','parent_id','cat_id');
    }
    public static function getCategoryOptions(){
        $getcategories = Category::with('subcategory')->where('parent_id', 0)
        ->orWhere('parent_id', null)->where('status',2)->get()->toArray();
        return $getcategories;
    }
}
