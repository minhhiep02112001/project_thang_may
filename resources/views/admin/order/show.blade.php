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
                    <form action="{{ route('don-hang.update', ['id' => $order->id]) }}" method="post">
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
                                    <td>{{ number_format($order->total) }}</td>
                                </tr>
                                <tr>
                                    <td><label>Email :</label></td>
                                    <td>{{ $order->email }}</td>
                                    <td><label>Khuyến mại</label></td>
                                    <td>{{ number_format($order->discount) }} đ</td>
                                </tr>
                                <tr>
                                    <td><label>Địa chỉ :</label> </td>
                                    <td colspan="">{{ $order->address }}</td>
                                    <td><label>Thành tiền</label></td>
                                    <td style="color: red">{{ number_format($order->total - $order->discount) }} đ</td>

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
                                        <select class="form-control " name="order_status_id" style="max-width: 150px;display: inline-block;">
                                            <option value="0">-- chọn --</option>
                                            {{-- @foreach($order_status as $status)
                                                <option {{ ($order->order_status_id == $status->id ? 'selected':'') }} value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach --}}
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

		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên sản phẩm</th>
							<th width="110px;">Hình ảnh</th>
							<th>Giá bán</th>
							<th>Đơn vị</th>
							<th>Số lượng mua</th>
							<th>Tổng tiền</th>
						</tr>
					</thead>
					<tbody>
						@foreach($order->orderDetails as $item => $key)
							<tr>
								<td>{{ $item }}</td>
								<td>{{ $key->product->name }}</td>
								<td>
									@if($key->product->image)
										<img src="{{ $key->product->image }}" alt="key->product->name" style="max-width:100px;max-height:80px;">
									@endif
								</td>
								<td>{{ number_format($key->price) }} <sup>VNĐ</sup></td>
								<td>null</td>
								<td>{{  number_format($key->qty) }}</td>
								<td>{{ number_format($key->total) }} <sup>VNĐ</sup></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<div class="row">
			<!-- accepted payments column -->
			<div class="col-xs-6">
				{{-- <p class="lead">Payment Methods:</p>
				<img src="../../dist/img/credit/visa.png" alt="Visa">
				<img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
				<img src="../../dist/img/credit/american-express.png" alt="American Express">
				<img src="../../dist/img/credit/paypal2.png" alt="Paypal">

				<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
					Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
					dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
				</p> --}}
			</div>
			<!-- /.col -->
			<div class="col-xs-6">
				<p class="lead">Giờ Mua : <b>{{ date_format($order->created_at , ' H:i:s a') }}</b>   Ngày :  <b>{{ date_format($order->created_at , ' d-m-Y') }}</b></p>

				<div class="table-responsive">
					<table class="table">
						<tr>
							<th style="width:50%">Tổng Tiền :</th>
							<td>{{ number_format($order->total )}} <sup>VNĐ</sup></td>
						</tr>
						<tr>
							<th>Phí Ship:</th>
							<td> 0 <sup>VNĐ</sup></td>
						</tr>
						<tr>
							<th>Thanh Toán:</th>
							<td>{{ number_format($order->total )}} <sup>VNĐ</sup></td>
						</tr>
					</table>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- this row will not appear when printing -->
		<div class="row no-print">
			<div class="col-xs-12">
			{{-- 	<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> --}}
				<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
				</button>
				<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
					<i class="fa fa-download"></i> Generate PDF
				</button>
			</div>
		</div>
	</section>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>

@endsection
