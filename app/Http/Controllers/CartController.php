<?php

namespace App\Http\Controllers;

use App\Model\Payment;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Setting;
use Cart;
use App\Http\Requests\PostOrderClient;
use App\Model\Order;
use App\Model\Coupon;
use App\Model\Banner;
use App\Model\OrderDetail;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use Session;

class CartController extends ClientController
{

    private $vnp_TmnCode = "XZTULSLO"; //Mã website tại VNPAY
    private $vnp_HashSecret = "RWQRMGYGWFGOHAHNMURLEXXPFWRLJOLS"; //Chuỗi bí mật
    private $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $banner = Banner::where(['is_active' => 1, 'type' => 6])->orderBy('position', 'asc')->first();

        $carts = Cart::content();

        $count = Cart::count();

        $total = Cart::subtotal(0, ',', '');

        return view('frontend.cart.index', compact('carts', 'total', 'count', 'banner'));
    }

    public function addCart($id, $qty = 1)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $cartItem = Cart::search(function ($index) use ($id) {
            if ($index->id == $id) {
                return $index;
            }
        });
        if ($cartItem->count() > 0) {
            $item = $cartItem->first();
            $quantity = Cart::get($item->rowId)->qty + $qty;
            if ($quantity > $product->stock) {
                return redirect()->route('details.products', ['slug' => $product->slug])
                    ->with('error', 'Số lượng hàng chúng tôi không đủ bán khi bạn mua quá nhiều');
            }
        }
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $qty, 'price' => $product->sale,
            'options' => [
                'image' => $product->image,
                'color' => $product->color,
                'sale' => $product->sale,
                'memory' => $product->memory,
                'slug' => $product->slug]
        ]);
        return redirect()->route('shop.cart');
    }

    private function checkQtyCartAndQtyProduct($id, $qty) // kiểm tra số lượng mua và số lượng sản phẩm còn
    {
        $product = Product::where('id', $id)->firstOrFail();
        if ($product->stock < $qty) {
            return true;
        } else {
            return false;
        }
    }

    //update số lượng sản phẩm trong giỏ hàng :
    public function updateQtyProductCart(Request $request /*,  $id , $qty = 0*/)
    { // method put : thay đổi số lượng sản phẩm khi mua hàng
        $id = $request->id;
        $qty = ($request->qty) ? $request->qty : 0;

        if ($this->checkQtyCartAndQtyProduct($id, $qty)) {
            return response()->json([
                'status' => 'error',
                'text' => 'Số lượng không đủ bán '
            ], 200);
        }

        $cartItem = Cart::search(function ($index) use ($id) {
            if ($index->id == $id) {
                return $index;
            }
        });
        $item = $cartItem->first();
        $arr = [];
        if ($qty == 0) {
            Cart::remove($item->rowId); // Xóa sản phẩm trong giỏ hàng

        } else {
            Cart::update($item->rowId, $qty);
            $arr = Cart::get($item->rowId)->toArray();
        }

        return response()->json([
            'status' => 'success',
            'total' => Cart::subtotal(0, ',', '.'),
            'productCart' => $arr
        ], 200);

    }

    // xóa 1 bỏ sản phẩm trong giỏ hàng
    public function deleteProductCart($id)
    {
        Cart::remove($id); // Xóa sản phẩm trong giỏ hàng theo id

        if (Cart::count() == 0) { // nếu giỏ hàng không tồn tại sp thì xóa giỏ hàng luôn @@@
            Cart::destroy();
        }

        return response()->json([
            'status' => 'success',
            'total' => Cart::total(0, ',', '.'),
            'product' => Cart::content()->toArray()
        ], 200); // trả về json dữ liệu giỏ hàng
    }

    // xóa bỏ giỏ hàng
    public function removeCart(Request $request)
    {
        Cart::destroy();
        Session::remove('coupon');
        return redirect()->route('shop.cart');
    }

    // Get Thanh Toán
    public function viewInformationOrder()
    {
        // code...
        $carts = Cart::content();
        if ($carts->count() == 0) {
            return abort(404);
        }

        if (!Auth::guard('customer')->check()) {
            return redirect()->route('shop.login');
        } else {
            if (!Auth::guard('customer')->user()->is_active) {
                Auth::guard('customer')->logout();
                return redirect()->route('shop.login')->with('error', 'Tài khoản của bạn đã bị khóa');
            }
        }

        $total = Cart::subtotal(0, ',', '');
        return view('frontend.order_information.index', compact('carts', 'total'));
    }

    // Hủy đơn hàng:
    public function CancelOrder($id)
    {
        // code...
        $order = Order::findOrFail($id);
        $order->order_status_id = 4;
        $order->save();
        return back()->with('success', 'Hủy Thành Công');
    }

    //Check khuyến mại
    public function CheckCoupon(Request $request)
    {
        // code...
        $coupon = Coupon::where('code', '=', trim($request->coupon_code))->where('is_active', 1)->firstOrFail();

        $request->session()->put('coupon', $coupon);

        return redirect()->back()->with('success', 'Thêm mã giảm giá thành công');
    }

    public function unsetCoupon()
    {
        Session::remove('coupon');
        return redirect()->back();
    }

    /// Post : Thanh Toán
    public function postInformationOrder(PostOrderClient $request)
    {

        // code...
        $validated = $request->validate(
            [
                'fullname' => "required",
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required'
            ]

        ); // validate dữ liệu

        $order = new Order();
        $order->fullname = $request->fullname;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->total = Cart::subtotal(0, ',', '');
        $order->address = $request->address;
        $order->payment_id = $request->payment_id;
        $order->user_id = Auth::guard('customer')->id();
        $order->note = $request->note;
        $order->order_status_id = 1;
        $order->code = 'MH-' . date('d') . date('m') . date('Y') . '-' . time();
        $order->discount = 0;

        if (Session::has('coupon')) { // kiểm tra tồn tại mã giảm giá hay không
            $coupon = Session::get('coupon');
            if ($coupon->unti) {
                $order->discount = $coupon->value;
            } else {
                $order->discount = number_format((Cart::subtotal(0, ',', '') * $coupon->percent) / 100, 0, ',', '');
            }
            $order->coupon = $coupon->id;
        }

        if ($request->payment_id) { // nếu thanh toán qua VN Pay
            session([
                'url_prev' => url()->previous(),
                'customer_order' => $order
            ]);
            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $this->vnp_TmnCode,
                "vnp_Amount" => (Cart::subtotal(0, ',', '') - $order->discount) * 100,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => request()->ip(),
                "vnp_Locale" => 'vn',
                "vnp_OrderInfo" => "Thanh toán hóa đơn phí dich vụ",
                "vnp_OrderType" => 'billpayment',
                "vnp_ReturnUrl" => route('vnpay-return'),
                "vnp_TxnRef" => $order->code, //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $this->vnp_Url . "?" . $query;
            if (isset($this->vnp_HashSecret)) {
                // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                $vnpSecureHash = hash('sha256', $this->vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect($vnp_Url);
        } else {
            $order->save();

            if ($order->save()) {
                foreach (Cart::content() as $item) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->name = $item->name;
                    $orderDetail->image = $item->options->image;
                    $orderDetail->user_id = 0;
                    $orderDetail->color = $item->options->color;
                    $orderDetail->memory = $item->options->memory;
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_id = $item->id;
                    $orderDetail->price = $item->price;
                    $orderDetail->qty = $item->qty;
                    $orderDetail->total = $item->subtotal;
                    $orderDetail->save();
                }
            }
            $to_email = $request->email;
            Mail::send('mail.send_order_mail', ['order' => Order::find($order->id)], function ($message) use ($to_email) {
                $message->from('chuminhhiep0394599501@gmail.com', "Quản trị");
                $message->to($to_email);
                $message->subject('Thông tin hóa đơn');
            });
            Cart::destroy();
            return redirect()->route('shop.cart')->with('success', 'Đặt hàng thành công , Vui lòng check email để xem đơn hàng');
        }
    }

    public function vnpayReturn(Request $request)
    {
        $order = session('customer_order');
        $url = session('url_prev', '/');
        if ($request->vnp_ResponseCode == "00") {
            $order->order_status_id = 3;
            $order->save();
            if ($order->save()) {
                foreach (Cart::content() as $item) {

                    $orderDetail = new OrderDetail();
                    $orderDetail->name = $item->name;
                    $orderDetail->image = $item->options->image;
                    $orderDetail->sku = 0;
                    $orderDetail->color = $item->options->color;
                    $orderDetail->memory = $item->options->memory;
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_id = $item->id;
                    $orderDetail->price = $item->price;
                    $orderDetail->qty = $item->qty;
                    $orderDetail->total = $item->subtotal;
                    $orderDetail->user_id = Auth::guard('customer')->id();
                    $orderDetail->save();
                }
                try {
                    DB::beginTransaction();
                    Payment::create([
                        'p_order_id' => $order->id,
                        'order_code' => $order->code,
                        'p_user_id' => $order->user_id,
                        'p_money' => $request->vnp_Amount,
                        'p_note' => $request->vnp_OrderInfo,
                        'p_vnp_response_code' => $request->vnp_ResponseCode,
                        'p_code_vnpay' => $request->vnp_TransactionNo,
                        'p_code_bank' => $request->vnp_BankCode,
                        'p_time' => $request->vnp_PayDate
                    ]);
                    DB::commit();
                } catch (\Exception $ex) {
                    DB::rollBack();
                }
            }
            $to_email = $order->email;
            Mail::send('mail.send_order_mail', ['order' => Order::find($order->id)], function ($message) use ($to_email) {
                $message->from('chuminhhiep0394599501@gmail.com', "Quản trị");
                $message->to($to_email);
                $message->subject('Thông tin hóa đơn');
            });

            Cart::destroy();
            session()->forget('customer_orders');
            return redirect()->route('shop.cart')->with('success', 'Đã thanh toán phí dịch vụ , Vui lòng check email để xem đơnhàng');
        }
        session()->forget('url_prev');
        return redirect($url)->withErrors(['vnpay' => 'Lỗi trong quá trình thanh toán phí dịch vụ']);
    }
}
