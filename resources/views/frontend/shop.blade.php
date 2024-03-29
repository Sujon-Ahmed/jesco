@extends('frontend.layouts.master')
@section('title', 'Jesco Shop')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->
    <!-- Shop Page Start  -->
    <div class="shop-category-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                    <!-- Shop Top Area Start -->
                    <div class="shop-top-bar d-flex">
                        <!-- Left Side start -->
                        <p> Totla Product Found of <span>{{ $total_products }}</span></p>
                        <!-- Left Side End -->
                        <div class="shop-tab nav">
                            <a class="active" href="#shop-grid" data-bs-toggle="tab">
                                <i class="fa fa-th" aria-hidden="true"></i>
                            </a>
                            <a href="#shop-list" data-bs-toggle="tab">
                                <i class="fa fa-list" aria-hidden="true"></i>
                            </a>
                        </div>
                        <!-- Right Side Start -->
                        <div class="select-shoing-wrap d-flex align-items-center">
                            <div class="shot-product">
                                <p>Sort By:</p>
                            </div>
                            <div class="shop-select">
                                <select class="shop-sort" onchange="sortProduct()" id="sortby">
                                    <option {{ $sort_text == 'default' ? 'selected' : '' }} value="default">Default</option>
                                    <option {{ $sort_text == 'newest' ? 'selected' : '' }} value="newest"> Newest</option>
                                    <option {{ $sort_text == 'oldest' ? 'selected' : '' }} value="oldest"> Oldest</option>
                                    <option {{ $sort_text == 'low-to-high' ? 'selected' : '' }} value="low-to-high"> Price,
                                        low to high</option>
                                    <option {{ $sort_text == 'high-to-low' ? 'selected' : '' }} value="high-to-low"> Price,
                                        high to low</option>
                                </select>

                            </div>
                        </div>
                        <!-- Right Side End -->
                    </div>
                    <!-- Shop Top Area End -->

                    <!-- Shop Bottom Area Start -->
                    <div class="shop-bottom-area">

                        <!-- Tab Content Area Start -->
                        <div class="row">
                            <div class="col">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="shop-grid">
                                        <div class="row mb-n-30px">
                                            @foreach ($products as $product)
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                                    data-aos-delay="400">
                                                    <!-- Single Prodect -->
                                                    <div class="product">
                                                        <div class="thumb">
                                                            <a href="{{ route('single.product', encrypt($product->id)) }}"
                                                                class="image">
                                                                <img src="{{ asset('backend_assets/uploads/products/preview') }}/{{ $product->product_image }}"
                                                                    alt="Product" />
                                                                <img class="hover-image"
                                                                    src="{{ asset('backend_assets/uploads/products/preview') }}/{{ $product->product_image }}"
                                                                    alt="Product" />
                                                            </a>
                                                            <span class="badges">
                                                                @if ($product->discount)
                                                                    <span class="sale">-{{ $product->discount }}%</span>
                                                                @endif
                                                                @if ($product->tending)
                                                                    <span
                                                                        class="new">{{ $product->tending == 1 ? 'Tending' : '' }}</span>
                                                                @endif
                                                            </span>
                                                            <div class="actions">
                                                                <a href="wishlist.html" class="action wishlist"
                                                                    title="Wishlist"><i class="pe-7s-like"></i></a>
                                                                <a href="#" class="action quickview"
                                                                    data-link-action="quickview" title="Quick view"
                                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                                        class="pe-7s-search"></i></a>
                                                                <a href="compare.html" class="action compare"
                                                                    title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                                            </div>
                                                            <button title="Add To Cart" class=" add-to-cart">Add
                                                                To Cart</button>
                                                        </div>
                                                        <div class="content">
                                                            <span class="ratings">
                                                                <span class="rating-wrap">
                                                                    <span class="star" style="width: 80%"></span>
                                                                </span>
                                                                <span class="rating-num">( 4 Review )</span>
                                                            </span>
                                                            <h5 class="title"><a
                                                                    href="{{ route('single.product', encrypt($product->id)) }}">{{ $product->product_name }}</a>
                                                            </h5>
                                                            <span class="price">
                                                                <span
                                                                    class="new">৳{{ ceil($product->after_discount) }}</span>
                                                                <span class="old">$৳{{ $product->product_price }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!-- Single Prodect -->
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="shop-list">
                                        @foreach ($products as $product)
                                            <div class="shop-list-wrapper">
                                                <div class="row">
                                                    <div class="col-md-5 col-lg-5 col-xl-4">
                                                        <div class="product">
                                                            <div class="thumb">
                                                                <a href="{{ route('single.product', encrypt($product->id)) }}"
                                                                    class="image">
                                                                    <img src="{{ asset('backend_assets/uploads/products/preview') }}/{{ $product->product_image }}"
                                                                        alt="Product" />
                                                                    <img class="hover-image"
                                                                        src="{{ asset('backend_assets/uploads/products/preview') }}/{{ $product->product_image }}"
                                                                        alt="Product" />
                                                                </a>
                                                                <span class="badges">
                                                                    @if ($product->discount)
                                                                        <span
                                                                            class="sale">-{{ $product->discount }}%</span>
                                                                    @endif
                                                                    @if ($product->tending)
                                                                        <span
                                                                            class="new">{{ $product->tending == 1 ? 'Tending' : '' }}</span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 col-lg-7 col-xl-8">
                                                        <div class="content-desc-wrap">
                                                            <div class="content">
                                                                <span class="ratings">
                                                                    <span class="rating-wrap">
                                                                        <span class="star" style="width: 80%"></span>
                                                                    </span>
                                                                    <span class="rating-num">( 4 Review )</span>
                                                                </span>
                                                                <h5 class="title"><a
                                                                        href="{{ route('single.product', $product->id) }}">{{ $product->product_name }}</a>
                                                                </h5>
                                                                <p><?= $product->short_description ?></p>
                                                            </div>
                                                            <div class="box-inner">
                                                                <span class="price">
                                                                    <span
                                                                        class="new">৳{{ ceil($product->after_discount) }}</span>
                                                                    <span
                                                                        class="old">$৳{{ $product->product_price }}</span>
                                                                </span>
                                                                <div class="actions">
                                                                    <a href="wishlist.html" class="action wishlist"
                                                                        title="Wishlist"><i class="pe-7s-like"></i></a>
                                                                    <a href="#" class="action quickview"
                                                                        data-link-action="quickview" title="Quick view"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal"><i
                                                                            class="pe-7s-search"></i></a>
                                                                    <a href="compare.html" class="action compare"
                                                                        title="Compare"><i
                                                                            class="pe-7s-refresh-2"></i></a>
                                                                </div>
                                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                                    To Cart</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tab Content Area End -->

                        <!--  Pagination Area Start -->
                        <div class="mt-5 text-center">
                            {{ $products->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                    <!-- Shop Bottom Area End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="col-lg-3 order-lg-first col-md-12 order-md-last mb-md-60px mb-lm-60px">
                    <div class="shop-sidebar-wrap">
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget-search">
                            <form id="widgets-searchbox" action="#">
                                <input class="input-field" type="text" placeholder="Search">
                                <button class="widgets-searchbox-btn" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget mt-8">
                            <h4 class="sidebar-title">Price Filter</h4>
                            <div class="price-filter">
                                <div class="price-slider-amount">
                                    <input type="text" id="amount" class="p-0 h-auto lh-1" name="price"
                                        placeholder="Add Your Price" />
                                </div>
                                <div id="slider-range"></div>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Category</h4>
                            <div class="sidebar-widget-category">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a href="{{ url('/filter/category/product', encrypt($category->id)) }}"
                                                class="">{{ $category->category_name }}
                                                <span>({{ $category->rel_to_product->count() }})</span> </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Color</h4>
                            <div class="sidebar-widget-list color">
                                <ul>
                                    @foreach ($colors as $color)
                                        <li><a class="{{ $color->color_name }}" href="#"></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Size</h4>
                            <div class="sidebar-widget-list size">
                                <ul>
                                    @foreach ($sizes as $size)
                                        <li><a class="gray" href="#">{{ $size->size }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget tag">
                            <h4 class="sidebar-title">Tags</h4>
                            <div class="sidebar-widget-tag">
                                <ul>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Organic</a></li>
                                    <li><a href="#">Old Fashion</a></li>
                                    <li><a href="#">Men</a></li>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Dress</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget-image">
                            <div class="single-banner">
                                <img src="assets/images/banner/2.jpg" alt="">
                                <div class="item-disc">
                                    <h2 class="title">#bestsellers</h2>
                                    <a href="single-product-variable.html" class="shop-link">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Page End  -->
    <form id="filterForm">
        <input type="hidden" name="sort" id="sort">
    </form>
@endsection
