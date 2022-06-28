@extends('admin.layout.__index')

@section('css')
    <style type="text/css">

        .file-upload-image {
          max-height: 200px;
          max-width: 300px;
          margin: auto;
          padding: 20px;
        }

    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Thêm Thương Hiệu  <a href="{{route('thuong-hieu.index')}}" class="btn btn-flat btn-success "><i
                    class="fa fa-list"></i> Danh Sách Thương Hiệu</a>
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
                        <form action="{{ route('thuong-hieu.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">
                                    <label>Tên Thương Hiệu <span class="text-danger">(*)</span>:</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="tên nhãn hiệu ........">
                                     @if($errors->has('name'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('name') }}</p>
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
                                        {{-- <img class="file-upload-image" src="#" alt="your image" /> --}}
                                    </div>
                                </div>

                                <div class="form-group ">
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

@section('js')
<script type="text/javascript">

</script>
@endsection
