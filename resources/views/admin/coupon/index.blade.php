@extends('admin.layout.__index')

@section('css')
@endsection

@section('content')


    @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                iconColor:'green',
                html: '<h4 style="color:black;font-weight:500;">'+ <?= json_encode( session('success')); ?> +'</h4>',
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
            Quản Lý Khuyến Mại
        </h1>
        @can('create' ,App\Model\Coupon::class)
        <a href="{{ route('khuyen-mai.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm Mới Khuyến Mại</a>
        @endcan
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{ route('khuyen-mai.index') }}" title="">Danh Sách</a></h3>

                        <div class="box-tools">
                            <form action="" method="get" accept-charset="utf-8">
                                <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                                    <input type="text" name="search" class="form-control pull-right" placeholder="Search code ..." value="{{ request('search') }}">
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
                                <th>#</th>
                                <th >Mã khuyến mại</th>
                                <th class="text-center">Loại</th>
                                <th> Số Tiền Giảm </th>
                                <th> Phần Trăm </th>
                                <th> Đơn Vị Tính </th>
                                <th class="text-center"> Trạng thái </th>
                                <th ></th>
                            </tr>
                            @foreach($arrCoupon as $key)
                            <tr>
                                <td>{{$rank++}}</td>
                                <td>{{ $key->code }}</td>
                                <td>{{ $key->type?"Khách hàng víp":"Khuyến mại thường" }}</td>
                                <td>{!! ($key->unti == 1) ? number_format($key->value , 0 ,',','.'). " đ" : '<del> '.number_format($key->value , 0 ,',','.').' đ </del>' !!}</td>
                                <td> {!! ($key->unti == 0) ? "$key->percent %" : "<del> $key->percent % </del>" !!} </td>
                                <td>{{ ($key->unti == 1) ? 'Giá Giảm' : "Phần Trăm (%)"}}</td>
                                <td><span class="badge {{($key->is_active == 0)?'bg-red':'bg-green'}} ">{{($key->is_active == 0)?'Hủy':'Kích hoạt'}}</span></td>
                                <td align="center">
                                    {{-- <button class="btn btn-sm btn-success">Xem</button> --}}
                                    @can('update' , $key)
                                    <a href="{{ route('khuyen-mai.edit',['id'=>$key->id ]) }}" class="btn btn-xs btn-sm btn-warning" title="">
                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                    </a>
                                    @endcan
                                    @can('delete' ,$key)
                                    <button type="button" class="btn btn-xs btn-sm btn-danger btn-delete" data-id="{{ $key->id }}" data-model="khuyen-mai">
                                        <i class="fa fa-fw fa-remove"></i>
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @if($arrCoupon->count() == 0)
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Không tồn tại bản ghi nào</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix text-center flex-row">
                        {{ $arrCoupon->appends(request()->all())->links() }}

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
