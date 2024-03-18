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

    public static function tree($url = null)
    {
       $allcategories = Category::with('parent')->where('status', 1)->get();

       if($url != null){
        $rootcategories = $allcategories->where('url',$url);
       }
       else {
        $rootcategories = $allcategories->where('parent_id',null);
       }
       
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

    public static function parentTree($id)
    {
       $allcategories = Category::where('status', 1)->get();

        $leafcategories = $allcategories->where('cat_id',$id);
       
       self::parentFormatTree($leafcategories, $allcategories);
       
       return json_decode($leafcategories, true);
    }
    private static function parentFormatTree($categories, $allcategories)
    {
        foreach ($categories as $leaf ) {
            $leaf->parent = $allcategories->where('cat_id', $leaf['parent_id']);

            if($leaf->parent != null)
            {
                self::parentFormatTree($leaf->parent, $allcategories);
            }
       }
       
    }
}
