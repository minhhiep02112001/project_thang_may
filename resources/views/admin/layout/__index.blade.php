<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="{{ asset('') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Simple Tables</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="./backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./backend/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="./backend/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./backend/dist/css/AdminLTE.min.css">
    @yield('css')
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="./backend/dist/css/skins/_all-skins.min.css">

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin.layout.__header')
    <!-- Left 'side column. contains the logo and sidebar -->
    @include('admin.layout.__sidebar')
    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
   @include('admin.layout.__footer')


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="./backend/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="./backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="./backend/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="./backend/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./backend/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

<script src="./backend/dist/js/demo.js"></script>
<script type="text/javascript" src="./backend/dist/js/main.js"></script>
<script type="text/javascript" src="./js/loading.overlay.js"></script>
@yield('js')
<script>
    $('form').submit(function () {
        $.LoadingOverlay("show");
    });
    /*$(document).ready(function (){
        $('.treeview').off('click').on('click',function (event){

            $('.treeview').removeClass('open-menu');
            $('.treeview').removeClass('active');
            $(this).addClass('active');
        });
        $('.treeview-menu li').off('click').on('click',function (event){

            $('.treeview-menu').children().find('li').removeClass();
            $(this).addClass('active');
            $(this).parent().parent().addClass('open-menu active');

        });
        setMenuActive();
    });
    function setMenuActive() {
        $('.menu ul li').each(function () {
            $('.menu ul li').removeClass("active");
        });
        let url = window.location.href;
        slug=url.substring(url.lastIndexOf('/'));
        $('.menu ul li').each(function () {
            let link = $(this).children('a').attr('href');
            if (slug.toLowerCase()==link.toLowerCase()) {
                $(this).addClass('active');
            }
        });
    }
    setMenuActive();
*/
</script>
</body>
</html>
