@extends('front.layout.layout')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($banners as $key => $banner)
                        @if ($banner['type'] == 'Slider')
                            <li data-target="#header-carousel" data-slide-to="{{$key}}" class="{{$key == 0? 'active' : ''}}"></li>
                        @endif
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($banners as $key => $banner)
                        @if ($banner['type'] == 'Slider')
                            <div class="carousel-item position-relative {{$key == 0? 'active' : ''}}" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{ asset ('front/images/banner/'. $banner['image']) }}" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{$banner['title']}}</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{$banner['text']}}</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="{{$banner['url']}}">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                    @php
                        $count = 0
                    @endphp
                @foreach ($banners as $key => $banner)
                    @if ($banner['type'] == 'Offer')
                        @php
                            $count += 1
                        @endphp
                        <div class="product-offer mb-30" style="height: 200px;">
                            <img class="img-fluid" src="{{ asset ('front/images/banner/'.$banner['image']) }}" alt="">
                            <div class="offer-text">
                                <h6 class="text-white text-uppercase">{{$banner['text']}}</h6>
                                <h3 class="text-white mb-3">{{$banner['title']}}</h3>
                                <a href="{{$banner['url']}}" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    @endif
                    @if($count == 2) @break @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Features Start -->
    <div class="container-fluid pt-0">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Categories Start -->
@include('front.layout.body_categories')
    <!-- Categories End -->


    <!-- Featured Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
        <div class="row px-xl-5">
            @foreach($products as $product)
                @if ($product['is_featured'] == "Yes")
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                @if ($product['images'] != null)
                                @foreach ($product['images'] as $image)
                                <img class="img-fluid w-100" src="{{ asset ('front/images/product/small/'.$image['image']) }}" alt="">
                                    @break
                                @endforeach
                            @endif
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{url('/product',[$product['id']])}}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$product['product_name']}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$product['final_price'] == $product['product_price'] ? $product['product_price']:$product['final_price']}}</h5><h6 class="text-muted ml-2"><del>{{$product['final_price'] == $product['product_price'] ? '':$product['product_price']}}</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            @foreach ($banners as $key => $banner)
            @if ($banner['type'] == "Offer")
                <div class="col-md-6">
                    <div class="product-offer mb-30" style="height: 300px;">
                        <img class="img-fluid" src="{{ asset ('front/images/banner/'.$banner['image']) }}" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">{{$banner['text']}}</h6>
                            <h3 class="text-white mb-3">{{$banner['title']}}</h3>
                            <a href="{{$banner['url']}}" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>
    <!-- Offer End -->


    <!--Recent Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
        <div class="row px-xl-5">
            @php
                $count = 0;
            @endphp
                @foreach($products as $key => $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                @if ($product['images'] != null)
                                @foreach ($product['images'] as $image)
                                <img class="img-fluid w-100" src="{{ asset ('front/images/product/small/'.$image['image']) }}" alt="">
                                    @break
                                @endforeach
                            @endif
                                <div class="product-action">
                                    <a class="btn action btn-outline-dark btn-square" href="{{url('/product',[$product['id']])}}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$product['product_name']}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$product['final_price'] == $product['product_price'] ? $product['product_price']:$product['final_price']}}</h5><h6 class="text-muted ml-2"><del>{{$product['final_price'] == $product['product_price'] ? '':$product['product_price']}}</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $count += 1;
                    @endphp
                    @if ($count == 8)
                        @break
                    @endif
            @endforeach
        </div>
    </div>
    <!-- Products End -->
@endsection