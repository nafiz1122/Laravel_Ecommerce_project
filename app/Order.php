<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function payment()
    {
        return $this->belongsTo('App\Payment', 'payment_id', 'id');
    }
    public function shipping()
    {
        return $this->belongsTo('App\Shipping', 'shipping_id', 'id');
    }
    public function orderdetail()
    {
        return $this->hasMany('App\OrderDetail', 'order_id', 'id');
    }
}
