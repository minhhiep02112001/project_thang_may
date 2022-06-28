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
            Quản Lý Tài Khoản
        </h1>
        @can('create' ,App\User::class)
        <a href="{{ route('tai-khoan.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm Mới Tài Khoản</a>
        @endcan
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{ route('tai-khoan.index') }}" title="">Danh Sách</a></h3>

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
                                <th class="text-center">Chức Vụ</th>
                                <th >Tên tài Khoản</th>
                                <th class="text-center">Hình Ảnh</th>
                                <th >Email</th>
                                <th class="text-center">Quyền</th>
                                <th class="text-center">Trạng thái</th>
                                <th ></th>
                            </tr>
                            @foreach($users as $key)
                            <tr>
                                <td>{{$rank++}}</td>
                                <td class="text-left">
                                    {!! $key->is_admin ? '<span class="badge bg-light-blue">admin</span>' : '<span class="badge ">khách hàng</span>' !!}
                                </td>

                                <td>{{$key->name}}</td>
                                <td align="center">
                                    @if($key->avatar)
                                        <div style="width:50px ; height:50px; border:1px solid;">
                                            <img src="{{ ($key->avatar)?$key->avatar:'' }}" style="width:100%; max-height:50px; " alt="">
                                        </div>
                                     @endif
                                </td>
                                <td>
                                    {{ $key->email }}
                                </td>


                                <td class="text-center">

                                    @if($key->roles()->count() > 0 && $key->is_admin)

                                        {{ $key->roles()->pluck('name')->implode(' , ')}}

                                    @else

                                    @endif

                                </td>

                                <td class="text-center">
                                    <span class="badge {{($key->is_active == 0)?'bg-red':'bg-green'}} ">{{($key->is_active == 0)?'Khóa':'Kích hoạt'}}</span>

                                </td>
                                <td align="center">
                                    {{-- <button class="btn btn-sm btn-success">Xem</button> --}}
                                    @can('update' , $key)
                                    <a href="{{ route('tai-khoan.edit',['id'=>$key->id ]) }}" class="btn btn-xs btn-sm btn-warning" title="">
                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                    </a>
                                    @endcan
                                    @can('delete' , $key)
                                    <button type="button" class="btn btn-xs btn-sm btn-danger btn-delete" data-id="{{ $key->id }}" data-model="tai-khoan">
                                        <i class="fa fa-fw fa-remove"></i>
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @if($users->count() == 0)
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Không tồn tại bản ghi nào</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix text-center flex-row">
                        {{ $users->appends(request()->all())->links() }}

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
