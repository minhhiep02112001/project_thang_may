@extends('admin.layout.__index')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thông tin cấu hình website
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin danh mục</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('setting.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Website</label>
                                <input value="{{ $setting['website'] ??'' }}" type="text" class="form-control" id="company"
                                       name="website" placeholder="">
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-4">
                                    <label for="ex1">Logo Header</label>
                                    <input name="logo_header" type="file" class="dropify" data-height="100" data-default-file="{{asset($setting['logo_header'] ?? '')}}" />
                                </div>
                                <div class="col-xs-4">
                                    <label for="ex2">Logo Footer</label>
                                    <input name="logo_footer" type="file" class="dropify" data-height="100" data-default-file="{{asset($setting['logo_footer'] ?? '')}}" />
                                </div>
                                <div class="col-xs-4">
                                    <label for="ex3">Favicon</label>
                                    <input name="logo_icon" type="file" class="dropify" data-height="100" data-default-file="{{asset($setting['logo_icon'] ?? '')}}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Meta title</label>
                                <input value="{{ $setting['meta_title'] ?? '' }}" type="text" class="form-control" id="address"
                                       name="meta_title" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meta keyword</label>
                                <input value="{{ $setting['meta_keyword'] ?? '' }}" type="text" class="form-control" id="address"
                                       name="meta_keyword" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meta description</label>
                                <textarea class="form-control"  id="" cols="5"  name="meta_description" rows="3">{{ $setting['meta_description'] ?? '' }}</textarea>
                            </div><div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ</label>
                                <input value="{{ $setting['address'] ?? '' }}" type="text" class="form-control" id="address"
                                       name="address" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hotline</label>
                                <input value="{{ $setting['phone'] ?? '' }}" type="text" class="form-control" id="hotline"
                                       name="phone" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">MST</label>
                                <input value="{{ $setting['tax'] ?? '' }}" type="text" class="form-control" id="tax"
                                       name="tax" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Facebook</label>
                                <input value="{{ $setting['link_facebook'] ?? '' }}" type="text" class="form-control" id="facebook"
                                       name="link_facebook" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input value="{{ $setting['email'] ?? '' }}" type="text" class="form-control" id="email"
                                       name="email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link bài viết giới thiệu</label>
                                <input value="{{ $setting['introduce'] ?? '' }}" type="text" class="form-control" id="introduce"
                                       name="introduce" placeholder="">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->


            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<script>
    $('.dropify').dropify();
</script>
@endsection
