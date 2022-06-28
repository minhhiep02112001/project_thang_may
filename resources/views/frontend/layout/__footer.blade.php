<footer class="footer3">
    <div class="container">
        <div class="footer-top">
            <div class="footer-bottom-left">
                <div class="widget-container">
                    <ul>
                        <li><a target="_self" href="./trang-chu.html">Trang chủ</a></li>
                        <li><a target="_self" href="./gioi-thieu.html">Giới thiệu</a></li>
                        <li><a target="_self" href="./san-pham.html">Sản phẩm</a></li>
                        <li><a target="_self" href="./du-an.html">Dự án</a></li>
                        <li><a target="_self" href="./tin-tuc.html">Tin tức</a></li>
                        <li><a target="_self" href="./lien-he.html">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
            <div class="widget-container">
                <div id="address-box">
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-bottom-right">
                <div class="widget-container">
                    <div class="social-link">
                        <a target="_blank" rel="nofollow"
                            href="https://www.facebook.com/bacviet.thietkewebsite/"><i
                                class="fa fa-facebook"></i></a><a target="_blank" rel="nofollow"
                            href="https://www.instagram.com"><i class="fa fa-instagram"></i></a><a
                            target="_blank" rel="nofollow" href="https://twitter.com"><i
                                class="fa fa-twitter"></i></a><a target="_blank" rel="nofollow"
                            href="https://www.youtube.com"><i class="fa fa-youtube"></i></a><a
                            target="_blank" rel="nofollow" href="https://www.linkedin.com"><i
                                class="fa fa-linkedin"></i></a><a href="./rss.html"><i
                                class="fa fa-rss"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-coppyright">
        <div class="container">
            <div class="coppyright">
                © 2021 Copyright by thangmaydep. All rights reserved.
            </div>
        </div>
    </div>
    <div id="ctl00_foot_ctl00_facebook">
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId: '177818186309740',
                    xfbml: true,
                    version: 'v3.2'
                });
                FB.AppEvents.logPageView();
            };
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </div>
    <style type="text/css">
        .phone-mobile {
            display: none;
        }

        .giuseart-nav {
            position: fixed;
            left: 13px;
            background: #fff;
            border-radius: 5px;
            /*border-radius:20px 0px;*/
            width: auto;
            z-index: 150;
            bottom: 100px;
            padding: 10px 0;
            border: 1px solid #f2f2f2;
            /*box-shadow: 5px 5px #CDCBCB;*/
        }

        .giuseart-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .giuseart-nav ul li {
            list-style: none !important;
        }

        .giuseart-nav ul>li a {
            border: none;
            padding: 3px;
            display: block;
            border-radius: 5px;
            text-align: center;
            font-size: 10px;
            line-height: 15px;
            color: #515151;
            font-weight: 700;
            max-width: 72.19px;
            max-height: 54px;
            text-decoration: none;
        }

        .giuseart-nav ul>li .chat_animation {
            display: none;
        }

        .giuseart-nav ul>li a i.ticon-heart {
            background: url(./images/icons/icon-map.png) no-repeat;
            background-size: contain;
            width: 36px;
            height: 36px;
            display: block;
        }

        .giuseart-nav ul>li a i.ticon-zalo-circle2 {
            background: url(./images/icons/icon-zalo.png) no-repeat;
            background-size: contain;
            width: 36px;
            height: 36px;
            display: block;
        }

        .giuseart-nav li .button {
            background: transparent;
        }

        .giuseart-nav ul>li a i.ticon-angle-up {
            background: url(./images/icons/icon-angle-up.png) no-repeat;
            background-size: contain;
            width: 36px;
            height: 36px;
            display: block;
        }

        .giuseart-nav ul>li a i {
            width: 33px;
            height: 33px;
            display: block;
            margin: auto;
        }

        .giuseart-nav ul li .button .btn_phone_txt {
            position: relative;
            top: 35px;
            font-size: 10px;
            font-weight: bold;
            text-transform: none;
        }

        .giuseart-nav ul li .button .phone_animation i {
            display: inline-block;
            width: 27px;
            font-size: 32px;
            margin-top: 8px;
            color: #fff;
        }

        .giuseart-nav ul>li a.chat_animation svg {
            margin: -13px 0 -20px;
        }

        .giuseart-nav ul>li a i.ticon-messenger {
            background: url(.images/icons/icon-messenger.png) no-repeat;
            background-size: contain;
            width: 36px;
            height: 36px;
            display: block;
        }

        .giuseart-nav ul li .button .phone_animation i {
            display: inline-block;
            width: 27px;
            font-size: 30px;
            margin-top: 8px;
        }

        .giuseart-nav ul>li a i.ticon-chat-sms {
            background: url(./images/icons/icon-sms.jpg) no-repeat;
            background-size: contain;
            width: 38px;
            height: 36px;
            display: block;
        }

        .giuseart-nav ul>li a i.icon-phone-w {
            background: url(./images/icons/icon-phone.png) no-repeat;
            background-size: contain;
        }

        .giuseart-nav ul li .button .btn_phone_txt {
            position: relative;
        }

        @media only screen and (max-width: 1200px) {
            .giuseart-nav li .chat_animation {
                display: block !Important;
            }

            .giuseart-nav li .button .phone_animation {
                box-shadow: none;
                position: absolute;
                top: -16px;
                left: 50%;
                transform: translate(-50%, 0);
                width: 50px;
                height: 50px;
                border-radius: 100%;
                /*background: #6cb917;*/
                line-height: 15px;
                border: 2px solid white;
                background-image: linear-gradient(89deg, #80d226 0%, #65a91a 100%);
            }

            .giuseart-nav ul>li a {
                padding: 0;
                margin: 0 auto;
            }

            .giuseart-nav {
                background: white;
                width: 100%;
                border-radius: 0;
                color: #fff;
                height: 60px;
                line-height: 50px;
                position: fixed;
                bottom: 0;
                left: 0;
                z-index: 999;
                padding: 5px;
                margin: 0;
                box-shadow: 0 4px 10px 0 #000;
                opacity: .9;
            }

            .giuseart-nav li {
                float: left;
                width: 20%;
                list-style: none;
                height: 50px;
            }

            .phone-mobile {
                display: block !important;
            }
        }

        @media only screen and (max-width: 768px) {
            .sale-footer .sales-hotline span {
                display: none !important;
            }
        }
    </style>
    <div class="giuseart-nav">
        <ul>
            <li>
                <a rel="nofollow" class="add-map" href="#"
                    data-href='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.0030077896113!2d105.82750751533347!3d21.152278588925064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313501009ab91a7d%3A0x957f0641db0bc09a!2zQ-G7lSBExrDGoW5nIFRy4bqhbSAz!5e0!3m2!1svi!2s!4v1620444138133!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
                    data-title="Tìm đường trên Google Maps">
                    <i class="ticon-heart"></i>Chỉ đường
            </li>
            <li><a target="blank" rel="nofollow" class="chat-zalo" target="_blank"
                    href="https://zalo.me/0973988848" title="Chát Zalo: 0973988848"><i
                        class="ticon-zalo-circle2"></i>Chát Zalo</a></li>
            <li class="phone-mobile"><a class="button" href="tel:0973988848"><span
                        class="phone_animation animation-shadow"><i class="icon-phone-w"
                            aria-hidden="true"></i></span><span class="btn_phone_txt">Gọi điện</span></a>
            </li>
            <li><a target="blank" rel="nofollow"
                    href="https://www.messenger.com/t/bacviet.thietkewebsite"
                    title="Messenger: bacviet.thietkewebsite"><i class="ticon-messenger"></i>Messenger</a>
            </li>
            <li><a class="chat_animation" href="sms:0973988848"><i class="ticon-chat-sms"
                        aria-hidden="true" title="Nhắn tin sms"></i>Nhắn tin</a></li>
        </ul>
    </div>
</footer>