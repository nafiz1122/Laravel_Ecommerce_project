<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){

        return $this->belongsTo(Category::class,'category_id');
    }
    public function brand(){

        return $this->belongsTo(Brand::class,'brand_id');
    }
}
