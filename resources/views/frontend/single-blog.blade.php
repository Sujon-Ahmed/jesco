@extends('frontend.layouts.master')
@section('title', 'Jesco Single Blogs')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Blog Details</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('index.frontend') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blog Details</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    <!-- Blog Area Start -->
    <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 offset-lg-2">
                    <div class="blog-posts">
                        <div class="single-blog-post blog-grid-post">
                            <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                                <img class="img-fluid h-auto"
                                    src="{{ asset('backend_assets/uploads/blogs/' . $blog->image) }}" alt="blog" />
                            </div>
                            <div class="blog-post-content-inner mt-30px" data-aos="fade-up" data-aos-delay="400">
                                <div class="blog-athor-date">
                                    <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                            aria-hidden="true"></i> {{ date('d M Y', strtotime($blog->created_at)) }}</a>
                                    <a class="blog-mosion" href="#"><i class="fa fa-tags"
                                            aria-hidden="true"></i>{{ $blog->relationWithCategory->category_name }}</a>
                                </div>
                                <h4 class="blog-title">{{ $blog->title }}</h4>
                                <p data-aos="fade-up">
                                    {!! $blog->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blag Area End -->
@endsection
