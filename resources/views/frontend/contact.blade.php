@extends('frontend.layout.__index')
@section('content')
    <section id="content">
        <section>
            <div class="contact-info">
                <div class="map-contact">
                    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=21 xuân đỉnh&amp;t=k&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.kokagames.com/fnf-friday-night-funkin-mods/">Friday Night Funkin Mods</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:50vh;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:50vh;}.gmap_iframe {width: 100% !important;height:50vh!important;}</style></div>
                    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.1074314504044!2d105.89592241501985!3d21.068370985976856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a978c17c3499%3A0x67cbc2d9835e9b82!2zQ8OUTkcgVFkgVE5ISCBHSeG6okkgUEjDgVAgVsOAIEPDlE5HIE5HSOG7hiBC4bquQyBWSeG7hlQ!5e0!3m2!1svi!2s!4v1484536168284" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe> -->
                </div>
            </div>
        </section>
        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left">
                    <h2>
                        Liên hệ</h2>
                    <h1 style="position:absolute; z-index:-100000; visibility:hidden; width:1px">Liên hệ</h1>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix"><li><a class="home" href="/" title="Trang chủ"><i class="fa fa-home"></i></a></li><li><a class="home" href="/lien-he.html" title="Liên hệ">Liên hệ</a></li></ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->
        <!-- page-title end-->
        <section class="contact-section">
            <div class="auto-container">
                <div class="contact-img wow fadeIn" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="row">
                        <div class="map-column col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="inner-column info">
                                <p><strong>Tài khoản giao dịch:</strong></p>
                                <p><strong>1. Ngân hàng Đầu tư và Phát triển (BIDV)</strong><br>
                                    - Chủ tài khoản: Công ty TNHH Giải pháp và Công nghệ Bắc Việt<br>
                                    - Số tài khoản: 15010000323649<br>
                                    - Chi nhánh: Bắc Hà Nội</p>
                                <p><strong>2. Ngân hàng Ngoại Thương Việt Nam (VietComBank)</strong><br>
                                    - Chủ tài khoản: Lê Bá Việt Tùng<br>
                                    - Số tài khoản: 0491001462611 - Chi nhánh Thăng Long - Hà Nội</p>
                                <p><strong>Giờ làm việc:</strong><br>
                                    - Từ thứ Hai đến thứ Sáu + Sáng thứ Bảy<br>
                                    - Sáng : 08:00 am - 12:00 am<br>
                                    - Chiều: 01:30 pm - 05:30 pm&nbsp;</p>
                            </div>
                        </div>
                        <div class="form-column col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="inner-column">
                                <img loading="lazy" class="img-fluid" src="{{asset('frontend/imgcategory/20191007143744_34124.jpg')}}" alt="Liên hệ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="map-column col-lg-5 col-md-6 col-sm-12 col-xs-12 wow fadeUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="inner-column">

                            Kết nối: <ul class="social-icon-two"><li><a target="_blank" rel="nofollow" href="https://www.facebook.com/bacviet.thietkewebsite/"><i class="fa fa-facebook"></i></a></li><li><a target="_blank" rel="nofollow" href="https://plus.google.com"><i class="fa fa-instagram"></i></a></li><li><a target="_blank" rel="nofollow" href="https://twitter.com"><i class="fa fa-twitter"></i></a></li><li><a target="_blank" rel="nofollow" href="https://www.youtube.com"><i class="fa fa-youtube"></i></a></li><li><a target="_blank" rel="nofollow" href="https://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li></ul>

                        </div>
                    </div>
                    <div class="form-column col-lg-7 col-md-6 col-sm-12 col-xs-12 wow fadeUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="inner-column">
                            <div class="form-box default-form">
                                <div class="contact-form default-form">
                                    <div class="sky-form">
                                        <div class="row clearfix">
                                            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                <input name="ctl00$ContentPlaceHolder1$PageView1$ctl00$TextBoxHoTenContact" type="text" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_TextBoxHoTenContact" class="contact_username" placeholder="Họ và tên (*)" required="">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                <input name="ctl00$ContentPlaceHolder1$PageView1$ctl00$TextBoxPhoneContact" type="text" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_TextBoxPhoneContact" class="contact_phone" placeholder="Di động (*)" required="">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                <input name="ctl00$ContentPlaceHolder1$PageView1$ctl00$TextBoxEmailContact" type="text" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_TextBoxEmailContact" class="contact_email" placeholder="Địa chỉ Email (*)" required="">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                <input name="ctl00$ContentPlaceHolder1$PageView1$ctl00$TextBoxCompanyName" type="text" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_TextBoxCompanyName" class="contact_company" placeholder="Công ty">
                                            </div>
                                            <div class="form-group col-lg-12 col-md-12 col-sm-1 col-xs-12">
                                                <textarea name="ctl00$ContentPlaceHolder1$PageView1$ctl00$TextBoxNoiDungContact" rows="2" cols="20" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_TextBoxNoiDungContact" class="contact_message" placeholder="Nội dung (*)" style="height:120px;width:100%;">    </textarea>
                                            </div>
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="hidden" name="ctl00$ContentPlaceHolder1$PageView1$ctl00$HiddenFieldpIdContact" id="ctl00_ContentPlaceHolder1_PageView1_ctl00_HiddenFieldpIdContact" value="31190">
                                                <a href="javascript:void(0);" class="theme-btn btn-style-three btnsend_contact">Gửi đi</a>
                                                <div id="message-box-conact">
                                                    <span id="sencontact_success" style="display:none;color:blue;">Thông tin của bạn đã gửi thành công! Tuy nhiên, nội dung này cần Ban Biên Tập xét duyệt. Cám ơn bạn đã ủng hộ.</span><span id="sencontact_error" style="display:none;color:red;">Thông tin đã được gửi đi. Cám ơn bạn đã quan tâm!</span><span id="sencontact_captcha" style="display:none;color:red;">Khung màu đỏ có (*) là bắt buộc</span>
                                                </div>
                                                <div id="btnSentWait">
                                                    <img src="{{asset('frontend/images/icons/loader.gif')}}" alt="wait image">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </section>
@endsection
