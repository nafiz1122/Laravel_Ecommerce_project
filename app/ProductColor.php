<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    public function color()
    {
        return $this->belongsTo('App\Color', 'color_id', 'id');
    }
}
