@extends('frontend.layout.__index')

<!-- @section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
@endsection -->

@section('content')
<section id="content">
                
    
<section class="columns-container">
      
    <div class="bg-breadcrumb">
        <div class="container" id="columnstop">
            <div class="breadcrumb clearfix">
                <a class="home" href="/" title="Trang chủ">Trang chủ</a><span class="navigation-pipe">&nbsp;</span><a class="home" href="/mau-web/5211/lien-he.html" title="Liên hệ">Liên hệ</a>
            </div>
        </div>
    </div>
    <div class="container" id="columns">
        <h1 style="position:absolute; z-index:-100000; visibility:hidden; width:1px">Liên hệ</h1>
        <h2 class="page-heading"><span class="page-heading-title2">
            Liên hệ</span>
        </h2>
        <div id="contact" class="page-content page-contact">
            <div id="message-box-conact">
                
            </div>
            <div class="form-send-contact">
                
<style type="text/css">
    .btnsend_contact{
       max-width: 130px;
        float: left;
        margin-right: 10px !important;
        display:inline-block;
    }
    #btnSentWait
    {
        display: none;
        position:absolute;
        left:150px;
    }
</style>
<section class="why-choise box-parallax">
    <section class="sky-form clearfix" style="padding: 5px 10px;">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="input">
                    <input name="ctl00$ContentPlaceHolder1$PageView1$ctl00$ssend$TextBoxHoTenContact" type="text" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_ssend_TextBoxHoTenContact" class="TextBoxHoTenContact" placeholder="Họ và tên" style="width:100%;padding-left: 38px;" />
                    <div class="icon-prepend">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="input">
                    <input name="ctl00$ContentPlaceHolder1$PageView1$ctl00$ssend$TextBoxEmailContact" type="text" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_ssend_TextBoxEmailContact" class="TextBoxEmailContact" placeholder="Địa chỉ Email" style="width:100%;padding-left: 38px;" />
                    <div class="icon-prepend">
                        <i class=" fa fa-envelope"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="input">
                    <input name="ctl00$ContentPlaceHolder1$PageView1$ctl00$ssend$TextBoxPhoneContact" type="text" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_ssend_TextBoxPhoneContact" class="TextBoxPhoneContact" placeholder="Hotline" style="width:100%;padding-left: 38px;" />
                    <div class="icon-prepend">
                        <i class="fa fa-phone"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="input">
                    <textarea name="ctl00$ContentPlaceHolder1$PageView1$ctl00$ssend$TextBoxNoiDungContact" rows="2" cols="20" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_ssend_TextBoxNoiDungContact" class="TextBoxNoiDungContact" placeholder="Nội dung" style="height:120px;width:100%;padding-left: 38px; font-weight: 400;"></textarea>
                    <div class="icon-prepend">
                        <i class="fa fa-comment"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <span id='sencontact_success' style='display:none;color:blue;'>Thông tin của bạn đã gửi thành công! Tuy nhiên, nội dung này cần Ban Biên Tập xét duyệt. Xin cám ơn và mong bạn thường xuyên đóng góp ý kiến.</span><span id='sencontact_error' style='display:none;color:red;'>Thông tin đã được gửi đi. Cám ơn bạn đã quan tâm!</span><span id='sencontact_captcha' style='display:none;color:red;'>Thông tin đã được gửi đến ban biên tập. Cám ơn bạn đã quan tâm!</span>
                <div id="btnSentWait">
                    <img src=" {{ asset('thangmaydep/images/loader.gif') }} " alt="wait image" />
                </div>
                <a href="javascript:void(0);" class="btn btn-lg btn-danger btnsend_contact">Gửi đi</a>
            </div>
        </div>
    </section>
</section>

                <input type="hidden" name="ctl00$ContentPlaceHolder1$PageView1$ctl00$HiddenFieldpIdContact" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_HiddenFieldpIdContact" value="65202" />
            </div>
            <hr />
            <div class="row ">
                <div class="col-sm-7">
                    <p><strong>Công ty cổ phần Thang Máy Chất</strong></p>

                    <p>Địa chỉ: Số 5, Đường Xuân Đỉnh, Xuân Tảo, Bắc Từ Liêm, Hà Nội</p>

                    <p>Email: <a href="mailto:ducvyathanh@gmail.com">ducvyathanh@gmail.com</a></p>

                    <p>Hotline:&nbsp;<a href="tel:0973988848">0392905996</a></p>

                    <p>Website:&nbsp;<a href="http://thangmaychat.com">www.thangmaychat.com</a></p>

                    <div style="clear: both;margin:30px 0;">
                        
<style type="text/css">
    .mangxh {
        margin: 0;
        padding: 0;
        padding-top: 10px;
    }

        .mangxh li.xht {
            list-style: none;
            display: inline-block;
            vertical-align: top;
            padding-right: 5px;
            text-align: left;
        }

        .mangxh li .goxl {
            margin-top: 0;
        }

    .t {
        margin-top: -1px;
    }
    .xht.fb,
    .xht.tw {
            margin-top: 7px;
        }
    .xht.bm {
            margin-top: 3px;
        }
    #content .t img {
        border: 0;
        width: 40px;
    }
    .content-area ul.mangxh li,
    #product-detail ul.mangxh li {
        padding-left: 0 !important;
        margin-left: 0 !important;
        padding-right: 5px !important;
    }
</style>
<section>
    <ul class="mangxh">
        <li class="xht fb">
            <div id="fb-root"></div>
            <div class="fb-like" data-href="/" data-layout="button_count" data-width="100" data-show-faces="true" data-share="true" data-font="arial"></div>
        </li>
        <!-- <li class="xht lin">
            <script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
            <script type="IN/Share" data-url="/"></script>
        </li>
        <li class="xht bm">
            <a data-pin-do="buttonBookmark" data-pin-lang="en" href="https://www.pinterest.com/pin/create/button/" data-url="/"></a>
            <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
        </li>
        <li class="xht tw">
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="/">Tweet</a>
            <script>!function (d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (!d.getElementById(id)) { js = d.createElement(s); js.id = id; js.src = "//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs); } }(document, "script", "twitter-wjs");</script>
        </li> -->
    </ul>
</section>
                    </div>
                </div>
                 <div class="col-sm-5" id="contact_form_map">
                    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=21 xuân đỉnh&amp;t=k&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.kokagames.com/fnf-friday-night-funkin-mods/">Friday Night Funkin Mods</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:50vh;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:100%;}.gmap_iframe {width: 100% !important;height:100%!important;}</style></div>
                        
                </div>
            </div>
        </div>
    </div>
</section>


            </section>
  
@endsection
