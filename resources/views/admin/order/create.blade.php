@extends('admin.layout.__index')
@section('css')
   <style type="text/css">
        input[type="checkbox"] {
            transform: scale(1.5);
        }
    </style>
@endsection
@section('content')
    @if (session('error'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                iconColor:'red',
                html: '<h4 style="color:black;font-weight:500;">Lỗi </h4>',
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
        <section class="content-header">
            <h1>
                Thêm Quyền Quản Trị <a href="{{route('roles.index')}}" class="btn btn-flat btn-success "><i
                        class="fa fa-list"></i> Danh Sách Quyền Quản Trị</a>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        
                        <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                
                                <div class="form-group">
                                    <label for="name">Tên Quyền :</label>
                                    <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="Nhập họ &amp; tên">
                                    @if ($errors->has('name')) 
                                    <small class="text-danger">Error : {{ $errors->first('name') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="display_name">Mô Tả :</label>
                                    <textarea class="form-control" name="display_name" rows="5" placeholder="Enter ..."></textarea>
                                    @if ($errors->has('display_name')) 
                                        <small class="text-danger">Error : {{ $errors->first('display_name') }}</small>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label>Chức vụ :</label>
                                    @foreach($permissionParent as $key)
                                    <div class="panel panel-default">
                                        <div class="panel-heading bg-green ">
                                            <label>
                                                <input type="checkbox" class="danh-muc" name="noibat"> <b>{{ $key->name }}</b>
                                            </label>
                                        </div>
                                        
                                        <div class="panel-body">
                                            <div class="row">
                                                @foreach($key->permissionsChildren as $item)
                                                <div class="col-12 col-md-3">
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <div >
                                                                <label><input type="checkbox" class="quyen" name="permission[]" value="{{ $item->id }}" name="noibat"> <b> &nbsp;&nbsp;{{ $item->name }}</b></label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="checkbox ">
                                    <label>
                                        <input type="checkbox" id="selected_all"> <b>&nbsp;Chọn tất cả</b>
                                    </label>

                                </div>
                                @if ($errors->has('permission')) 
                                    <small class="text-danger">Error : {{ $errors->first('permission') }}</small>
                                @endif
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $(".danh-muc").click(function(){
                console.log("1");
                $(this).parents('.panel').find('.quyen').prop('checked', $(this).prop('checked'));
            });
            $('#selected_all').click(function(){
                console.log("true");
                $('[type|="checkbox"]').prop('checked',$(this).prop('checked'));
            });
        });
    </script>
@endsection
