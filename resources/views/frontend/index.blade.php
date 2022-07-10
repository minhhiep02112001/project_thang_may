@extends('frontend.layout.__index')

@section('content')
    <section id="content">
        <h1 style="position:absolute; z-index:-100000; visibility:hidden; width:1px">Trang chủ</h1>
        <div class="site-block-wrap">
            <div class="owl-carousel with-dots owl-style2" data-loop="true" data-nav="true"
                 data-autoplayhoverpause="true" data-autoplaytimeout="1000" data-autoplay="true"
                 data-responsive='{"0":{"items":1}}'>

                @foreach($banners as $key=>$item )
                    <div class="site-blocks-cover overlay overlay-2"
                         style="background-image: url('{{ asset($item->image)}}');"
                         data-aos="fade"
                         id="home">
                        <div class="container" style="display:block;">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-6 mt-lg-5 text-center">
                                    <h1 class="text-shadow" style="color:#ffffff;">{{$item->title}}</h1>
                                    <p class="mb-5 text-shadow" style="color:#111111;"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="site-wrap">
            @if(!empty($categories))
                @foreach($categories as $key=>$category)
                    @if($category->type ==0 )
                        @if(!empty($item->products))
                            <div id="ctl00_ContentPlaceHolder1_PageView1_ctl00_RepeaterCategory_ctl01_Panel1"
                                 class="product-home">
                                <div class="site-section" id="san-pham-ngoai-that">
                                    <div class="container">
                                        <div class="row mb-5">
                                            <div class="col-xs-12 text-center">
                                                <h2 class="section-title mb-3">
                                                    <a href="./san-pham-ngoai-that.html">{{$category->name}}</a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row large-gutters">
                                            @foreach($category->products as $product)
                                                <div class="col-md-6 col-lg-3 mb-5 mb-lg-5">
                                                    <div class="ftco-media-1">
                                                        <div class="ftco-media-1-inner">
                                                            <a href="{{route('shop.product' , ['slug'=> $product->slug])}}"
                                                               alt="{{$product->name}}" class="d-inline-block mb-4">
                                                                <img class="img-fluid"
                                                                     src="{{getImageThumb($product->image , 360, 270)}}"
                                                                     alt="{{$product->name}}">
                                                            </a>
                                                            <div class="ftco-media-details">
                                                                <h3>
                                                                    <a href="{{route('shop.product' , ['slug'=> $product->slug])}}">{{$product->name}}</a>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{route('shop.category' , ['slug'=> $category->slug])}}"
                                           class="btn btn-primary mr-2 mb-2">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        @if(!empty($item->products))
                            <div id="ctl00_ContentPlaceHolder1_PageView1_ctl00_RepeaterCategory_ctl02_Panel5"
                                 class="album project">
                                <div class="py-5 bg-primary site-section how-it-works" id="du-an">
                                    <div class="container">
                                        <div class="row mb-5 justify-content-center">
                                            <div class="col-md-12 text-center text-title">
                                                <h2 class="section-title mb-3 text-black"><a href="./du-an.html">Dự
                                                        án</a>
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @foreach($category->products  as $key=>$item)
                                                <div class="col-xs-6 col-sm-4 col-md-3 text-center">
                                                    <div class="second-step">
                                                        <div class="overlay-image zoom-image">
                                                            <a class="album-thumb-link"
                                                               href="{{route('shop.product' , ['slug'=> $item->slug])}}">
                                                                <img
                                                                        src="{{getImageThumb($item->image , 360, 270)}}"
                                                                        alt="{{$item->name}}"/></a>
                                                        </div>
                                                        <h3 class="text-dark"><a
                                                                    href="{{route('shop.product' , ['slug'=> $item->slug])}}l">{{$item->name}}</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="text-center"><a
                                                href="{{route('shop.category' , ['slug'=> $category->slug])}}"
                                                class="btn btn-primary mr-2 mb-2">Xem
                                            thêm</a></div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endif
            {{--            @if( $product_projects->count() > 0)--}}
            {{--            @endif--}}

            @if($bannerQuality->count() > 0)
                <div id="ctl00_ContentPlaceHolder1_PageView1_ctl00_RepeaterCategory_ctl03_Panel3" class="WhyUs">
                    <div class="site-section site-whyus bg-light" id="ly-do-chon-vinwall">
                        <div class="container">
                            <h2 class="section-title mb-5 text-center"><a href="./ly-do-chon-vinwall.html">Chọn
                                    chất lượng chọn Thang Máy Chất</a></h2>
                            <!-- <div class="why-con text-center">
                                <p style="text-align: center;"><img alt="Lý do chọn chúng tôi"
                                                                    src="./news/ly-do-chon.png"/></p>
                            </div> -->
                            <div class="row align-items-stretch">
                                @foreach($bannerQuality as $key => $item)
                                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up"
                                         data-aos-delay='500'>
                                        <div class="unit-4 d-flex">
                                            <div class="unit-4-icon mr-4">
                                    <span class="text-primary">
                                        <img src="{{getImageThumb($item->image , 100, 100)}}"
                                             alt="{{$item->title}}"></span>
                                            </div>
                                            <div>
                                                <h3>{{$item->title}}</h3>
                                                <p class="why-content">{{$item->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="site-section contact-home bg-light" id="contact">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title mb-3">Liên hệ với chúng tôi</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-7 col-xs-12">
                        <form action="{{route('shop.post.contact')}}" method="post" enctype="multipart/form-data">
                            <section class="p-5 bg-white boxSendHome">
                                @csrf
                                <h2 class="text-left" style="margin: 5px 0; font-weight: 600;">Form Liên hệ</h2>
                                <p class="text-left" style="font-size: 14px; margin-bottom: 15px;">Điền thông tin
                                    của bạn vào khung dưới đây</p>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-6">
                                        <label class="text-black">Họ và tên</label>
                                        <input
                                                name="fullname"
                                                type="text"
                                                id="fullname"
                                                class="TextBoxHoTenSendHome form-control" placeholder="Full Name"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <label class="text-black">Email</label>
                                        <input
                                                name="email"
                                                type="text"
                                                id="email"
                                                class="TextBoxEmailSendHome form-control" placeholder="Email"/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-12">
                                        <label class="text-black">Hotline</label>
                                        <input
                                                name="phone"
                                                type="text"
                                                id="phone"
                                                class="TextBoxPhoneSendHome form-control" placeholder="Phone"/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-12">
                                        <label class="text-black">Nội dung</label>
                                        <textarea
                                                name="contents"
                                                rows="7"
                                                cols="20"
                                                id="contents"
                                                class="TextBoxNoiDungSendHome form-control" placeholder="Content"
                                                style="height:140px;"></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-12">
                                <span id='sencontact_success' style='display:none;color:blue;'>Thông tin
                                    của bạn đã gửi thành công! Tuy nhiên, nội dung này cần Ban Biên Tập xét
                                    duyệt. Xin cám ơn và mong bạn thường xuyên đóng góp ý kiến.</span><span
                                                id='sencontact_error' style='display:none;color:red;'>Thông tin đã
                                    được gửi đi. Cám ơn bạn đã quan tâm!</span><span
                                                id='sencontact_captcha' style='display:none;color:red;'>Thông tin đã
                                    được gửi đến ban biên tập. Cám ơn bạn đã quan tâm!</span>
                                        <div id="btnSentWait">
                                            <img src="{{'thangmaydep/images/loader.gif'}}" alt="wait image"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-12">
                                        <button type="submit"
                                                class="btn btn-primary btn-md text-white btnsend_SendHome">Gửi đi
                                        </button>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                        <div class="p-5 mb-3 bg-white">
                            <h2 class="mb-4 mt-0 text-left">{{$setting['website'] ?? ''}}</h2>
                            <p class="mb-0 font-weight-bold">Địa chỉ</p>
                            <p class="mb-4">{{$setting['address'] ?? ''}}</p>
                            <p class="mb-0 font-weight-bold">Hotline</p>
                            <p class="mb-4"><a target="_blank" href="tel:{{$setting['phone'] ?? ''}}"
                                               title="Call: {{$setting['phone'] ?? ''}}">{{$setting['phone'] ?? ''}}</a>
                            </p>
                            <p class="mb-0 font-weight-bold">Email</p>
                            <p class="mb-4"><a target="_blank" href="mailto:{{$setting['email'] ?? ''}}"
                                               title="Email: {{$setting['email'] ?? ''}}">{{$setting['email'] ?? ''}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
