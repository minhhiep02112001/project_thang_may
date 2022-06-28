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
                timerProgressBar: true,
                didClose:(toast) => {
                    location.reload();
                }
            })
        </script>
    @endif

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header d-flex" style="display:flex;justify-content: space-between;">
        <h1>
            Quản Lý Nhà Cung Cấp
        </h1>
        @can('create' ,App\Model\Vendor::class)
            <a href="{{ route('nha-cung-cap.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm Mới Nhà Cung Cấp</a>
        @endcan
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{ route('nha-cung-cap.index') }}" title="">Danh Sách</a></h3>

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
                                <th width="15%">Tên Nhà Cung Cấp</th>
                                <th class="text-center">Hình Ảnh</th>
                                <th >Email</th>
                                <th >Số Điện Thoại</th>
                                <th width="15%">Địa Chỉ</th>
                                <th >Link</th>
                                <th >Vị trí</th>
                                <th class="text-center">Trạng thái</th>
                                <th ></th>
                            </tr>
                            @foreach($vendors as $item=>$vendor)
                            <tr>

                                <td>{{$vendor->id}}</td>
                                <td>{{$vendor->name}}</td>
                                <td align="center">
                                    @if($vendor->image)
                                        <div style="width:50px ; height:50px; border:1px solid;"> 
                                            <img src="{{ ($vendor->image)?$vendor->image:'' }}" style="width:100%;" alt=""> 
                                        </div>
                                     @endif
                                </td>
                                <td>
                                    <span title="{{ $vendor->email }}">{{ (strlen($vendor->email) > 20)?substr($vendor->email, 0 , 20).' ...':$vendor->email }}</span>
                                </td>
                                <td>{{ $vendor->phone }}</td>
                                <td>{{ $vendor->address }}</td>
                                <td>
                                    @if($vendor->website)
                                        <a href="{{ $vendor->website }}" target="_blank" title="">{{ (strlen($vendor->website) > 20)?substr($vendor->website, 0 , 20).' ...':$vendor->website }}</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $vendor->position }}
                                </td>
                                <td class="text-center">
                                    <span class="badge change-status {{($vendor->is_active == 0)?'bg-red':'bg-green'}} ">{{($vendor->is_active == 0)?'ẩn':'hiển thị'}}</span>
                                </td>
                                <td align="center">
                                    {{-- <button class="btn btn-sm btn-success">Xem</button> --}}
                                    @can('update' , $vendor ) 
                                        <a href="{{ route('nha-cung-cap.edit',['id'=>$vendor->id]) }}" class="btn btn-xs btn-warning" title="">
                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                        </a>
                                    @endcan
                                    @can('delete' , $vendor )
                                        <button type="button" class="btn btn-xs btn-danger btn-delete" data-id="{{ $vendor->id }}" data-model="nha-cung-cap">
                                            <i class="fa fa-fw fa-remove"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @if($vendors->count() == 0)
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Không tồn tại bản ghi nào</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix text-center flex-row">
                        {{ $vendors->appends(request()->all())->links() }}
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

@endsection
