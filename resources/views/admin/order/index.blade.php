@extends('admin.layout.__index')

@section('css')
@endsection

@section('content')


    @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                iconColor:'green',
                html: '<h4 style="color:black;font-weight:500;">'+ <?php echo json_encode( session('success')); ?> +'</h4>',
                background:'#fff',
                toast: true,
                position: 'center',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            })
        </script>
    @endif


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header d-flex" style="display:flex;justify-content: space-between;">
        <h1>
            Quản Lý Hóa Đơn
        </h1>
        {{-- @can('create' ,App\Role::class)
        <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm Mới Quyền</a>
        @endcan --}}
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{ route('order.index') }}" title="">Danh Sách Hóa Đơn</a></h3>

                        <div class="box-tools">
                            <form action="" method="get" accept-charset="utf-8">
                                <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                                    <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="{{ request('search') }}">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th >#</th>
                                <th >Ngày Đặt</th>
                                <th >Mã Đơn Hàng</th>
                                <th >Trạng Thái</th>
                                <th >Tên Người Mua</th>
                                <th >Điện Thoại</th>
                                <th >Email</th>
                                <th >Tổng Tiền</th>
                                <th > Phương thức</th>
                                <th ></th>
                            </tr>
                            @foreach($orders as $item => $key)

                                <tr>
                                    <td>{{ $rank++ }}</td>
                                    <td>{{ date_format($key->created_at," H:i:s a  d-m-Y") }}</td>
                                    <td>{{ $key->code }}</td>
                                    <td>
                                        @if ($key->order_status_id === 1)
                                            <span class="label label-info">Đặt Hàng</span>
                                        @elseif ($key->order_status_id === 2)
                                            <span class="label label-warning">Đang Xử Lý</span>
                                        @elseif ($key->order_status_id === 3)
                                            <span class="label label-success">Hoàn Thành</span>
                                        @else
                                            <span class="label label-danger">Hủy Đơn Hàng</span>
                                        @endif
                                    </td>
                                    <td>{{ $key->fullname }}</td>
                                    <td>{{ $key->phone }}</td>
                                    <td>{{ $key->email }}</td>
                                    <td class="text-red">{{ number_format($key->total - $key->discount , 0 , ',' , '.') }}<sup>đ</sup></td>
                                    <td>
                                        @if($key->payment_id)
                                            <span class="label label-success">Online</span>
                                        @else
                                            <span class="label label-primary">Trực Tiếp</span>
                                        @endif
                                    </td>
                                    @can('update',$key)
                                    <td>
                                        <button type="button" class="btn btn-xs btn-block btn-primary" onclick="location.href='{{ route('order.edit', ["id" => $key->id]) }}' ">Chi Tiết</button>
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                            @if($orders->count() == 0)
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Không tồn tại bản ghi nào</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix text-center flex-row">
                        {{ $orders->appends(request()->all())->links() }}

                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

        </div>

    </section>
    <!-- /.content -->
</div>
@endsection

@section('js')
<script>

</script>

@endsection





