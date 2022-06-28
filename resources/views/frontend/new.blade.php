@extends('frontend.layout.__index')
@section('content')
    <section id="content">
        <div class="columns-container">
            <div class="bg-banner-product news">
            </div>
            <div class="container" id="columnstop">
                <div class="breadcrumb clearfix">
                    <a class="home" href="{{route('shop.home')}}" title="Trang chủ">Trang chủ</a>
                    <span class="navigation-pipe">&nbsp;</span>
                    <a class="home" href="{{route('shop.news')}}" title="Tin tức">Tin tức</a>
                </div>
            </div>
            <div class="container" id="columns">
                <h1 style="position:absolute; z-index:-100000; visibility:hidden; width:1px">Tin tức</h1>
                <h2 class="page-heading">
                         <span class="page-heading-title2">
                         Tin tức</span>
                </h2>
                <div class="row">
                    <div class="center_column col-xs-12 col-sm-12" id="center_column">
                        <ul class="blog-posts">
                            @foreach($news as $key=>$item)
                            <li class="post-item">
                                <article class="entry">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="entry-thumb image-hover2">
                                                <a href="{{route('shop.details.new' , ['slug'=>$item->slug])}}">
                                                    <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="entry-ci">
                                                <h3 class="entry-title">
                                                    <a href="{{route('shop.details.new' , ['slug'=>$item->slug])}}">{{$item->title}}</a>
                                                </h3>
                                                <div class="entry-meta-data">
                                                 <span class="cat">
                                                 <i class="fa fa-folder-o"></i>
                                                 <a href="#">Tin tức</a>
                                                 </span>
                                                    <span class="comment-count">
                                                 <i class="fa fa-eye"></i>&nbsp;17
                                                 </span>
                                                    <span class="date">
                                                        <i class="fa fa-calendar"></i>{{date('d-m-y', strtotime($item->updated_at))}}</span>
                                                </div>
                                                <div class="entry-excerpt">
                                                    {!! $item->summary !!}
                                                </div>
                                                <div class="entry-more">
                                                    <a href="{{route('shop.details.new' , ['slug'=>$item->slug])}}">Xem tiếp</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </li>
                            @endforeach
                        </ul>
                        <div class="total-count">
                            Đang xem 1/1 trang. Tổng số: 3 bản ghi được tìm thấy.
                        </div>
                        <div class="pagibar text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
