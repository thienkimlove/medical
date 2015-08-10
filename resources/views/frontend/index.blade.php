@extends('frontend')
@section('content')
    <section id="container" class="fix-width">
        <!-- Banner -->
        <div class="box-slider">
            <div class="owl-carousel" id="slide-homepage">
                <div class="item">
                    <a class="thumb" href="" title="">
                        <img src="images/slide01.jpg"/>
                    </a>
                </div>
                <div class="item">
                    <a class="thumb" href="" title="">
                        <img src="images/slide01.jpg"/>
                    </a>
                </div>
                <div class="item">
                    <a class="thumb" href="" title="">
                        <img src="images/slide01.jpg"/>
                    </a>
                </div>
                <div class="item">
                    <a class="thumb" href="" title="">
                        <img src="images/slide01.jpg"/>
                    </a>
                </div>
            </div>
        </div>
        <!-- EndBanner -->
        <!-- Box-General -->
        <h3 class="title-mobile"><span class="i-touch"></span>Ý kiến người bệnh</h3>
        <div class="box-media">
            <div class="box-video">
                <h3 class="title"><span class="i-video"></span>Thư viện Video</h3>
                <div class="video-content">
                    @foreach ($videos as $video)
                    <div class="item">
                        <h3 class="title-box">{{str_limit($video->title, 40)}}</h3>
                        <div class="videoBoxIn">
                            <div class="videoBoxInObject">
                                <iframe width="100%" height="250" src="{{$video->url}}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- boxSound -->
            <div class="box-sound ">
                <h3 class="title"><span class="i-sound"></span>Thư viện Âm thanh</h3>
                <div class="item">
                    <h3 class="title-box">{{str_limit($sound->title, 40)}}</h3>
                    <div class="soundBoxIn">
                        <div class="soundBoxInObject">
                            <iframe width="100%" height="850" scrolling="no" frameborder="no" src="{{$sound->url}}"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- endboxSound -->
        </div>
        <!-- endBox-Media -->
        <!-- Box-news -->
        <div class="box-news">
            <h2 class="title center">{{$best->title}}</h2>
            <article class="data">
                <div class="thumb">
                    <img src="{{url('image-cached/320x215', $best->image)}}"  alt="Thumb Detail">
                </div>
                <h3>{{$best->desc}}</h3>
                {!! $best->content !!}
                <!-- boxUtility -->
                <div class="utility">
                    <div class="item">
                        <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=21"  style="border:none; overflow:hidden; height:21px;"></iframe>
                    </div>
                    <div class="item">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="item">
                        <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                    </div>
                    <div class="item">
                        <a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.flickr.com%2Fphotos%2Fkentbrew%2F6851755809%2F&media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
                    </div>
                </div>
                <!-- endboxUtility -->
            </article>
        </div>
        <!-- endBox-News -->
        <!-- Box-relatedPost -->
        <div class="box-relatedPost">
            <div class="box-category clearFix">
                <h3 class="title"><span class="i-category"></span>Danh mục</h3>
                @foreach ($categories as $category)
                <article class="item">
                    <a href="{{url('chuyen-muc', $category->slug)}}" class="thumb"><img src="{{url('images/g1.jpg')}}" alt="G1"></a>
                    <h3><a href="{{url('chuyen-muc', $category->slug)}}">{{str_limit($category->name, 40)}}</a></h3>
                </article>
                @endforeach
            </div>
            <div class="box-hot">
                <h3 class="title"><span class="i-hot"></span>Bài viết mới</h3>
                <ul class="list">
                    @foreach ($newestPosts as $post)
                    <li><a href="{{url($post->slug)}}">{{str_limit($post->title, 40)}}</a></li>
                     @endforeach
                </ul>
            </div>
        </div>
        <!-- endBox-relatedPost -->
    </section>
@endsection