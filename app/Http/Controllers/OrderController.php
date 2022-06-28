<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\OrderDetail;
use Illuminate\Http\Request;
use App\Model\OrderStatus;
use Mail;
use PDF;
use App\Model\Setting;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(Order::class);
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }


    public function index(Request $request)
    {
        //
        $orders = Order::latest()->paginate(10);

        if($request->has('search')){
            $orders = Order::where(function($query) use ($request) {
                    $query->where('code','like',"%{$request->get('search')}%")
                        ->orWhere('phone','like',"%{$request->get('search')}%")
                        ->orWhere('fullname','like',"%{$request->get('search')}%")
                        ->orWhere('email','like',"%{$request->get('search')}%");
                })->orderBy('id' , 'desc')->paginate(10);
        }

        $rank = $orders->firstItem();

        return view('admin.order.index' , compact('orders' , 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
        $orderStatus = OrderStatus::all();
        return view('admin.order.edit' , compact('order' , 'orderStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        if($request->has('order_status_id') && in_array($request->order_status_id , [2,3]) ) {
            $list_product = OrderDetail::where('order_id', $order->id)->get();
            foreach ($list_product as $item ){
                if($item->qty  > $item->product->stock){
                    return back()->withErrors([ 'stock' => 'Số lượng sản phẩm trong kho không đủ bán ' ] );
                }
            }
        }

        $order->address2=$request->address2;
        $order->note = $request->note;
        if($request->has('order_status_id')){
            $order->order_status_id=$request-> order_status_id;
        }
        $order->save();


        if($order->save()){
            if($order->order_status_id == 3) {
                $list_product = OrderDetail::where('order_id', $order->id)->get();
                foreach ($list_product as $key) {
                    $product = $key->product;
                    $product->stock = $product->stock - $key->qty;
                    $product->save();
                }
            }
        }

        $user_mail = Auth::user()->email;
        $to_email = $order->email;

        Mail::send('mail.send_order_mail', ['order'=>$order], function ($message) use ( $user_mail , $to_email ) {
            $message->from($user_mail,  "Quản trị");


            $message->to($to_email);


            $message->subject('Thông tin hóa đơn');

        });

        return redirect()->route('order.index')->with('success' , 'Thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }


    public function printPDF($id){



        $order = Order::findOrFail($id);
        $setting =Setting::first();
        $pdf = PDF::loadView('admin.pdf.pdf_order',[
            'order'=> $order,
            'setting' => $setting
        ]);
        return $pdf->stream("order-invoice-$id.pdf");

    }
}
