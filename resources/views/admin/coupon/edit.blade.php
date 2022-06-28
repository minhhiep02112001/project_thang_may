@extends('admin.layout.__index')



@section('css')
     <!-- daterange picker -->
  <link rel="stylesheet" href="./backend/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="./backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="./backend/plugins/iCheck/all.css">
  
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="./backend/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="./backend/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./backend/dist/css/AdminLTE.min.css">
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
                Sửa Thông Tin Khuyến Mại <a href="{{route('khuyen-mai.index')}}" class="btn btn-flat btn-success "><i
                        class="fa fa-list"></i> Danh Sách Khuyến Mại</a>
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
                        <form action="{{ route('khuyen-mai.update' , ['id'=>$coupon->id]) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="box-body">
                                
                                <div class="form-group">
                                    <label for="code">Mã :  <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" value="{{ $coupon->code }}" name="code" id="code" placeholder="Nhập mã ........">
                                     @if($errors->has('code'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('code') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giảm (%) :</label>
                                    <input type="number" value="{{ $coupon->percent}}" min="0" max="100" class="form-control" name="percent">
                                    @if($errors->has('percent'))
                                        <p class="text-danger"><strong>Error : </strong> {{ $errors->first('percent') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giá Giảm (VNĐ):</label>
                                    <input type="number" value="{{ $coupon->value }}" min="0"  class="form-control" name="value">
                                </div>
                                {{-- <div class="form-group">
                                    <label>Thời gian khuyến mại:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="reservationtime">
                                    </div>
                                    <!-- /.input group -->
                                </div> --}}
                                
                                <div class="form-group">
                                    <label>Loại :</label>
                                    <select class="form-control" name="type">
                                        <option value="0" >Khuyến mại thường</option>
                                        <option value="1"{{ $coupon->type?'selected':'' }}>Khuyến mại cho khách víp</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Đơn vị tính :</label>
                                    <select class="form-control" name="unti">
                                        <option value="0" >Phầm Trăm (%)</option>
                                        <option value="1" {{ $coupon->unti?'selected':'' }}>Giá Giảm (VNĐ)</option>
                                        
                                    </select>
                                </div>
                                
                                 <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_active" value="1" {{ $coupon->is_active ? 'checked' :'' }}> <b>Kích Hoạt</b>
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
<!-- Select2 -->
<script src="./backend/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="./backend/plugins/input-mask/jquery.inputmask.js"></script>
<script src="./backend/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="./backend/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
    <!-- date-range-picker -->
<script src="./backend/bower_components/moment/min/moment.min.js"></script>
<script src="./backend/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="./backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(function () {
            
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
            //Date range as a button
          
          })
        </script>
@endsection
