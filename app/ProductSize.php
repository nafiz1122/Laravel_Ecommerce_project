<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    public function size()
    {
        return $this->belongsTo('App\Size', 'size_id', 'id');
    }
}
