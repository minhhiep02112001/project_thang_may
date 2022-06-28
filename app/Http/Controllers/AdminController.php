<?php

namespace App\Http\Controllers;

use App\Date\DateHandling;
use App\Model\Order;
use App\User;
class AdminController extends Controller
{
    //
    public function index(){
        $count_order = Order::where('order_status_id' , 1)->count();
        $count_order_success = Order::where('order_status_id' , 3)->count();
        $total_money = Order::select('total' , 'discount')->where('order_status_id',3)->get()->toArray();
        $arr_total_money = array_map(function($item)
        {
            return $item['total'] - $item['discount'];
        }, $total_money);

        $days = DateHandling::getListDayToMonth();
        $datas = [];
        foreach ($days as $key){
            $datas[] = Order::whereDate('created_at', $key)->where('order_status_id' , 3)->get()->count();
        }

        $count_customer = User::where('is_admin' , 0)->count();
        return view('admin.home' , [
            'count_order' => $count_order ,
            'count_order_success' => $count_order_success ,
            'total_money'=> array_sum($arr_total_money),
            'count_customer' => $count_customer,
            'days' =>  $days,
            'datas_day' => $datas
        ]);
    }
}
