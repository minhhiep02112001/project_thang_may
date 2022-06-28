@extends('frontend.layout.__index')

@section('content')
    <section id="content">
        <section class="columns-container">
            <div class="container" id="columns">
                <div class="breadcrumb clearfix">
                    <a class="home" href="/mau-web/5211/" title="Trang chủ">Trang chủ</a><span class="navigation-pipe">&nbsp;</span><a class="home" href="/mau-web/5211/tin-tuc.html" title="Tin tức">Tin tức</a>
                </div>
                <div class="row">
                    <div class="center_column col-xs-12 col-sm-12" id="center_column">
                        <h1 style="position:absolute; z-index:-100000; visibility:hidden; width:1px">Lót Sàn Gỗ Nhựa Composite Sân Thượng Ngoài Trời cho ngôi nhà bạn</h1>
                        <h2 class="page-heading">
                               <span class="page-heading-title2">
                               {{$article->title}}
                               </span>
                        </h2>
                        <span id="ctl00_ContentPlaceHolder1_PageView1_ctl00_LabelErr" style="color:Red;"></span>
                        <article class="entry-detail">
                            <div class="entry-meta-data">
                                <span class="cat"><i class="fa fa-folder-o"></i> <a href="{{route('shop.news')}}" class="color">Tin tức</a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar"></i> {{date('d-m-Y H:i:s A', strtotime($article->updated_at))}}</span>
                                <span class="post-star"><i class="fa fa-eye" title="Viewed"></i> <span>18</span></span>
                            </div>
                            <div class="content">
                                {!! $article->description !!}
                            </div>
                            <div class="commentbox">
                            </div>
                            <div style="clear: both; padding-bottom: 5px;"></div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
