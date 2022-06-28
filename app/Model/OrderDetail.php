<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Order;
use App\User;
use App\Model\Product;
use App\Model\OrderStatus;
class OrderDetail extends Model
{
    //
    protected $table = 'order_detail';
    public $timestamps = false;

    public function order()
    {
        // code...
        return $this->belongsTo(Order::class , 'order_id' , 'id');
    }

    public function product()
    {
        // code...
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    }
    public function user()
    {
        // code...
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
    public function order_status(){

        return $this->hasOne(OrderStatus::class, 'order_status_id', 'id');
        
    }
}
