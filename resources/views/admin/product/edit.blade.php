@extends('admin.layout.__index')

@section('css') 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style type="text/css">
        .wrap {
            margin: 10% auto;
            width: 60%;
        }

        .dandev-reviews {
            position: relative;

        }

        .dandev-reviews .form_upload {
            width: 320px;
            position: relative;
            padding: 5px;
            bottom: 0px;
            height: 40px;
            left: 0;
            z-index: 5;
            box-sizing: border-box;
            background: #f7f7f7;
            border-top: 1px solid #ddd;
        }

        .dandev-reviews .form_upload>label {
            height: 35px;
            width: 160px;
            display: block;
            cursor: pointer;
        }

        .dandev-reviews .form_upload label span {
            padding-left: 26px;
            display: inline-block;
            background: url(images/camera.png) no-repeat;
            background-size: 23px 20px;
            margin: 5px 0 0 10px;
        }

        .list_attach {
            display: block;

        }

        ul.dandev_attach_view {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ul.dandev_attach_view li {
            float: left;
            width: 80px;
            margin: 0 20px 20px 0 !important;
            padding: 0!important;
            border: 0!important;
            overflow: inherit;
            clear: none;
        }

        ul.dandev_attach_view .img-wrap {
            position: relative;
        }

        ul.dandev_attach_view .img-wrap .close {
            position: absolute;
            right: -10px;
            top: -10px;
            background: #000;
            color: #fff!important;
            border-radius: 50%;
            z-index: 2;
            display: block;
            width: 20px;
            height: 20px;
            font-size: 16px;
            text-align: center;
            line-height: 18px;
            cursor: pointer!important;
            opacity: 1!important;
            text-shadow: none;
        }

        ul.dandev_attach_view li.li_file_hide {
            opacity: 0;
            visibility: visible;
            width: 0!important;
            height: 0!important;
            overflow: hidden;
            margin: 0!important;
        }

        ul.dandev_attach_view .img-wrap-box {
            position: relative;
            overflow: hidden;
            padding-top: 100%;
            height: auto;
            background-position: 50% 50%;
            background-size: cover;
        }

        .img-wrap-box img {
            right: 0;
            width: 100%!important;
            height: 100%!important;
            bottom: 0;
            left: 0;
            top: 0;
            position: absolute;
            object-position: 50% 50%;
            object-fit: cover;
            transition: all .5s linear;
            -moz-transition: all .5s linear;
            -webkit-transition: all .5s linear;
            -ms-transition: all .5s linear;
        }

        ul li,
        ol li {
            list-style-position: inside;
        }

        .list_attach span.dandev_insert_attach {
            width: 80px;
            height: 80px;
            text-align: center;
            display: inline-block;
            border: 2px dashed #ccc;
            line-height: 76px;
            font-size: 25px;
            color: #ccc;
            display: block;
            cursor: pointer;
            float: left;
        }

        ul.dandev_attach_view {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ul.dandev_attach_view .img-wrap {
            position: relative;
        }

        .list_attach.show-btn span.dandev_insert_attach {
            display: block;
            margin: 0 0 20px!important;
        }

        i.dandev-plus {
            font-style: normal;
            font-weight: 900;
            font-size: 35px;
            line-height: 1;
        }

        ul.dandev_attach_view li input {
            display: none;
        }

        .details_product_images{
            display: flex;
            justify-content: space-around;
            justify-items: center;
            align-items: center;
            padding: 2px 0px;
        }
        .images_position{
            display: block!important;
            height: 19px;
            width: 60px;
        }
        .is_active_images{
            display: block!important;
            width: 20px;
            transform: scale3d(1.5, 1.5, 1.5);
            margin: 0!important;
        }
    </style>
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <style>. { width: 50% }</style>
    <section class="content-header">
        <h1>
            S???a S???n Ph???m <a href="{{route('san-pham.index')}}" class="btn btn-flat btn-success "><i
                    class="fa fa-list"></i> Danh S??ch S???n Ph???m</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9 col-lg-9">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Th??ng tin s???n ph???m</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route( 'san-pham.update',['id' => $product->id] )}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        @method("PUT")
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">T??n s???n ph???m</label>
                                <input type="text" class="form-control" value="{{ $product->name }}" id="name" name="name">
                                 @if($errors->has('name'))
                                    <p class="text-danger"><strong>Error : </strong> {{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" value="{{ $product->image }}" class="form-control fileName" disabled="" id="fileName">
                                    <input class="file-upload-input" name="image" hidden="hidden" style="position:absolute;" type='file' onchange="readURL(this);" accept="image/*" />
                                    <span class="input-group-btn">
                                        <button type="button"  onclick="$('.file-upload-input').trigger( 'click' )" class="btn btn-info btn-flat">Add Image</button>
                                    </span>
                                </div>

                                <div class="file-upload-content text-center ">
                                    <div style="max-width:200px; margin:10px auto;">
                                        <img src="{{ $product->image }}" alt="" style="width:100%;height:100%;">
                                    </div>
                                </div>
                                 @if($errors->has('image'))
                                    <p class="text-danger"><strong>Error : </strong> {{ $errors->first('image') }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">???nh K??m Theo , V??? Tr?? , Hi???n Th??? :</label>
                                </div>
                                <div class="col-md-12 p-b-5" style="padding-top: 10px;">
                                    <div class="dandev-reviews">
                                        <div class="list_attach">
                                            <ul class="dandev_attach_view">
                                                @if(count($product->product_images()->get()) > 0)
                                                    @foreach($product->product_images()->get() as $item)
                                                        <li id="li_file_{{ $item->id }}" class="">
                                                            <div class="img-wrap">
                                                                <span class="close" onclick="DelImg(this)">??</span>
                                                                <div class="img-wrap-box">
                                                                    <img src="{{ $item->image}}">
                                                                </div>
                                                            </div>
                                                            <div class="{{ $item->id}}">
                                                                <input type="number" name="id_product_images[]" value="{{ $item->id }}" hidden="hidden">
                                                                <input type="file" name="product_images[]" class="hidden" onchange="uploadImg(this)" id="files_{{ $item->id}}">
                                                                <div class="details_product_images">
                                                                    <input type="number" name="images_position[]" placeholder="V??? tr??" min="0" value="{{ $item->position }}" class="images_position">
                                                                    <input type="checkbox" name="is_active_images[]" class="is_active_images" value="1" {{ $item->is_active ? "checked":"" }} >
                                                                    <input hidden="hidden" name="is_active_images[]" value="0" class="is_hidden_active">
                                                                </div>

                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                            <span class="dandev_insert_attach"><i class="dandev-plus">+</i></span>
                                        </div>
                                    </div>
                                    @if($errors->has('product_images.*'))
                                        <p class="text-danger" style="clear:both;">
                                            <strong>Error : </strong> {{ $errors->first('product_images.*') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">S??? l?????ng :</label>
                                <input type="number" class="form-control " id="stock" name="stock" value="{{ $product->stock }}" min="0">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Gi?? g???c (vn??) :</label>
                                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" min="0">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Gi?? khuy???n m???i (vn??) :</label>
                                        <input type="number" class="form-control" id="sale" name="sale" value="{{ $product->sale }}" min="0">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">M?? M??u :</label>
                                        <input type="text" class="form-control" id="color" name="color" placeholder="null" value="{{ $product->color }}">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">B??? Nh??? :</label>
                                        <input type="text" class="form-control" id="memory" name="memory" placeholder="null" value="{{ $product->memory }}">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>

                            <div class="form-group">
                                <label>Danh m???c s???n ph???m :</label>
                                <select class="form-control " name="category_id">
                                    <option value="0">-- ch???n Danh M???c --</option>

                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $product->category_id ?'selected':'' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category_id'))
                                    <p class="text-danger"><strong>Error : </strong> {{ $errors->first('category_id') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Th????ng hi???u :</label>
                                <select class="form-control " name="brand_id">
                                    <option value="0">-- ch???n Th????ng Hi???u--</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ ($product->brand_id == $brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nh?? cung c???p :</label>
                                <select class="form-control " name="vendor_id">
                                    <option value="0">-- ch???n NCC --</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ ($product->vendor_id == $vendor->id) ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">M?? h??ng (SKU)</label>
                                <input type="text" value="{{ $product->sku }}"  class="form-control " id="sku" name="sku" placeholder="">
                                 @if($errors->has('sku'))
                                    <p class="text-danger"><strong>Error : </strong> {{ $errors->first('sku') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">V??? tr??</label>
                                <input type="number" class="form-control " id="position" name="position" value="{{ $product->position }}" min="0">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Li??n k???t (url) t??y ch???nh</label>
                                <input type="text" value="{{ $product->url }}" class="form-control" id="url" name="url" placeholder="">
                                 @if($errors->has('url'))
                                    <p class="text-danger"><strong>Error : </strong> {{ $errors->first('url') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>T??m t???t</label>
                                <textarea id="editor2" name="summary" class="form-control" rows="10" >{{ $product->summary }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>N???i dung</label>
                                <textarea id="editor1" name="description"  class="form-control" rows="10" >{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meta Title</label>
                                <input type="text" value="{{ $product->meta_title }}" class="form-control" id="meta_title" name="meta_title" >
                                 @if($errors->has('meta_title'))
                                    <p class="text-danger"><strong>Error : </strong> {{ $errors->first('meta_title') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3" >{{ $product->meta_description }}</textarea>
                            </div>


                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="is_hot" {{ $product->is_hot ? 'checked' : '' }}> <b>S???n ph???m Hot</b>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" {{ $product->is_active ? 'checked' : '' }} name="is_active"> <b>Hi???n th???</b>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-update-product">Update</button>
                            <input type="reset" class="btn btn-default pull-right" value="Reset">
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            </form>
        </div>
        <!-- /.row -->
    </section>
</div>
@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('select[name="category_id"], select[name="brand_id"], select[name="vendor_id"]').select2();
    });
</script>

    <script type="text/javascript">
        $(function () {

            // setup textarea s??? d???ng plugin CKeditor
            var _ckeditor = CKEDITOR.replace('editor1');
            _ckeditor.config.height = 500; // thi???t l???p chi???u cao
            var _ckeditor = CKEDITOR.replace('editor2');
            _ckeditor.config.height = 200; // thi???t l???p chi???u cao
        })
    </script>

    <script type="text/javascript">
        $(document).on('click' , '.is_active_images' , function() {
            if($(this).prop('checked') == true){
                $(this).next().attr('disabled','disabled');
            }else{
                $(this).next().removeAttr('disabled');
            }
        });

        $(document).ready(function() {
            $('.btn-update-product').click(function(event){

                $('.is_active_images').each(function(index) {
                    if($(this).is(':checked')){
                        $(this).next().attr('disabled','disabled');
                    }else{
                        $(this).next().removeAttr('disabled');
                    }
                });

            });
        });

        $('.dandev_insert_attach').click(function() {
            /*if ($('.list_attach').hasClass('show-btn') === false) {
                $('.list_attach').addClass('show-btn');
            }*/
            var _lastimg = jQuery('.dandev_attach_view li').last().find('input[type="file"]').val();


                var d = new Date();
                var _time = d.getTime();
                var _html = '<li id="li_files_' + _time + '" class="li_file_hide">';
                _html += '<div class="img-wrap">';
                _html += '<span class="close" onclick="DelImg(this)">??</span>';
                _html += ' <div class="img-wrap-box"></div>';
                _html += '</div>';
                _html += '<div class="' + _time + '">';
                _html += '<input type="file" name="product_images[]" class="hidden"  onchange="uploadImg(this)" id="files_' + _time + '"   />';

                _html += '<input type="number" name="id_product_images[]" hidden="hidden" value="0">';
                _html += '<div class="details_product_images">';
                _html += '<input type="number" name="images_position[]" placeholder="V??? tr??" min="0"  value="0" class="images_position">';
                _html += '<input type="checkbox" name="is_active_images[]"  class="is_active_images" value="1" checked >';
                _html += '<input hidden="hidden" name="is_active_images[]" value="0" class="is_hidden_active">';
                _html += '</div>';
                _html += '</div>';
                _html += '</li>';
                jQuery('.dandev_attach_view').append(_html);
                jQuery('.dandev_attach_view li').last().find('input[type="file"]').click();

        });

        function uploadImg(el) {
            var file_data = $(el).prop('files')[0];
            var type = file_data.type;
            var fileToLoad = file_data;

            var fileReader = new FileReader();

            fileReader.onload = function(fileLoadedEvent) {
                var srcData = fileLoadedEvent.target.result;

                var newImage = document.createElement('img');
                newImage.src = srcData;
                var _li = $(el).closest('li');
                if (_li.hasClass('li_file_hide')) {
                    _li.removeClass('li_file_hide');
                }
                _li.find('.img-wrap-box').append(newImage.outerHTML);


            }
            fileReader.readAsDataURL(fileToLoad);

        }

        function DelImg(el) {
            jQuery(el).closest('li').remove();

        }
    </script>
@endsection
