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
                        <form role="form" action="{{ route('setting.update') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Website</label>
                                    <input value="{{ $setting['website'] ?? '' }}" type="text" class="form-control"
                                           id="company" name="website" placeholder="">
                                </div>
                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="ex1">Logo Header</label>
                                        <input name="logo_header" type="file" class="dropify" data-height="100"
                                               data-default-file="{{ asset($setting['logo_header'] ?? '') }}"/>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="ex2">Logo Footer</label>
                                        <input name="logo_footer" type="file" class="dropify" data-height="100"
                                               data-default-file="{{ asset($setting['logo_footer'] ?? '') }}"/>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="ex3">Favicon</label>
                                        <input name="logo_icon" type="file" class="dropify" data-height="100"
                                               data-default-file="{{ asset($setting['logo_icon'] ?? '') }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta title</label>
                                    <input value="{{ $setting['meta_title'] ?? '' }}" type="text" class="form-control"
                                           id="address" name="meta_title" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta keyword</label>
                                    <input value="{{ $setting['meta_keyword'] ?? '' }}" type="text"
                                           class="form-control" id="address" name="meta_keyword" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta description</label>
                                    <textarea class="form-control" id="" cols="5" name="meta_description"
                                              rows="3">{{ $setting['meta_description'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input value="{{ $setting['address'] ?? '' }}" type="text" class="form-control"
                                           id="address" name="address" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hotline</label>
                                    <input value="{{ $setting['phone'] ?? '' }}" type="text" class="form-control"
                                           id="hotline" name="phone" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">MST</label>
                                    <input value="{{ $setting['tax'] ?? '' }}" type="text" class="form-control"
                                           id="tax" name="tax" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Facebook</label>
                                    <input value="{{ $setting['link_facebook'] ?? '' }}" type="text"
                                           class="form-control" id="facebook" name="link_facebook" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input value="{{ $setting['email'] ?? '' }}" type="text" class="form-control"
                                           id="email" name="email" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link bài viết giới thiệu</label>
                                    <input value="{{ $setting['introduce'] ?? '' }}" type="text"
                                           class="form-control" id="introduce" name="introduce" placeholder="">
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
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title text-center">Thông tin trang chủ</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- DIRECT CHAT -->
                                <div class="box box-warning direct-chat direct-chat-warning">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Danh mục hiển thị</h3>

                                        <div class="box-tools pull-right">

                                            <button type="button" id="btn_save_menu"
                                                    class="btn btn-sm btn-success btn-save-category-home">
                                                Lưu
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row pl-3"
                                             style="padding-left:10px; max-height: 500px; overflow: auto">
                                            <div class="col-md-12 p-0">
                                                <div class="custom-dd dd" id="nestable"> 
                                                                                         @if (!empty($setting['categories_home'])) 
                                                    <ol class="dd-list">
                                                        @foreach ($setting['categories_home'] as $item)
                                                            <li class="dd-item" data-id="{{ $item->id }}">
                                                                <div class="dd-handle">{{ $item->attr->name ?? '' }}</div>
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                                                    @endif 

                                                 
                                                </div>

                                            </div><!-- end col -->
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                </div>
                                <!--/.direct-chat -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                                <!-- USERS LIST -->
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Chọn danh mục</h3>


                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body no-padding">
                                        <div class="row" style="max-height: 500px; overflow: auto">
                                            <div class="col-md-12 p-0">
                                                <div class="custom-dd dd" id="nestable2">
                                                    <ol class="dd-list">
                                                        @foreach ($categories as $item)
                                                            <li class="dd-item" data-id="{{ $item->id }}">
                                                                <div class="dd-handle">{{ $item->name }}</div>
                                                            </li>
                                                        @endforeach

                                                    </ol>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>

                                    </div>

                                </div>
                                <!--/.box -->
                            </div>
                            <!-- /.col -->
                        </div>

                        <!-- /.box-header -->
                        <!-- form start -->

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
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/nestable.css') }}">
    <script type="text/javascript" src="{{ asset('thangmaydep/js/nestable.js') }}"></script>
    <script>
        $('.dropify').dropify();


        $(document).ready(function () {

            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1,
                maxDepth: 1,
            }).on('change', updateOutput);

            // activate Nestable for list 2
            $('#nestable2').nestable({
                group: 1,
                maxDepth: 1,
            }).on('change', updateOutput);

            updateOutput($('#nestable').data('output', $('#nestable-output')));
            updateOutput($('#nestable2').data('output', $('#nestable2-output')));

            $('#nestable-menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            $(document).on('click', '#btn_save_menu', function (event) {
                Swal.fire({
                    title: 'Bạn có chắc không?',
                    text: "Menu của bạn sẽ bị thay đổi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Không',
                    confirmButtonText: 'Có'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = $("#nestable").nestable("serialize");
                        //
                        var request = $.ajax({
                            url: "{{route('setting.update.category.home')}}",
                            method: "POST",
                            data: {
                                _token: "{{csrf_token()}}",
                                menus: data
                            },
                            dataType: 'json',
                            cache: false,
                            timeout: 600000,
                        });

                        request.done(function (msg) {
                            Swal.fire({
                                position: 'top-end',
                                icon: result.status,
                                title: 'Thành công ...',
                                text: result.messager,
                                showConfirmButton: false,
                                timer: 1500,
                                willClose: () => {
                                    location.reload();
                                }
                            })
                        });

                        request.fail(function (jqXHR, textStatus) {
                            Swal.fire({
                                position: 'top-end',
                                icon: result.status,
                                title: 'Lỗi ...',
                                text: result.messager,
                                showConfirmButton: false,
                                timer: 1500,
                                willClose: () => {
                                    location.reload();
                                }
                            })
                        });

                        //
                        // axios.post("http://games365.ga/api/update-menu", {
                        //     data: data
                        // }).then(data => data.data).then(result => {
                        //     Swal.fire({
                        //         position: 'top-end',
                        //         icon: result.status,
                        //         title: 'Thành công ...',
                        //         text: result.messager,
                        //         showConfirmButton: false,
                        //         timer: 1500,
                        //         willClose: () => {
                        //             location.reload();
                        //         }
                        //     })
                        // }).catch((err) => {
                        //
                        // });
                    }
                })
            });


        });
    </script>
@endsection
