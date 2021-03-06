@extends('admin.layout.__index')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    @if (session('error'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                iconColor: 'red',
                html: '<h4 style="color:black;font-weight:500;">Lỗi </h4>',
                background: '#fff',
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
                Thêm Mới Danh Mục <a href="{{ route('danh-muc.index') }}" class="btn btn-flat btn-success "><i
                        class="fa fa-list"></i> Danh Sách Danh Mục</a>
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
                        <form action="{{ route('danh-muc.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Danh Mục Cha :</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="0">------- Không thuộc danh mục nào -------</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="name">Tên Danh Mục : <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                        id="name" placeholder="Nhập tên ........">
                                    @if ($errors->has('name'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('name') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Image :</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control fileName" disabled="" id="fileName">
                                        <input class="file-upload-input" name="image" hidden="hidden"
                                            style="position:absolute;" type='file' onchange="readURL(this);"
                                            accept="image/*" />
                                        <span class="input-group-btn">
                                            <button type="button" onclick="$('.file-upload-input').trigger( 'click' )"
                                                class="btn btn-info btn-flat">Add Image</button>
                                        </span>
                                    </div>

                                    <div class="file-upload-content text-center ">

                                    </div>
                                    @if ($errors->has('image'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('image') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Vị trí :</label>
                                    <input type="number" value="{{ old('position') ? old('position') : 0 }}"
                                        min="0" class="form-control" name="position">
                                </div>

                                <div class="form-group">
                                    <label>Mô Tả :</label>
                                    <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Loại Danh Mục :</label>
                                    <select class="form-control" name="type">

                                        <option value="0" {{ old('type') == 0 ? 'selected' : '' }}>Sản phẩm</option>
                                        <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Dự án</option>
                                        <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Tin tức</option>
                                    </select>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_active" value="1"
                                            {{ old('is_active') == 1 ? 'checked' : '' }}> <b>Hiển thị</b>
                                    </label>
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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select[name="parent_id"]').select2();
        });
    </script>
@endsection
