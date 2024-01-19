<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public static function colors(){

        $colors = Color::where('status', true)->orderBy("color_name", "asc")->get()->toArray();

        return $colors;
    }
}
