@extends('admin.layout.__index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa Banner <a href="{{route('banner.index')}}" class="btn btn-flat btn-success "><i
                    class="fa fa-list"></i> Danh Sách Banner</a>
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
                    <form action="{{ route('banner.update',['id' =>  $banner->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="title">Tiêu Đề</label>
                                <input type="text" class="form-control" value="{{ $banner->title }}" name="title" id="title" placeholder="Title ........">
                                @if($errors->has('title'))
                                <p class="text-danger"><strong>Error : </strong> {{ $errors->first('title') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Image :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" value="{{ $banner->image }}" class="form-control fileName" disabled="" id="fileName">
                                    <input class="file-upload-input" name="image" hidden="hidden" style="position:absolute;" type='file' onchange="readURL(this);" accept="image/*" />
                                    <span class="input-group-btn">
                                        <button type="button"  onclick="$('.file-upload-input').trigger( 'click' )" class="btn btn-info btn-flat">Add Image</button>
                                    </span>
                                </div>

                                <div class="file-upload-content text-center ">
                                    <img src="{{ $banner->image }}" style="max-width:400px ; max-height:200px ; padding:20px;" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url">Url :</label>
                                <input type="text" class="form-control" value="{{ $banner->url }}" name="url" id="url" placeholder="Link ........">
                                @if($errors->has('url'))
                                <p class="text-danger"><strong>Error : </strong> {{ $errors->first('url') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                 <div class="form-group">
                                    <label>Target :</label>
                                    <select class="form-control" name="target">
                                        <option value="_blank"> _blank </option>
                                        <option value="_self" {{ $banner->target == '_self' ? 'selected' : '' }}> _self</option>
                                    </select>
                                </div>

                                @if($errors->has('target'))
                                <p class="text-danger"><strong>Error : </strong> {{ $errors->first('target') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="position">Vị Trí :</label>
                                <input type="number" value="{{ $banner->position }}" class="form-control" name="position">
                            </div>
                            <div class="form-group">
                                <label>Type :</label>
                                <select class="form-control" name="type">
                                    <option value="0" {{ $banner->type == 0 ? 'selected' : '' }}> ---- Trang Chủ ---- </option>
                                    <option value="1" {{ $banner->type == 1 ? 'selected' : '' }}>Danh Mục</option>
                                    <option value="2" {{ $banner->type == 2 ? 'selected' : '' }}>Chi Tiết Sản phẩm</option>
                                    <option value="3" {{ $banner->type == 3 ? 'selected' : '' }}>Tin tức</option>
                                    <option value="4" {{ $banner->type == 4 ? 'selected' : '' }}>Chi Tiết Tin tức</option>
                                    <option value="5" {{ $banner->type == 5 ? 'selected' : '' }}>Liên Hệ</option>
                                    <option value="6" {{ $banner->type == 6 ? 'selected' : '' }}>Giỏ Hàng</option>
                                    <option value="7" {{ $banner->type == 7 ? 'selected' : '' }}>Chất lượng (trang chủ)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Mô Tả :</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $banner->description }}</textarea>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" {{ $banner->is_active == 1 ? 'checked' : '' }} name="is_active" value="1"> Hiển thị                                </label>
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
