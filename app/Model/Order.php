<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\OrderDetail;
use App\Model\OrderStatus;
class Order extends Model
{
    //
    protected $table ="orders";
    public $timestamps = true;

    protected $fillable = ['code' , 'fullname' ,'email' , 'address' , 'address2' , 'phone' , 'discount' , 'note' , 'coupon' , 'total' ,'user_id' , 'order_status_id' , 'payment_id' ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    public function orderStatus(){

         return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');

    }
    public function payments()
    {
        return $this->hasOne(Payment::class, 'p_order_id', 'id');
    }
}
