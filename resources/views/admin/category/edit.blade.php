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
                html: '<h4 style="color:black;font-weight:500;">Lỗi</h4>',
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
                Sửa Danh Mục <a href="{{ route('san-pham.index') }}" class="btn btn-flat btn-success "><i
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
                        <form action="{{ route('danh-muc.update', ['id' => $category->id]) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            {{-- <input type="hidden" name="id" value="{{ $category->id }}"> --}}
                            <div class="box-body">
                                <div class="form-group">

                                    <label>Danh Mục Cha :</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="0">------- Không thuộc danh mục nào -------</option>


                                        @foreach ($categories as $item)
                                            <option
                                                value="{{ $item->id }} "{{ $item->id == $category->parent_id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="name">Tên Danh Mục</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Nhập tên ........"
                                        value="{{ old('name') ? old('name') : $category->name }}">
                                    @if ($errors->has('name'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('name') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Image :</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" value="{{ $category->image }}" class="form-control fileName"
                                            disabled="" id="fileName">
                                        <input class="file-upload-input" name="image" hidden="hidden"
                                            style="position:absolute;" type='file' onchange="readURL(this);"
                                            accept="image/*" />
                                        <span class="input-group-btn">
                                            <button type="button" onclick="$('.file-upload-input').trigger( 'click' )"
                                                class="btn btn-info btn-flat">Add Image</button>
                                        </span>
                                    </div>

                                    <div class="file-upload-content text-center ">
                                        <img src="{{ $category->image }}"
                                            style="max-width:400px ; max-height:200px ; padding:20px;" alt="">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputPassword1">Vị trí</label>
                                    <input type="number" value="{{ $category->position }}" class="form-control"
                                        name="position">
                                </div>

                                <div class="form-group">
                                    <label>Mô Tả :</label>
                                    <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $category->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Loại Danh Mục :</label>
                                    <select class="form-control" name="type">
                                        <option value="0"
                                            {{ old('type') == 0 ? 'selected' : ($category->type == 0 ? 'selected' : '') }}>
                                            Sản phẩm</option>
                                        <option value="1"
                                            {{ old('type') == 1 ? 'selected' : ($category->type == 1 ? 'selected' : '') }}>
                                            Dự án</option>
                                        <option value="2"
                                            {{ old('type') == 2 ? 'selected' : ($category->type == 2 ? 'selected' : '') }}>
                                            Tin tức</option>
                                    </select>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" {{ $category->is_active ? 'checked' : '' }} name="is_active"
                                            value="1"> Hiển thị </label>
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