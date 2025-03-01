<!doctype html>
<html class="no-js" lang="en">


<head>
    {{-- <base href="/"> :luon lay duong link goc --}}
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="Bemet - Butcher & Meat Shop HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="uploads/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/odometer.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/default.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div id="loading-center">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>
            </div>
        </div>
    </div>
    <!-- preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header class="transparent-header">
        <div class="header-top-wrap">
            <div class="container custom-container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="header-top-left">
                            <ul class="list-wrap">
                                <li class="header-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Ha Noi
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:thanglevan2k2@gmail.com">thanglevan2k2@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="header-top-right">
                            <div class="header-top-menu">
                                <ul class="list-wrap">

                                    @if (auth('cus')->check())
                                        <li><a href="{{ route('account.profile') }}">Hi
                                                {{ auth('cus')->user()->name }}</a></a></li>
                                        <li><a href="{{ route('account.change_password') }}">Đổi mật khẩu</a></a>
                                        </li>
                                        <li><a href="{{ route('account.favorite') }}">Yêu Thích</a></a></li>
                                        <li><a href="{{ route('order.history') }}">Lịch sử</a></a></li>
                                        <li><a href="{{ route('account.logout') }}">Đăng xuất</a></a></li>
                                    @else
                                        <li><a href="{{ route('account.login') }}">Đăng nhập</a></li>
                                        <li><a href="{{ route('account.register') }}">Đăng ký</a></li>
                                    @endif


                                </ul>
                            </div>
                            <div class="header-top-social">
                                <ul class="list-wrap">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sticky-header" class="menu-area">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="menu-wrap">
                            <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                            <nav class="menu-nav">
                                <div class="logo">
                                    <a href="{{ route('home.index') }}"><img src="uploads/logo/logo.png"
                                            alt="Logo"></a>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-lg-flex">
                                    <ul class="navigation">

                                        <li class="active"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                                        <li class=""><a href="{{ route('home.about') }}">Khác</a></li>
                                        <li class="menu-item-has-children"><a href="#">Sản Phẩm</a>
                                            <ul class="sub-menu">
                                                @foreach ($cats_home as $cath)
                                                    <li><a
                                                            href="{{ route('home.category', $cath->id) }}">{{ $cath->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Tin Tức</a>
                                            <ul class="sub-menu">
                                                <li><a href="blog.html">Tin tức 1</a></li>
                                                <li><a href="blog-details.html">Tin tức 2</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Dịch vụ</a>
                                            <ul class="sub-menu">
                                                <li><a href="services.html">Trang dịch vụ</a></li>
                                                <li><a href="services-details.html">Chi tiết</a></li>

                                            </ul>
                                        </li>
                                        <li><a href="#">Liên hệ</a></li>
                                    </ul>
                                </div>
                                <div class="header-action d-none d-md-block">
                                    <ul class="list-wrap">
                                        <li class="header-search">
                                            <a href="#"><i class="flaticon-search"></i></a>
                                        </li>
                                        <li class="header-shop-cart">
                                            <a href="{{ route('cart.index') }}">
                                                <i class="flaticon-shopping-basket"></i>
                                                <span>{{ $carts->sum('quantity') }}</span>
                                            </a>
                                        </li>
                                        <li class="header-btn"><a href="tel:0123456789" class="btn">0 333 555
                                                999</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Mobile Menu  -->
                        <div class="mobile-menu">
                            <nav class="menu-box">
                                <div class="close-btn"><i class="fas fa-times"></i></div>
                                <div class="nav-logo">
                                    <a href="index-2.html"><img src="uploads/logo/logo.png" alt="Logo"></a>
                                </div>
                                <div class="menu-outer">
                                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                </div>
                                <div class="social-links">
                                    <ul class="clearfix list-wrap">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-backdrop"></div>
                        <!-- End Mobile Menu -->

                    </div>
                </div>
            </div>
        </div>

        <!-- header-search -->
        <div class="search-popup-wrap" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="search-wrap text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Enter your keyword...">
                                    <button class="search-btn"><i class="flaticon-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-backdrop"></div>
        <!-- header-search-end -->

    </header>
    <!-- header-area-end -->


    @yield('main')

    <!-- footer-area -->
    <footer>
        <div class="footer-area">
            <div class="footer-logo-area">
                <div class="container">
                    {{-- <div class="footer-logo-wrap">
                        <ul class="list-wrap">
                            <li class="order-0 order-lg-2">
                                <div class="footer-logo">
                                    <a href="index-2.html"><img src="uploads/logo/w_logo.png" alt=""></a>
                                </div>
                            </li>
                            <li>
                                <div class="footer-social">
                                    <ul class="list-wrap">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="order-lg-3">
                                <div class="footer-newsletter">
                                    <h4 class="title">Our Newsletter</h4>
                                    <form action="#">
                                        <input type="email" placeholder="Enter your email...">
                                        <button type="submit">subscribe</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget">
                                <h4 class="fw-title">Thông tin liên hệ</h4>
                                <div class="footer-contact">
                                    <ul class="list-wrap">
                                        <li>Dong Da, Ha Noi</li>
                                        <li><a href="tel:0345638915">+0345 638 915</a></li>
                                        <li><a href="mailto:thanglevan2k2@gmail.com">thanglevan2k2@gmail.com</a></li>
                                    </ul>
                                </div>
                                <div class="footer-content">
                                    <h4 class="title">Giờ mở cửa</h4>
                                    <p>Thứ 2 - Thư 7 <span>06:00-18:00</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget">
                                <h4 class="fw-title">Các thông tin liện hệ khác</h4>
                                <div class="footer-link">
                                    <ul class="list-wrap">
                                        <li><a href="contact.html">Zalo</a></li>
                                        <li><a href="about.html">Facebook</a></li>
                                        <li><a href="contact.html">Instagram</a></li>
                                        <li><a href="contact.html">X</a></li>
                                        <li><a href="contact.html">Sms</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-4">
                            <div class="footer-widget">
                                <h4 class="fw-title">DANH MỤC</h4>
                                <div class="footer-link">
                                    <ul class="list-wrap">
                                        <li><a href="contact.html">Đặt hàng</a></li>
                                        <li><a href="contact.html">Thông tin</a></li>
                                        <li><a href="contact.html">Liên hệ</a></li>
                                        <li><a href="contact.html">Sản phẩm</a></li>
                                        <li><a href="contact.html">Hỏi đáp</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="footer-widget">
                                <h4 class="fw-title">instagram</h4>
                                <div class="footer-instagram">
                                    <ul class="list-wrap">
                                        <li><a href="#"><img src="uploads/images/footer_insta01.jpg"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="uploads/images/footer_insta02.jpg"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="uploads/images/footer_insta03.jpg"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="uploads/images/footer_insta04.jpg"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="uploads/images/footer_insta05.jpg"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="uploads/images/footer_insta06.jpg"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="uploads/images/footer_insta07.jpg"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="uploads/images/footer_insta08.jpg"
                                                    alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-7">
                            <div class="copyright-text">
                                <p>© 2024 Thang <a href="index-2.html">ThangFood</a>, All Rights Reserved</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5">
                            <div class="footer-card text-end">
                                <img src="uploads/images/card.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area-end -->

    <!-- JS here -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.odometer.min.js"></script>
    <script src="assets/js/jquery.appear.js"></script>
    <script src="assets/js/tween-max.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/slick-animation.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/ajax-form.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    @yield('js')
    @if (Session::has('ok'))
        <script>
            $.toast({
                heading: 'Thông báo',
                text: "{{ Session::get('ok') }}",
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-center',
                hideAfter: 2500
            })
        </script>
    @endif
    @if (Session::has('no'))
        <script>
            $.toast({
                heading: 'Thông báo',
                text: "{{ Session::get('no') }}",
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-center',
            })
        </script>
    @endif
</body>


</html>
