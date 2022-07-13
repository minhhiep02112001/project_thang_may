<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title> Thang Máy Chất </title>
    <meta name="description" content="ThangMayChat | Kiến tạo vẻ sang trọng"/>
    <meta name="keywords"/>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="author" content="thangmaychat.vn"/>
    
    <meta name="copyright" content="© 2021 Copyright by thangmaychat. All rights reserved."/>
    <link rel="icon" type="image/png" href="{{ $setting['logo_icon'] ?? '' }}"/>
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="google-site-verification" content="jkyrwGtdIvdJsWn0AmHKKsRVr8AUG85hiu5VVL32gbs"/>
    <meta name="revisit-after" content="1 day"/>
    <meta name="document-rating" content="General"/>
    <meta name="document-distribution" content="Global"/>
    <meta name="distribution" content="Global"/>
    <meta name="placename" content="vietnam"/>

    <meta name="resource-type" content="Document"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/animate.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/flaticon.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/fontka.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/jquery-ui.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/jquery.bxslider.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/jquery.fancybox.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/owl.carousel.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/select2.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/sky-forms.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/style.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/css/wresponsive.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('thangmaydep/cssfiles/option5211.css') }}"/>


    <meta property="og:title" content="ThangMayChat | Kiến tạo vẻ sang trọng"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{ $setting['logo_icon'] ?? '' }}"/>
    <meta property="og:url" content="http://thangmaychat.com/"/>
    <meta property="og:description" content="ThangMayChat | Kiến tạo vẻ sang trọng"/>
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:title" content="ThangMayChat | Kiến tạo vẻ sang trọng"/>
    <meta property="twitter:description" content="Trang chủ"/>
    <meta property="twitter:image" content="{{ $setting['logo_icon'] ?? '' }}"/>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('css')
</head>

<body>
@if (session('success'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'success',
            iconColor: 'green',
            html: '<h4 style="color:black;font-weight:500;">' + <?php echo json_encode(session()->pull('success'));?> +'</h4>',
            background: '#fff',
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        })
    </script>
@endif
<div class="wrap">
    @include('frontend.layout.__header')

    @yield('content')

    @include('frontend.layout.__footer')

</div>
<a href="#" class="scroll-top round"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <span class="modal-title"></span>
            </div>
            <div class="modal-body">
                <div id="loadViewPro"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('thangmaydep/js/ajquery-1.11.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/jquery.actual.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/jquery.bxslider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/jquery.elevatezoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/jquery.fancybox.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/jquery.plugin.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/loadmore.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/masonry.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/smixitup.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/ssocial.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/star-rating.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/theme-script.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/wow.js') }}"></script>
<script type="text/javascript" src="{{ asset('thangmaydep/js/wsocial.js') }}"></script>
@yield('javascript')


</body>

</html>
