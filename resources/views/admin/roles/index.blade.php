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
            Quản Lý Quyền Admin
        </h1>
        @can('create' ,App\Role::class)
        <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm Mới Quyền</a>
        @endcan
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                   <div class="box-header">
                        <h3 class="box-title"><a href="{{ route('roles.index') }}" title="">Danh Sách</a></h3>

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
                                <th width="5%">#</th>
                                <th width="40%">Tên Quyền</th>
                                <th width="45%">Mô tả</th>
                                <th ></th>
                            </tr>
                            @foreach($roles as $key)
                            <tr>
                                <td>{{$rank++}}</td>
                                <td>{{$key->name}}</td>

                                <td>
                                    {{ $key->display_name }}
                                </td>

                                <td align="center">
                                    {{-- <button class="btn btn-sm btn-success">Xem</button> --}}
                                    @can('update' , $key)
                                    <a href="{{ route('roles.edit',['id'=>$key->id ]) }}" class="btn btn-xs btn-sm btn-warning" title="">
                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                    </a>
                                    @endcan
                                    @can('delete' , $key)
                                    <button type="button" class="btn btn-xs btn-sm btn-danger btn-delete" data-id="{{ $key->id }}" data-model="roles">
                                        <i class="fa fa-fw fa-remove"></i>
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                             @if($roles->count() == 0)
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Không tồn tại bản ghi nào</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix text-center flex-row">
                        {{ $roles->appends(request()->all())->links() }}

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
