<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="index, follow" />
    <title>@yield('title', 'Jesco')</title>
    <meta name="description" content="Jesco - Fashoin eCommerce HTML Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Add site Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend_assets/images/favicon/favicon.ico') }}" type="image/png">


    <!-- vendor css (Icon Font) -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/vendor/bootstrap.bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/vendor/pe-icon-7-stroke.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/vendor/font.awesome.css') }}" />

    <!-- plugins css (All Plugins Files) -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins/venobox.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend_assets/css/vendor/vendor.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.min.css') }}">

    <!-- Main Style -->
    {{-- <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}" /> --}}
    <style>
        .product {
            border: 1px solid #f1f1f1;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
        }

        .product .content {
            padding: 5px 5px;
        }

        .product-details-content .pro-details-color-info .pro-details-color ul li #product_color {
            width: 42px;
            height: 42px;
            border: 1px solid #d9d9d9;
            display: block;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .product-details-content .pro-details-color-info .pro-details-color ul li a.blue::before {
            background-color: blue;
        }

        .product-details-content .pro-details-color-info .pro-details-color ul li a.white::before {
            background-color: #fff;
        }

        .product-details-content .pro-details-color-info .pro-details-color ul li a.yellow::before {
            background-color: yellow;
        }

        .shop-sidebar-wrap .sidebar-widget-list.color ul li a {
            width: 42px;
            height: 42px;
            background-color: transparent;
            border: 1px solid #d9d9d9;
            display: block;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .shop-sidebar-wrap .sidebar-widget-list.color ul li a.blue::before {
            background-color: blue;
        }

        /* css for paginate */
        .center {
            text-align: center;
        }

        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: tomato;
            color: white;
            border: 1px solid tomato;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>

</head>

<body>

    <!-- Top Bar -->

    <div class="header-to-bar"> HELLO EVERYONE! 25% Off All Products </div>

    <!-- Top Bar -->
    <!-- Header Area Start -->
    <header>
        <div class="header-main sticky-nav ">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-auto align-self-center">
                        <div class="header-logo">
                            <a href="{{ route('index.frontend') }}"><img
                                    src="{{ asset('frontend_assets/images/logo/logo.png') }}" alt="Site Logo" /></a>
                        </div>
                    </div>
                    <div class="col align-self-center d-none d-lg-block">
                        <div class="main-menu">
                            <ul>
                                <li class="{{ Request::is('/') ? 'active' : '' }}"><a
                                        href="{{ route('index.frontend') }}">Home</a></li>
                                <li class="{{ Request::is('shop') ? 'active' : '' }}"><a
                                        href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('blogs-grid') }}">Blogs</a></li>
                                <li><a href="{{ route('about') }}">About us</a></li>
                                <li><a href="{{ route('contact.index') }}">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Action Start -->
                    <div class="col col-lg-auto align-self-center pl-0">
                        <div class="header-actions">
                            <a href="login.html" class="header-action-btn login-btn" data-bs-toggle="modal"
                                data-bs-target="#loginActive">Sign In</a>
                            <!-- Single Wedge Start -->
                            <a href="#" class="header-action-btn" data-bs-toggle="modal"
                                data-bs-target="#searchActive">
                                <i class="pe-7s-search"></i>
                            </a>
                            <!-- Single Wedge End -->
                            <!-- Single Wedge Start -->
                            <a href="#offcanvas-wishlist" class="header-action-btn offcanvas-toggle">
                                <i class="pe-7s-like"></i>
                            </a>
                            <!-- Single Wedge End -->
                            <a href="#offcanvas-cart"
                                class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                                <i class="pe-7s-shopbag"></i>
                                <span class="header-action-num">01</span>
                                <!-- <span class="cart-amount">€30.00</span> -->
                            </a>
                            <a href="#offcanvas-mobile-menu"
                                class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                                <i class="pe-7s-menu"></i>
                            </a>
                        </div>
                        <!-- Header Action End -->
                    </div>
                </div>
            </div>
    </header>
    <!-- Header Area End -->
