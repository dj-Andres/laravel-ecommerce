<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description','Dj-Andres')">
    <title>Ecommerce @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('web/assets/img/favicon.ico') }}" type="image/x-icon" />
    <link href="{{ asset('web/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/helper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/skin-default.css') }}" rel="stylesheet" id="galio-skin">
    @yield('style')
</head>
<body>
    <div class="color-switcher">
        <div class="color-switcher-inner">
            <div class="switcher-icon">
                <i class="fa fa-cog fa-spin"></i>
            </div>
            <div class="switcher-panel-item">
                <h3>Color Schemes</h3>
                <ul class="nav flex-wrap colors">
                    <li class="default active" data-color="default" data-toggle="tooltip" data-placement="top" title="Red"></li>
                    <li class="green" data-color="green" data-toggle="tooltip" data-placement="top" title="Green"></li>
                    <li class="soft-green" data-color="soft-green" data-toggle="tooltip" data-placement="top" title="Soft-Green"></li>
                    <li class="sky-blue" data-color="sky-blue" data-toggle="tooltip" data-placement="top" title="Sky-Blue"></li>
                    <li class="orange" data-color="orange" data-toggle="tooltip" data-placement="top" title="Orange"></li>
                    <li class="violet" data-color="violet" data-toggle="tooltip" data-placement="top" title="Violet"></li>
                </ul>
            </div>

            <div class="switcher-panel-item">
                <h3>Layout Style</h3>
                <ul class="nav layout-changer">
                    <li><button class="btn-layout-changer active" data-layout="wide">Wide</button></li>
                    <li><button class="btn-layout-changer" data-layout="boxed">Boxed</button></li>
                </ul>
            </div>

            <div class="switcher-panel-item bg">
                <h3>Background Pattern</h3>
                <ul class="nav flex-wrap bgbody-style bg-pattern">
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-pettern/1.png') }}" alt="Pettern"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-pettern/2.png') }}" alt="Pettern"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-pettern/3.png') }}" alt="Pettern"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-pettern/4.png') }}" alt="Pettern"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-pettern/5.png') }}" alt="Pettern"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-pettern/6.png') }}" alt="Pettern"></li>
                </ul>
            </div>
            <div class="switcher-panel-item bg">
                <h3>Background Image</h3>
                <ul class="nav flex-wrap bgbody-style bg-img">
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-img/01.jpg') }}" alt="Images"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-img/02.jpg') }}" alt="Images"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-img/03.jpg') }}" alt="Images"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-img/04.jpg') }}" alt="Images"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-img/05.jpg') }}" alt="Images"></li>
                    <li><img src="{{ asset('web/assets/img/bg-panel/bg-img/06.jpg') }}" alt="Images"></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="wrapper box-layout">
        @include('layouts.ecommerce.header')
        @yield('content')
        @include('layouts.ecommerce.footer')
    </div>


    <!-- Quick view modal start -->
    <div class="modal" id="quick_view">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider slick-arrow-style_2 mb-20">
                                    <div class="pro-large-img">
                                        <img src="web/assets/img/product/product-details-img1.jpg" alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="web/assets/img/product/product-details-img2.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="web/assets/img/product/product-details-img3.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="web/assets/img/product/product-details-img4.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="web/assets/img/product/product-details-img5.jpg" alt=""/>
                                    </div>
                                </div>
                                <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                    <div class="pro-nav-thumb"><img src="web/assets/img/product/product-details-img1.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="web/assets/img/product/product-details-img2.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="web/assets/img/product/product-details-img3.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="web/assets/img/product/product-details-img4.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="web/assets/img/product/product-details-img5.jpg" alt="" /></div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <h3><a href="product-details.html">external product 12</a></h3>
                                    <div class="ratings">
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <div class="pro-review">
                                            <span>1 review(s)</span>
                                        </div>
                                    </div>
                                    <div class="availability mt-10">
                                        <h5>Availability:</h5>
                                        <span>1 in stock</span>
                                    </div>
                                    <div class="pricebox">
                                        <span class="regular-price">$160.00</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.<br>
                                    Phasellus id nisi quis justo tempus mollis sed et dui. In hac habitasse platea dictumst. Suspendisse ultrices mauris diam. Nullam sed aliquet elit. Mauris consequat nisi ut mauris efficitur lacinia.</p>
                                    <div class="quantity-cart-box d-flex align-items-center mt-20">
                                        <div class="quantity">
                                            <div class="pro-qty"><input type="text" value="1"></div>
                                        </div>
                                        <div class="action_link">
                                            <a class="buy-btn" href="#">add to cart<i class="fa fa-shopping-cart"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>

    <script src="{{ asset('web/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('web/assets/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('web/assets/js/main.js') }}"></script>
    <script src="{{ asset('web/assets/js/switcher.js') }}"></script>
    @yield('scripts')
</body>


</html>