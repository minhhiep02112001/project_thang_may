
<div id="header" class="header">
    <div id="nav-top-menu" class="nav-top-menu nav-04">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 logo">
                    <a class="logo-mb" href="./" title="logo">
                        <img alt="Logo mobile" src="{{getImageThumb($setting["logo_header"] ?? '' , 165 , 50)}}"/>
                    </a>
                    <a class="logo-des" href="./" title="logo">
                        <img alt="Logo" src="{{getImageThumb($setting["logo_header"] ?? '' , 165 , 50)}}"/></a>
                </div>
                <div id="main-menu" class="col-sm-9 main-menu main-04">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed"
                                        data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                                        aria-controls="navbar">
                                    <div class="hamburger">
                                        <span class="line"></span>
                                        <span class="line"></span>
                                        <span class="line"></span><span class="line"></span><span
                                            class="line"></span>
                                    </div>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="home"><a target="_self" href="./">Trang chủ</a>
                                    </li>
                                    <li><a target="_self" href="{{route('shop.information')}}">Giới thiệu</a></li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" target="_self"
                                           href="./san-pham.html"><span>Sản phẩm</span></a>
                                        <ul class="dropdown-menu mega_dropdown" role="menu"
                                            style="width: 100%">
                                            @foreach($menus_product as $key=>$item)
                                                <li class="block-container col-sm-6">
                                                    <ul class="block">

                                                        <li class="img_container">
                                                            <a target="_self" href="{{route('shop.category' , ['slug'=>$item->slug])}}">
                                                                <img src="{{asset('frontend/imgcategory/2021051195339_40744.jpg')}}" alt="Sản phẩm nội thất" loading="lazy">
                                                            </a>
                                                        </li>
                                                        <li class="link_container group_header">
                                                            <a target="_self" href="{{route('shop.category' , ['slug'=>$item->slug])}}">{{$item->name}}</a>
                                                        </li>


                                                        @php
                                                         $data = $item->categoryChildrens()->where('is_active',1)->orderBy("position" , 'asc')->get();
                                                        @endphp
                                                        @foreach($data as  $value)
                                                        <li>
                                                            <a target="_self" href="{{route('shop.category' , ['slug'=>$value->slug])}}">
                                                            {{$value->name}}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </li>



                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" target="_self"
                                           href="./du-an.html"><span>Dự án</span></a>
                                        <ul class="dropdown-menu container-fluid">
                                            <li class="block-container">
                                                <ul class="block">
                                                    @foreach( $menu_projects as $key=> $item)
                                                        <li class="link_container">
                                                            <a target="_self"
                                                               href="{{route('shop.category', ['slug' => $item->slug])}}">
                                                                {{$item->name}}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a target="_self" href="{{route('shop.news')}}">Tin tức</a></li>
                                    <li><a target="_self" href="{{route('shop.get.contact')}}">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div id="form-search-opntop">
                        <div class="form-inline">
                            <div class="form-group input-serach">
                                <input name="ctl00$hh$ctl00$TextBoxSearch" type="text"
                                       id="ctl00_hh_ctl00_TextBoxSearch" placeholder="Từ khóa..."/>
                            </div>
                            <a id="ctl00_hh_ctl00_ButtonSearch" class="pull-right btn-search"
                               href="javascript:__doPostBack(&#39;ctl00$hh$ctl00$ButtonSearch&#39;,&#39;&#39;)"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="language" id="user-info-opntop">
                <div id="ctl00_hh_ctl00_lang" class="dropdown-2">
                </div>
            </div>
            <div id="shopping-cart-box-ontop" style="display: block;">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content">
                    <p class="desc-like">
                        <a title="Yêu thích" class="mini-cart-link heart" href="./my-wishlist.html">
                            <i class="fa fa-heart"></i>&nbsp;<span class="countFavouritePopup">
                            </span> Sản phẩm yêu thích
                        </a>
                    </p>
                    <p class="desc-cart">
                        <a title="Giỏ hàng" href="./my-shoppingcart.html">
                            <i class="fa fa-shopping-cart"></i>&nbsp;<span class="countShoppingCartPopup">
                            </span> sản phẩm đã chọn
                        </a>
                    </p>
                    <span class="hidden strFavouriteProductId">
                    </span>
                    <span class="hidden strShoppingCartProductId">
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
