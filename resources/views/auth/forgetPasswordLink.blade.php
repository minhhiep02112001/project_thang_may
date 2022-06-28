<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="{{asset('')}}"></base>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="./backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="./backend/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="./backend/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="./backend/dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="./backend/plugins/iCheck/square/blue.css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="login-box-body">
			<h5 class="login-box-msg">Thay Đổi Mật Khẩu</h5>
			@if(session('message'))
			    <script type="text/javascript">
			    	Swal.fire({
                        icon: 'success',
                		iconColor:'green',
                        html: '<h4 style="color:black;font-weight:500;">'+ <?= json_encode( session('message')); ?> +'</h4>',
                        background:'#fff',
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didClose:(toast) => {
                            window.location.href = '/dang-nhap';
                        }
                    })
			    </script>
			@endif
			<form action="{{ route('reset.password.post') }}" method="POST">
				@csrf
				<input type="hidden" name="token" value="{{ $token }}">
				<div class="form-group has-feedback">
					<input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">

					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>

					@if ($errors->has('email'))
					<span class="text-danger">{{ $errors->first('email') }}</span>
					@endif
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" placeholder="Password">

					<span class="glyphicon glyphicon-lock form-control-feedback"></span>

					@if ($errors->has('password'))
					<span class="text-danger">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password_confirmation" placeholder="Comfirm Password">

					<span class="glyphicon glyphicon-lock form-control-feedback"></span>

					@if ($errors->has('password_confirmation'))
					<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
					@endif
				</div>


				<button type="submit" class="btn btn-primary btn-block btn-flat">Cập Nhập</button>
				@if(session('error'))
			      <div class="alert alert-danger" style="margin-top:10px;">
			        {{ session('error') }}
			      </div>
			    @endif

			</form>

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 3 -->
	<script src="./backend/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="./backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- iCheck -->
    <script type="text/javascript" src="./js/loading.overlay.js"></script>

    <script>
        $('form').submit(function () {
            $.LoadingOverlay("show");
        });
</body>
</html>
