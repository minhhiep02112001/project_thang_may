@extends('admin.layout.__index')

@section('css')
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thông tin đơn hàng
            <small>#007612</small>
        </h1>

    </section>

    {{-- <div class="pad margin no-print">
        <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
        </div>
    </div> --}}

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i>Đơn Hàng
                    <small class="pull-right">Ngày : {{ date_format($order->created_at,'d-m-Y') }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">

            <div class="box box-primary">
                @if($errors->has('stock'))
                    <div class="alert alert-danger alert-dismissible" style="margin: 5px 10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Lỗi !</h4>
                        {{ $errors->first('stock')  }}
                    </div>
                @endif
                    <form action="{{ route('order.update', ['id' => $order->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="box-header with-border">
                            <button type="submit" class="btn btn-info btn-flat">
                                <i class="fa fa-edit"></i>
                                Cập nhật
                            </button>
                        </div>

                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td><label for="">Mã ĐH :</label></td>
                                    <td>{{ $order->code }}</td>
                                    <td><label>Ngày Đặt Hàng:</label></td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                                <tr>
                                    <td><label for="">Họ tên :</label></td>
                                    <td>{{ $order->fullname }}</td>
                                    <td><label>Mã giảm giá</label></td>
                                    <td>{{ $order->coupon }}</td>
                                </tr>
                                <tr>
                                    <td><label>SĐT :</label> </td>
                                    <td>{{ $order->phone }}</td>
                                    <td><label>Tạm tính</label></td>
                                    <td>{{ number_format($order->total , 0 ,',','.' ) }}</td>
                                </tr>
                                <tr>
                                    <td><label>Email :</label></td>
                                    <td>{{ $order->email }}</td>
                                    <td><label>Khuyến mại</label></td>
                                    <td>{{ number_format($order->discount , 0 ,',','.' ) }} đ</td>
                                </tr>
                                <tr>
                                    <td><label>Địa chỉ :</label> </td>
                                    <td colspan="">{{ $order->address }}</td>
                                    <td><label>Thành tiền</label></td>
                                    <td style="color: red">{{ number_format($order->total - $order->discount , 0 ,',','.' ) }} đ</td>

                                </tr>
                                <tr>
                                    <td><label>Địa chỉ nhận hàng :</label> </td>
                                    <td colspan="">
                                        <div class="form-group">
                                            <input class="form-control" name="address2" value="{{ $order->address2 }}">
                                        </div>
                                    </td>
                                    <td><label>Trạng thái ĐH</label></td>
                                    <td style="color: red">
                                        <select class="form-control " name="order_status_id" style="max-width: 150px;display: inline-block; background:#eee; color:black; font-size:16px;"  {{$order->order_status_id == 3 ? 'disabled' :''}}>
                                            <option value="0">-- chọn --</option>
                                            @foreach($orderStatus as $status)
                                                <option {{ ($order->order_status_id == $status->id ? 'selected':'') }} value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Ghi chú :</label> </td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <textarea name="note" class="form-control" rows="3" placeholder="">{{ $order->note }}</textarea>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-xs-12">
                <h3 class="page-header"> Chi Tiết Đơn Hàng : </h3>
            </div>
            <!-- /.col -->
        </div>
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th width="35%">Tên sản phẩm</th>
                                    <th width="110px;">Hình ảnh</th>
                                    <th>Giá bán</th>
                                    <th>Màu / Bộ Nhớ</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $item => $key)
                                    <tr>
                                        <td>{{ $item }}</td>
                                        <td>{{ $key->name }}</td>
                                        <td>
                                            @if($key->image)
                                                <img src="{{ $key->image }}" alt="" style="max-width:100px;max-height:80px;">
                                            @endif
                                        </td>
                                        <td>{{ number_format($key->price , 0, ',','.') }} <sup> đ</sup></td>
                                        <td>{{ $key->color }} {{ $key->memory ? '- '.$key->memory : '' }}</td>
                                        <td>{{  number_format($key->qty) }}</td>
                                        <td>{{ number_format($key->total , 0 ,',','.' ) }} <sup> đ</sup></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                @if($order->payment_id)
                    <p class="lead">Payment Methods:</p>
                    <img src="./backend/dist/img/credit/visa.png" alt="Visa">
                    <img src="./backend/dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="./backend/dist/img/credit/american-express.png" alt="American Express">
                    <img src="./backend/dist/img/credit/paypal2.png" alt="Paypal">
                    @if($order->payments)
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">

                                <span><b>Mã Giao Dịch : </b> {{$order->payments->p_code_vnpay}}</span><br>
                                <span><b>Ngân Hàng : </b> {{$order->payments->p_code_bank}}</span><br>
                                <span><b>Trạng Thái : </b> {!! $order->payments->p_vnp_response_code ? '<span class="badge bg-green">Thành Công</span>' : '<span class="badge bg-red">Lỗi</span>' !!}</span>

                        </p>
                    @endif
                @endif
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Giờ Mua : {{ date_format($order->created_at , ' H:i:s a') }}   Ngày :  {{ date_format($order->created_at , ' d-m-Y') }}</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                            <th style="width:50%">Tổng tiền :</th>
                            <td>{{ number_format($order->total , 0 ,',','.' )}} <sup> đ</sup></td>
                        </tr>
                        <tr>
                            <th>Giảm Giá :</th>
                            <td>{{ number_format($order->discount , 0 ,',','.' ) }} đ <sup>đ</sup></td>
                        </tr>
                        <tr>
                            <th class="text-red" style="font-size: 16px;">Thanh Toán :</th>
                            <td class="text-red" style="font-size: 16px;">{{ number_format($order->total - $order->discount, 0 ,',','.' )}} <sup> đ</sup></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>

        <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>

@endsection
