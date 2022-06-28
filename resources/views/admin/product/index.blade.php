@extends('admin.layout.__index')
@section('content')
<div class="content-wrapper">
     @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                iconColor:'green',
                html: '<h4 style="color:black;font-weight:500;">'+ <?php echo json_encode( session()->pull('success') );?> +'</h4>',
                background:'#fff',
                toast: true,
                position: 'center',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            })
        </script>

    @endif
    <style>tr td:first-child {max-width: 250px}</style>
   <section class="content-header d-flex" style="display:flex;justify-content: space-between;">
        <h1>
            Quản Lý Sản Phẩm
        </h1>

        @can('create' , App\Model\Product::class)
             <a href="{{ route('san-pham.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm Mới Sản Phẩm</a>
        @endcan
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{ route('san-pham.index') }}" title="">Danh Sách</a></h3>

                        <div class="box-tools">
                            <form action="" method="get" accept-charset="utf-8">
                                <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                                    <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="{{request('search')}}">
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
                                <th>TT</th>
                                <th > Danh Mục</th>
                                <th >Nhà Cung Cấp</th>
                                <th >Thương Hiệu</th>
                                <th style="max-width:180px!important;">Tên Sản Phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá KM</th>
                                <th>Màu</th>
                                <th>SP Hot</th>
                                <th>Trạng thái</th>
                                <th>Người tạo</th>
                                <th class="text-center"></th>
                            </tr>

                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($products as $item => $key)
                                <tr class="key-{{ $key->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{ $rank++ }}</td>
                                    <td> {{ (isset($key->category))?$key->category->name:'null' }}</td>
                                    <td> {{ (isset($key->vendor))?$key->vendor->name:'null' }}</td>
                                    <td> {{ (isset($key->brand))?$key->brand->name:'null' }}</td>
                                    <td>{{ mb_substr($key->name, 0, 80) }} {{ strlen($key->name) > 80 ?' ...':'' }}</td>
                                    <td>
                                    @if ($key->image) <!-- Kiểm tra hình ảnh tồn tại -->
                                        <img src="{{asset($key->image)}}" width="50" height="50">
                                        @endif
                                    </td>
                                    <td>{{ $key->stock }}</td>
                                    <td>{{ number_format($key->sale,0,',','.') }}<sup>đ</sup></td>
                                    <td>{{ $key->color }}{{ ($key->memory)?"-$key->memory":"" }}</td>
                                    <td>{!! ($key->is_hot == 1) ? '<span class="badge bg-green">Có</span>' : '<span class="badge bg-red">Không</span>' !!}</td>
                                    <td>{!! ($key->is_active == 1) ? '<span class="badge bg-green">Hiển thị</span>' : '<span class="badge bg-red">Ẩn</span>' !!}</td>
                                    <td>{{ isset($key->user->name) ?  $key->user->name : ''}}</td>
                                    <td align="center" style="padding:5px; display:flex;justify-content: space-between;">
                                        {{-- <button class="btn btn-sm btn-success">Xem</button> --}}
                                        @can('update' , $key)
                                            <a href="{{ route('san-pham.edit',['id'=>$key->id ]) }}" class="btn btn-xs btn-sm btn-warning" title="">
                                           {{--  <i class="fa fa-fw fa-pencil-square-o"></i> --}}
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan


                                        @can('delete' , $key)
                                            <button type="button" class="btn btn-xs btn-sm btn-danger btn-delete" data-id="{{ $key->id }}" data-model="san-pham">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            @if($products->count() == 0)
                                <tr>
                                    <td colspan="13" class="text-center text-danger">Không tồn tại bản ghi nào</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
                <div class="box-footer clearfix text-center flex-row">
                    {{ $products->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
</div>
@endsection
