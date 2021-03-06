<base href="{{ asset('') }}">


<h2 style="text-align:center">Thông tin đặt hàng</h2>
<p><b>Mã Code :</b> {{ $order->code }}  </p>
<p><b>Họ tên :</b> {{ $order->fullname }}  </p>
<p><b>Email :</b> {{ $order->email }} </p>
<p><b>Số điện thoại :</b> {{ $order->phone }}  </p>
<p><b>Địa chỉ nhận :</b> {{ $order->address }}  </p>
<p><b>Ghi chú :</b> {{ $order->note }} </p>
<p><b>Giảm Giá :</b> {{ number_format($order->discount , 0 , ',' ,'.') }} VNĐ</p>
<p><b>Tổng tiền :</b> {{ number_format($order->total , 0 , ',' ,'.') }} VNĐ</p>

<p><b>Trạng Thái :</b> {{ $order->orderStatus->name }} </p>
<h3 style="text-align:center;"><b>Thông tin đơn hàng</b>
    <h3>
        <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;">
            <tr style="background:#eee;">
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">STT</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Tên sản phẩm</th>
                <th width="110px;" style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Hình ảnh</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Giá bán</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Màu - Bộ Nhớ</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Số lượng mua</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Tổng tiền</th>
            </tr>
            @foreach($order->orderDetails as $item => $key)
                <tr>
                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">{{ $item }}</td>
                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><a
                            href="{{route('details.products' , ['slug'=> $key->slug])}}">{{ $key->name }}</a></td>
                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">
                        @if($key->image)
                            <img src="{{ $key->image }}" alt="" style="max-width:100px;max-height:80px;">
                        @endif
                    </td>
                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">{{ number_format($key->price , 0 , ',','.') }}
                        <sup>VNĐ</sup></td>
                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">
                        {{ $key->color }} - {{ $key->memory }}
                    </td>
                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">{{  number_format($key->qty) }}</td>
                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">{{ number_format($key->total , 0 , ',','.') }}
                        <sup>VNĐ</sup></td>
                </tr>
            @endforeach
        </table>


        <p>Cảm ơn bạn đã đặt hàng của chúng tôi . Mọi chi tiết xin liên hệ 0394599501</p>
