@extends('frontend.layouts.master')
@section('title', 'Jesco Blogs')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Blog Grid</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Blog Grid</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
        <div class="container">
            <div class="row">
                <!-- single blog -->
                 <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                    <div class="single-blog">
                        <div class="blog-image">
                            <a href="blog-single-left-sidebar.html"><img src="{{ asset('frontend_assets/images/blog-image/1.jpg') }}"
                                    class="img-responsive w-100" alt=""></a>
                        </div>
                        <div class="blog-text">
                            <div class="blog-athor-date">
                                <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                        aria-hidden="true"></i> 24 Aug, 2021</a>
                                <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                    K</a>
                            </div>
                            <h5 class="blog-heading"><a class="blog-heading-link"
                                    href="blog-single-left-sidebar.html">There are many variations of
                                    passages of Lorem</a></h5>

                            <p>Lorem ipsum dolor, sit amet cons adipisicing elit. Cumque, quam aperiam alias modi sed
                                totam possimus illo.</p>

                            <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i class="fa fa-arrow-right ml-5px"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
