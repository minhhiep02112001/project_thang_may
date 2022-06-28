@extends('admin.layout.__index')
@section('content')
    @if (session('error'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                iconColor:'red',
                html: '<h4 style="color:black;font-weight:500;">Lỗi</h4>',
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
            Thêm Nhà Cung Cấp <a href="{{route('nha-cung-cap.index')}}" class="btn btn-flat btn-success "><i
                    class="fa fa-list"></i> Danh Sách Nhà Cung Cấp</a>
        </h1>
    </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form action="{{ route('nha-cung-cap.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">
                                    <label>Tên Nhà Cung Cấp <span class="text-danger">(*)</span>:</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="tên ........">
                                     @if($errors->has('name'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Email :</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="email ........">
                                     @if($errors->has('email'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Số Điện Thoại :</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="phone ........">
                                     @if($errors->has('phone'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Địa Chỉ:</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="địa chỉ  ........">
                                     @if($errors->has('address'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Website :</label>
                                    <input type="text" class="form-control" name="website" id="website" placeholder="link ........">
                                     @if($errors->has('website'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('website') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Image :</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control fileName" disabled="" id="fileName">
                                        <input class="file-upload-input" name="image" hidden="hidden" style="position:absolute;" type='file' onchange="readURL(this);" accept="image/*" />
                                        <span class="input-group-btn">
                                            <button type="button"  onclick="$('.file-upload-input').trigger( 'click' )" class="btn btn-info btn-flat">Add Image</button>
                                        </span>
                                    </div>

                                    <div class="file-upload-content text-center ">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Vị trí</label>
                                    <input type="number" value="1" class="form-control" name="position">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_active" value="1"> Hiển thị                                    </label>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
