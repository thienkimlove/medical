<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="keywords" content="{{(!empty($meta_keywords) ? $meta_keywords : 'medical' )}}" />
    <meta name="description" content="{{(!empty($meta_desc) ? $meta_desc : 'medical' )}}" />
    <title>{{(!empty($meta_title) ? $meta_title : 'medical' )}}</title>
    <link rel="stylesheet" href="{{url('css/medical.css')}}" type="text/css" />
    <!--[if lte IE 8]>
    <script src="{{url('js/html5.js')}}" type="text/javascript"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">
    <!-- Header -->
    @include('frontend.header')
    <!-- endHeader -->
    @yield('content')
    <!-- Footer -->
    @include('frontend.footer')
    <!-- EndFooter -->
    <a id="support" href="javascript:void(0)" title="Support"></a>
    <div class="overlay" id="overlay"></div>
    <div class="menu-mobile" id="menu-mobile">
        <div class="inner">
            <a href="javascript:void(0)" title="Menu" class="btn-menu" id="btn-menu">Menu</a>
            <div class="search">
                <div class="search-in">
                    <form>
                        <input type="text" name="keyword" class="txt" placeholder="Từ khóa tìm kiếm"/>
                        <input type="submit" name="submit" class="btn-find" value=""/>
                    </form>
                </div>
            </div>
            <nav>
                <ul class="nav-mobile">
                    <li>
                        <a href="#" title="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="" title="">Món ăn chữa bệnh</a>
                    </li>
                    <li>
                        <a href="" title="">Sống khỏe mỗi ngày</a>
                    </li>
                    <li>
                        <a href="" title="">Dành cho mẹ và bé</a>
                    <li>
                        <a href="" title="">Địa chỉ hay</a>
                    </li>
                    <li>
                        <a href="" title="">Liên hệ</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{url('js/jquery-1.10.2.min.js')}}"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript" src="{{url('js/twitter.js')}}"></script>
<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
<script type="text/javascript" src="{{url('js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/floating-navigation.js')}}"></script>
<script type="text/javascript" src="{{url('js/common.js')}}"></script>
@yield('footer')
</body>
</html>