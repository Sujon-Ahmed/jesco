@extends('frontend.layouts.master')
@section('title', 'Jesco Contact')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Contact Us</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Contact Us</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Contact Area Start -->
    <div class="contact-area pt-100px pb-100px">
        <div class="container">
            <div class="contact-wrapper">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact-info">
                            <div class="single-contact">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend_assets/images/icons/4.png') }}" alt="">
                                </div>
                                <div class="info-box">
                                    <h5 class="title">Phone:</h5>
                                    <p><a href="tel:{{ $phone }}">{{ $phone ? $phone : 'N/A' }}</a></p>
                                </div>
                            </div>
                            <div class="single-contact">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend_assets/images/icons/5.png') }}" alt="">
                                </div>
                                <div class="info-box">
                                    <h5 class="title">Email:</h5>
                                    <p><a href="mailto:{{ $email }}">{{ $email ? $email : 'N/A' }}</a></p>
                                </div>
                            </div>
                            <div class="single-contact">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend_assets/images/icons/6.png') }}" alt="">
                                </div>
                                <div class="info-box">
                                    <h5 class="title">Address:</h5>
                                    <p>{{ $address ? $address : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact-form">
                            <div class="contact-title mb-30">
                                <h2 class="title" data-aos="fade-up" data-aos-delay="200">Leave a Message</h2>
                                <p>There are many variations of passages of Lorem Ipsum available but the
                                    suffered alteration in some form.</p>
                            </div>
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <input name="name" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Name*" type="text"
                                            style="border: 1px solid #ddd; font-style:italic" />
                                    </div>
                                    <div class="col-lg-6">
                                        <input name="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Email*" type="email"
                                            style="border: 1px solid #ddd; font-style:italic" />
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5"
                                            style="border: 1px solid #ddd; font-style:italic" placeholder="Your Message*"></textarea>
                                        <button class="btn btn-primary btn-sm mt-4" type="submit">Submit <i
                                                class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Area End -->

    <!-- map Area Start -->
    <div class="contact-map">
        <div id="mapid">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14606.06792954839!2d90.35101527023961!3d23.764597991678137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c09f9ba3d447%3A0x1babce9f1c6c95a3!2sMohammadpur%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1661958770219!5m2!1sen!2sbd"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- map Area End -->
@endsection
