@extends('admin.layout.__index')
@section('css')
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header d-flex" style="display:flex;justify-content: space-between;">
        <h1>
            Quản Lý Banner
        </h1>

        @can('create' , App\Model\Banner::class)
            <a href="{{ route('banner.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới banner</a>

        @endcan
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{ route('banner.index') }}" title="">Danh Sách</a></h3>

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
                                <th >Tiêu đề</th>
                                <th class="text-center">Hình Ảnh</th>
                                <th >Target</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Vị Trí</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">Trạng thái</th>
                                <th ></th>
                            </tr>
                            @foreach($banners as $banner)
                            <tr>
                                <td>{{$rank++}}</td>
                                <td style="max-width:400px;">{{$banner->title}}</td>
                                <td align="center">
                                    @if($banner->image)
                                        <div style="width:150px ; max-height:90px;">
                                            <img src="{{ ($banner->image)?$banner->image:'' }}" style="width: auto; height: 48px" alt="">
                                        </div>
                                     @endif
                                </td>
                                <td>
                                   {{ $banner->target }}
                                </td>
                                <td>

                                    @switch($banner->type)
                                        @case(0)
                                            <span>Trang Chủ</span>
                                            @break

                                        @case(1)
                                            <span>Danh Mục</span>
                                            @break

                                        @case(2)
                                            <span>Chi Tiết Sản Phẩm</span>
                                            @break

                                        @case(3)
                                            <span>Tin Tức</span>
                                            @break

                                        @case(4)
                                            <span>Chi Tiết Tin Tức</span>
                                            @break

                                        @case(5)
                                            <span>Liên Hệ</span>
                                            @break

                                        @case(6)
                                            <span>Giỏ Hàng </span>
                                            @break

                                        @case(7)
                                            <span>Chất lượng (trang chủ)</span>
                                            @break
                                    @endswitch

                                </td>
                                <td class="text-center">{{ $banner->position }}</td>
                                <td>
                                   @if($banner->url)
                                        <a href="{{ $banner->url }}" target="_blank" title="">{{ (strlen($banner->url) > 30)?substr($banner->url, 0 , 30).' ...':$banner->url }}</a>
                                   @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge {{($banner->is_active == 0)?'bg-red':'bg-green'}} ">{{($banner->is_active == 0)?'ẩn':'hiển thị'}}</span>

                                </td>
                                <td align="center">
                                    {{-- <button class="btn btn-sm btn-success">Xem</button> --}}
                                    @can('update' , $banner)
                                    <a href="{{ route('banner.edit',['id'=>$banner->id]) }}" class="btn btn-xs btn-sm btn-warning" title="">
                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                    </a>
                                    @endcan
                                    <button type="button" class="btn btn-xs btn-sm btn-danger btn-delete" data-id="{{ $banner->id }}" data-model="banner">
                                        <i class="fa fa-fw fa-remove"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @if($banners->count() == 0)
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Không tồn tại bản ghi nào</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix text-center flex-row">
                        {{ $banners->appends(request()->all())->links() }}
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

