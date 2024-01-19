<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->hasOne("App\Models\Category", "cat_id", "parent_id");
    }

    public static function tree()
    {
       $allcategories = Category::with('parent')->get();

       $rootcategories = $allcategories->where('parent_id',null);
       
       self::formatTree($rootcategories, $allcategories);
       
       return json_decode($rootcategories, true);
    }
    private static function formatTree($categories, $allcategories)
    {
        foreach ($categories as $root ) {
            $root->children = $allcategories->where('parent_id',$root['cat_id']);

            if(!empty($root->children))
            {
                self::formatTree($root->children, $allcategories);
            }
       }
       
    }
}
