@extends('frontend.layout.__index')
@section('content')
    <section id="content">
        <div class="columns-container">
            <div class="container" id="columns">
                <div class="breadcrumb clearfix">
                    <a class="home" href="{{route('shop.home')}}" title="Trang chủ">Trang chủ</a>
                    <span class="navigation-pipe">&nbsp;</span>
                    @foreach($categoryParent as $key=>$item)
                        <a class="home" href="{{route('shop.category' , ['slug'=> $item->slug])}}" title="{{$item->name}}">{{$item->name}}</a>
                        <span class="navigation-pipe">&nbsp;</span>
                    @endforeach
                    <a class="home" href="javascript:void(0)" title="{{$category->name}}">{{$category->name}}</a>
                </div>
                <h1 style="position:absolute; z-index:-100000; visibility:hidden; width:1px">{{$category->name}}</h1>
                <div class="content-shop">
                    <div class="center_column" id="center_column">
                        <h2 class="page-heading product">
                               <span class="page-heading-title">
                               {{$category->name}}</span>
                        </h2>
                        <div class="content-pro2" style="height: auto;">
                            <p style="text-align: center;">
                                <img alt="{{$category->name}}" src=" {{getImageThumb($category->image , 610, 240)}}"></p>
                            <p>
                                {{$item->description ?? ''}}
                            </p>
                        </div>
                        <div class="show-more2" style="display: none;" onclick="showArticle();">
                            <a id="xem-them"  href="javascript:void(0);" class="readmore">Đọc
                                thêm</a></div>
                        <div id="view-product-list" class="view-product-list">

                            <div id="ctl00_ContentPlaceHolder1_PageView1_ctl00_UpdatePanel1">
                                <div class="filter-container">
                                    <hr>
                                </div>
                                <div class="content-header clearfix">
                                    <div class="content-header-left">
                                        <!-- <select name="ctl00$ContentPlaceHolder1$PageView1$ctl00$DropDownListSortBy"
                                                onchange=""
                                                id="ctl00_ContentPlaceHolder1_PageView1_ctl00_DropDownListSortBy"
                                                title="Sort by" class="drop-sort">
                                            <option selected="selected" value="0">Ngầm định</option>
                                            <option value="1"> Giá thấp đến cao</option>
                                            <option value="2"> Giá cao đến thấp</option>
                                            <option value="3"> Mới đến cũ</option>
                                            <option value="4"> Cũ đến mới</option>
                                            <option value="5"> Thứ tự cao đến thấp</option>
                                            <option value="6"> Thứ tự thấp đến cao</option>
                                            <option value="7"> Giảm giá cao đến thấp</option>
                                            <option value="8"> Giảm giá thấp đến cao</option>
                                            <option value="9"> Chỉ sản phẩm mới</option>
                                            <option value="10"> Chỉ tiêu biểu</option>
                                        </select> -->
                                    </div>
                                    <!-- <div class="content-header-right hidden-xs">
                                        <ul class="display-product-option">
                                            <li class="view-as-grid selected">
                                                <span></span>
                                            </li>
                                            <li class="view-as-list">
                                                <span></span>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                                <div class="properties-page-wrapper">
                                    <table style="width: 100%;" class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div id="UpdateProgress2" style="display:none;">
                                                    <img style="padding: 30px 0;" src="./Images/icons/loader.gif"
                                                         alt="wait image">
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <ul class="row product-list grid">
                                    @foreach($products as $key=>$item)
                                        <li class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                            <div class="product-container">
                                                <div class="left-block">
                                                    <a href="{{route('shop.product' , ['slug'=> $item->slug])}}">
                                                        <img class="img-responsive" src="{{getImageThumb($item->image , 260, 347)}}"
                                                             alt="{{$item->name}}">
                                                    </a>
                                                    <div class="group-price">
                                                    </div>
                                                </div>
                                                <div class="right-block">
                                                    <h5 class="product-name"><a
                                                            href="{{route('shop.product' , ['slug'=> $item->slug])}}" title="{{$item->name}}">{{$item->name}}</a></h5>
                                                    <div
                                                        id="ctl00_ContentPlaceHolder1_PageView1_ctl00_DataListData_ctl00_PanelPrice"
                                                        class="content_price">
                                                        Mời liên hệ
                                                    </div>
                                                    <div
                                                        id="ctl00_ContentPlaceHolder1_PageView1_ctl00_DataListData_ctl00_PanelLink"
                                                        class="content_price content-link">
                                                        <a title="{{$item->name}}" class="more-view" href="{{route('shop.product' , ['slug'=> $item->slug])}}">Xem
                                                            thêm</a>
                                                    </div>
                                                    <div
                                                        id="ctl00_ContentPlaceHolder1_PageView1_ctl00_DataListData_ctl00_PanelCode"
                                                        class="product-star">
                                                        {{$item->name}}
                                                    </div>
                                                    <div class="info-orther">
                                                        <div class="product-desc">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="properties-page-wrapper">
                                    <table style="width: 100%;" class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td style="text-align: center;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div id="UpdateProgress1" style="display:none;">
                                                    <img src="./Images/icons/loader.gif" alt="wait image">
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="content-pro3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
