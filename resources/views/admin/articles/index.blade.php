@extends('admin.layout.__index')
@section('content')

    <div class="content-wrapper">
        @if (session('success'))
            <script type="text/javascript">
                Swal.fire({
                    icon: 'success',
                    iconColor: 'green',
                    html: '<h4 style="color:black;font-weight:500;">' + <?php echo json_encode(session('success')); ?> +'</h4>',
                    background: '#fff',
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })
            </script>
        @endif
        <style>tr td:first-child {
                max-width: 250px
            }</style>

        <section class="content-header d-flex" style="display:flex;justify-content: space-between;">
            <h1>
                Quản Lý Tin Tức
            </h1>
            @can('create' ,App\Model\Article::class)
                <a href="{{ route('tin-tuc.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm Mới Bài
                    Viết</a>
            @endcan

        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><a href="{{ route('tin-tuc.index') }}" title="">Danh Sách</a></h3>

                            <div class="box-tools">
                                <form action="" method="get" accept-charset="utf-8">
                                    <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                                        <input type="text" name="search" class="form-control pull-right"
                                               placeholder="Search" value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>TT</th>
                                    <th style="max-with:200px">Tên SP</th>
                                    <th>Hình ảnh</th>
                                    <th>Loại</th>
                                    <th>Vi trí</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>

                                <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                                @foreach($articles as $key => $item)

                                    <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                        <td>{{$rank++}}</td>
                                        <td>{{ mb_substr($item->title, 0 , 100) }} {{ (strlen($item->title) > 99 ) ?'...':'' }}</td>
                                        <td>
                                        @if ($item->image) <!-- Kiểm tra hình ảnh tồn tại -->
                                            <img src="{{asset($item->image)}}" width="50" height="50">
                                            @endif
                                        </td>
                                        <td>

                                            @if ($item->type === 0)
                                                <span>Tin tức </span>
                                            @else
                                                <span>{{ $item->category ? $item->category->name : null }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->position }}</td>
                                        <td>{{ ($item->is_active == 1) ? 'Hiển thị' : 'Ẩn' }}</td>
                                        <td class="text-center">
                                            @can('update' , $item)
                                                <a href="{{ route('tin-tuc.edit',['id'=>$item->id ]) }}"
                                                   class="btn btn-xs btn-sm btn-warning" title="">
                                                    {{--  <i class="fa fa-fw fa-pencil-square-o"></i> --}}
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete' , $item)
                                                <button type="button" class="btn btn-xs btn-sm btn-danger btn-delete"
                                                        data-id="{{ $item->id }}" data-model="tin-tuc">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                @if($articles->count() == 0)
                                    <tr>
                                        <td colspan="8" class="text-center text-danger">Không tồn tại bản ghi nào</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix text-center flex-row">
                            {{ $articles->appends(request()->all())->links() }}

                        </div>
                    </div>
                </div>
                <!-- /.row -->
        </section>
    </div>
@endsection
