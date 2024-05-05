<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    public function product(){
        return $this->hasOne("App\Models\Product",'id','product_id');
    }

    public function attribute(){
        return $this->hasOne("App\Models\ProductAttribute",'id','attribute_id');
    }

    public function images(){
        return $this->hasMany("App\Models\products_images",'product_id','product_id');
    }
}
