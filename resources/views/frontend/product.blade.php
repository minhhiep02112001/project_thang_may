@extends('frontend.layout.__index')
@section('content')
    <section id="content">
        <div class="columns-container">
            <h1 style="position:absolute; z-index:-100000; visibility:hidden; width:1px">{{$product->title}}</h1>
            <div class="container" id="columns">
                <div class="breadcrumb clearfix">
                    <a class="home" href="{{route('shop.home')}}" title="Trang chủ">Trang chủ</a>
                    <span class="navigation-pipe">&nbsp;</span>
                    @foreach($categoryParent as $key=>$item)
                        <a class="home" href="{{route('shop.category' , ['slug' => $item->slug])}}" title="{{$item->name}}">{{$item->name}}</a>
                        <span class="navigation-pipe">&nbsp;</span>
                    @endforeach
                    <a class="" href="javascript:void(0)" title="{{$product->name}}">{{$product->name}}</a>
                </div>
                <div class="row product-detail-main pr_style_01" id="product">
                    <div class="col-md-5 col-sm-12 col-xs-12 pb-left-column">
                        <div class="product-gallery-2 product-image">
                            <div class="product-full">
                                <a class="fancybox" data-fancybox="gallery" href="{{asset($product->image)}}">
                                    <img id="product-zoom" data-zoom-image="{{asset($product->image)}}"
                                         src="{{asset($product->image)}}" alt="{{$product->name}}"></a>
                            </div>
                            <div class="product-img-thumb" id="gallery_01">
                                <ul class="owl-carousel owl-theme owl-loaded" data-items="3" data-nav="true"
                                    data-dots="false" data-margin="10" data-loop="false">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage"></div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12 product-content-desc cart-main" id="detail-product">
                        <div class="pb-right-column">
                            <h2 class="product-name">
                                {{$product->name}}
                            </h2>
                            <div class="product-price-group"><span class="price">Giá bán: Mời liên hệ</span></div>
                            <div class="form-cart-option">
                                <div class="form-action">
                                    <div class="button-group">
                                        <a class="addcart-link-qick adprobook2" href="#recart2" id="clicktab2"
                                           onclick=""><span>Nhận</span>
                                            <span>Báo Giá</span></a>
                                    </div>
                                    <div class="sale-product">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="ctl00$ContentPlaceHolder1$PageView1$ctl00$HiddenFieldId"
                                   id="ctl00_ContentPlaceHolder1_PageView1_ctl00_HiddenFieldId" value="65446">
                            <div class="form-share">
                                <div class="network-share">
                                    <div class="share-title">
                                        Kết nối với chúng tôi
                                    </div>
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
                                                <div id="fb-root" class=" fb_reset">
                                                    <div
                                                        style="position: absolute; top: -10000px; width: 0px; height: 0px;">
                                                        <div></div>
                                                    </div>
                                                </div>
                                                <div class="fb-like fb_iframe_widget"
                                                     data-href="http://pro2.thietkewebbacviet.com/mau-web/5211/v409-08.html"
                                                     data-layout="button_count" data-width="100" data-show-faces="true"
                                                     data-share="true" data-font="arial" fb-xfbml-state="rendered"
                                                     fb-iframe-plugin-query="app_id=177818186309740&amp;container_width=0&amp;font=arial&amp;href=http%3A%2F%2Fpro2.thietkewebbacviet.com%2Fmau-web%2F5211%2Fv409-08.html&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true&amp;width=100">
                                                    <span style="vertical-align: bottom; width: 150px; height: 28px;"><iframe
                                                            name="f28d16b0c65da34" width="100px" height="1000px"
                                                            data-testid="fb:like Facebook Social Plugin"
                                                            title="fb:like Facebook Social Plugin" frameborder="0"
                                                            allowtransparency="true" allowfullscreen="true"
                                                            scrolling="no" allow="encrypted-media"
                                                            src="https://www.facebook.com/v3.2/plugins/like.php?app_id=177818186309740&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df2f5daf044ba19c%26domain%3Dlocalhost%26is_canvas%3Dfalse%26origin%3Dhttp%253A%252F%252Flocalhost%253A63342%252Ff1bfa9a71b22898%26relation%3Dparent.parent&amp;container_width=0&amp;font=arial&amp;href=http%3A%2F%2Fpro2.thietkewebbacviet.com%2Fmau-web%2F5211%2Fv409-08.html&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true&amp;width=100"
                                                            style="border: none; visibility: visible; width: 150px; height: 28px;"
                                                            class=""></iframe></span></div>
                                            </li>
                                            <li class="xht lin">
                                                <script src="https://platform.linkedin.com/in.js"
                                                        type="text/javascript">lang: en_US</script>
                                                <span class="IN-widget"
                                                      data-lnkd-debug="<script type=&quot;IN/Share+init&quot; data-url=&quot;http://pro2.thietkewebbacviet.com/mau-web/5211/v409-08.html&quot;></script>"
                                                      style="display: inline-block; line-height: 1; vertical-align: bottom; padding: 0px; margin: 0px; text-indent: 0px; text-align: center;"><span
                                                        style="padding: 0px !important; margin: 0px !important; text-indent: 0px !important; display: inline-block !important; vertical-align: bottom !important; font-size: 1px !important;"><button
                                                            class="IN-74a7d7b0-81d1-4475-af64-727c42231d82-1G9ISYhSF8XoOmdcl0yKDu"><xdoor-icon
                                                                aria-hidden="true"><svg viewBox="0 0 24 24" width="24px"
                                                                                        height="24px" x="0" y="0"
                                                                                        preserveAspectRatio="xMinYMin meet">
      <g style="fill: currentColor">
        <rect x="-0.003" style="fill:none;" width="24" height="24"></rect>
        <path style=""
              d="M20,2h-16c-1.1,0-2,0.9-2,2v16c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V4C22,2.9,21.1,2,20,2zM8,19h-3v-9h3V19zM6.5,8.8C5.5,8.8,4.7,8,4.7,7s0.8-1.8,1.8-1.8S8.3,6,8.3,7S7.5,8.8,6.5,8.8zM19,19h-3v-4c0-1.4-0.6-2-1.5-2c-1.1,0-1.5,0.8-1.5,2.2V19h-3v-9h2.9v1.1c0.5-0.7,1.4-1.3,2.6-1.3c2.3,0,3.5,1.1,3.5,3.7V19z"></path>
      </g>
    </svg></xdoor-icon>Share</button></span></span>
                                            </li>
                                            <li class="xht bm">
                                                <span class="PIN_1656083021099_button_pin PIN_1656083021099_save"
                                                      data-pin-log="button_pinit_bookmarklet"
                                                      data-pin-href="https://www.pinterest.com/pin/create/button/">Save</span>

                                            </li>
                                            <li class="xht tw">
                                                <iframe id="twitter-widget-0" scrolling="no" frameborder="0"
                                                        allowtransparency="true" allowfullscreen="true"
                                                        class="twitter-share-button twitter-share-button-rendered twitter-tweet-button"
                                                        style="position: static; visibility: visible; width: 73px; height: 20px;"
                                                        title="Twitter Tweet Button"
                                                        src="https://platform.twitter.com/widgets/tweet_button.d7fc2fc075c61f6fa34d79a0cbbf1e34.en.html#dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Flocalhost%3A63342%2Fthangmay%2Fpublic%2Fthangmaydep%2Fv1834-34.html%3F_ijt%3Demg7eethrp3rvt8r677acu4mc2%26_ij_reload%3DRELOAD_ON_SAVE&amp;size=m&amp;text=Thang%20m%C3%A1y%20%C4%91%E1%BA%B9p&amp;time=1656083021623&amp;type=share&amp;url=http%3A%2F%2Fpro2.thietkewebbacviet.com%2Fmau-web%2F5211%2Fv409-08.html"
                                                        data-url="http://pro2.thietkewebbacviet.com/mau-web/5211/v409-08.html"></iframe>
                                                <script>!function (d, s, id) {
                                                        var js, fjs = d.getElementsByTagName(s)[0];
                                                        if (!d.getElementById(id)) {
                                                            js = d.createElement(s);
                                                            js.id = id;
                                                            js.src = "//platform.twitter.com/widgets.js";
                                                            fjs.parentNode.insertBefore(js, fjs);
                                                        }
                                                    }(document, "script", "twitter-wjs");</script>
                                            </li>
                                        </ul>
                                    </section>
                                </div>
                                <div class="network-tags">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="center_column col-xs-12 col-sm-12" id="center_column">
                        <a name="recart2"></a>
                        <div id="ctl00_ContentPlaceHolder1_PageView1_ctl00_product_orther" class="page-product-box">
                            <h3 class="heading">Sản phẩm cùng loại</h3>
                            <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav="true"
                                data-margin="10" data-autoplaytimeout="1000" data-autoplayhoverpause="true"
                                data-responsive='{"0":{"items":1},"260":{"items":2},"600":{"items":3},"1000":{"items":4}}'>
                               @foreach( $arrProductAttach as $key => $item)
                                <li>
                                    <div class="product-container item-hover">
                                        <div class="left-block">
                                            <a href="{{route('shop.product' , ['slug'=> $item->slug])}}">
                                                <img class="img-responsive"
                                                     src="{{asset($item->image)}}"
                                                     alt="V409-07"/>
                                            </a>
                                            <div class="group-price">
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name">
                                                <a href="{{route('shop.product' , ['slug'=> $item->slug])}}">{{$product->name}}</a>
                                            </h5>
                                            <div
                                                id="ctl00_ContentPlaceHolder1_PageView1_ctl00_RepeaterProducts_ctl00_PanelPrice"
                                                class="content_price">
                                                Mời liên hệ
                                            </div>
                                            <div
                                                id="ctl00_ContentPlaceHolder1_PageView1_ctl00_RepeaterProducts_ctl00_PanelCode"
                                                class="product-star">
                                                V409-07
                                            </div>
                                            <div
                                                id="ctl00_ContentPlaceHolder1_PageView1_ctl00_RepeaterProducts_ctl00_PanelLink"
                                                class="content_price content-link">
                                                <a title="V409-07" class="more-view" href="/mau-web/5211/v409-07.html">Xem
                                                    thêm</a>
                                            </div>
                                        </div>
                                        <div class="hover_content_pro tooltip">
                                            <div class="hover_box_pro">
                                                <a href="/mau-web/5211/v409-07.html" class="hover_name">V409-07</a>
                                                <div class="hor_price"><span>Giá bán:&nbsp;</span>Mời liên hệ</div>
                                                <div class="hor_status"></div>
                                                <div class="hori_line"></div>
                                                <div class="hover_offer" style='display:none;'>
                                                    <b>---</b>
                                                    <div class="hover_offer_suv">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
