<!DOCTYPE html>
<html lang="vi">
<head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
    <link type="image/x-icon" href="{{url('favicon.ico')}}" rel="shortcut icon"/>
    <link href="https://plus.google.com/107515763736347546999" rel="publisher"/>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700italic,800italic,700,800&amp;subset=latin,vietnamese" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css"/>
    <meta content='GCL' name='generator'/>
    <title>{{!empty($meta_title)? $meta_title : 'Giảo Cổ Lam'}}</title>

    <meta property="og:title" content="Tiêu đề site hoặc tên bài viết">
    <meta property="og:description" content="{{!empty($meta_desc)? $meta_desc : 'Giảo Cổ Lam'}}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="Đường dẫn hiện tại">
    <meta property="og:image" content="Đường dẫn ảnh logo hoặc ảnh bài viết">
    <meta property="og:site_name" content="{{!empty($meta_title)? $meta_title : 'Giảo Cổ Lam'}}">

    <meta name="twitter:card" content="Card">
    <meta name="twitter:url" content="Đường dẫn hiện tại">
    <meta name="twitter:title" content="{{!empty($meta_title)? $meta_title : 'Giảo Cổ Lam'}}">
    <meta name="twitter:description" content="{{!empty($meta_desc)? $meta_desc : 'Giảo Cổ Lam'}}">
    <meta name="twitter:image" content="Đường dẫn ảnh logo hoặc ảnh bài viết">

    <meta itemprop="name" content="Tiêu đề site hoặc tên bài viết">
    <meta itemprop="description" content="{{!empty($meta_desc)? $meta_desc : 'Giảo Cổ Lam'}}">
    <meta itemprop="image" content="Đường dẫn ảnh logo hoặc ảnh bài viết">

    <meta name="ABSTRACT" content="{{!empty($meta_desc)? $meta_desc : 'Giảo Cổ Lam'}}"/>
    <meta http-equiv="REFRESH" content="1200"/>
    <meta name="REVISIT-AFTER" content="1 DAYS"/>
    <meta name="DESCRIPTION" content="{{!empty($meta_desc)? $meta_desc : 'Giảo Cổ Lam'}}"/>
    <meta name="KEYWORDS" content="{{!empty($meta_keywords)? $meta_keywords : 'Giảo Cổ Lam, bài viết, hướng dẫn'}}"/>
    <meta name="ROBOTS" content="index,follow"/>
    <meta name="AUTHOR" content="{{!empty($meta_title)? $meta_title : 'Giảo Cổ Lam'}}"/>
    <meta name="RESOURCE-TYPE" content="DOCUMENT"/>
    <meta name="DISTRIBUTION" content="GLOBAL"/>
    <meta name="COPYRIGHT" content="Copyright 2015 by TueLinh"/>
    <meta name="Googlebot" content="index,follow,archive" />
    <meta name="RATING" content="GENERAL"/>
    <!--[if lte IE 8]>
    <script src="{{url('js/html5.js')}}" type="text/javascript"></script>
    <![endif]-->
    <!--[if lte IE 7]>
    <link rel="stylesheet" href="{{url('css/ie.css')}}" type="text/css"/>
    <![endif]-->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
</head>
<body class="home">
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=1569708656596422";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="wrapper" id="wrapper">
    @include('frontend.header')
    @yield('content')
    @include('frontend.footer')
    <div class="overlay" id="overlay"></div>
    @include('frontend.menu_left')
</div>
<script type="text/javascript" src="{{url('js/jquery-1.10.2.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/common.js')}}"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-66012758-1', 'auto');
    ga('send', 'pageview');

</script>
@yield('footer')
</body>
</html>