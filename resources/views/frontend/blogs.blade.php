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
                @foreach ($blogs as $blog)
                    <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                        <div class="single-blog">
                            <div class="blog-image">
                                <a href="{{ route('single.blog-details', encrypt($blog->id)) }}"><img
                                        src="{{ asset('backend_assets/uploads/blogs/' . $blog->image) }}"
                                        class="img-responsive w-100" alt=""></a>
                            </div>
                            <div class="blog-text">
                                <div class="blog-athor-date">
                                    <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                            aria-hidden="true"></i> {{ date('d M Y', strtotime($blog->created_at)) }}</a>
                                    <a class="blog-mosion" href="#"><i class="fa fa-commenting"
                                            aria-hidden="true"></i> 0</a>
                                </div>
                                <h5 class="blog-heading"><a class="blog-heading-link"
                                        href="{{ route('single.blog-details', encrypt($blog->id)) }}">{{ $blog->title }}</a></h5>

                                <p>
                                    @php
                                        $desc = $blog->description;
                                        if (strlen($desc) > 250) {
                                            echo substr($desc, 0, 250) . '...';
                                        } else {
                                            echo $desc;
                                        }
                                    @endphp
                                </p>

                                <a href="{{ route('single.blog-details', encrypt($blog->id)) }}" class="btn btn-primary blog-btn"> Read More<i
                                        class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{ $blogs->links('pagination::custom') }}
            </div>
        </div>
    </div>

@endsection
