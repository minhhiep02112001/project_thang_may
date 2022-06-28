<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'payments';
    protected $fillable = ['p_order_id', 'order_code', 'p_user_id', 'p_money', 'p_note', 'p_vnp_response_code', 'p_code_vnpay', 'p_code_bank', 'p_time'];
}
