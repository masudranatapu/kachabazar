@extends('layouts.frontend.app')

@section('title','Welcome to Kachabazar')

@section('meta')
    @php
      $website = App\Website::get()->last();
    @endphp

   <meta name='subject' content='ecommerce's subject'>
   <meta name='title' content='@if (isset($website->title)) {{$website->title}} @endif|| {{ config('app.name') }}'>
   <meta name='description' content='@if (isset($website->meta_tag)) {{$website->meta_tag}} @endif'>
   <meta name='keywords' content='@if (isset($website->meta_keyword)) {{$website->meta_keyword}} @endif'>
   <meta name='author' content='yousuf1648|projanmoit.com'>
   <meta name='copyright' content='yousuf1648|projanmoit.com'>
@endsection
@push('css')
    <link href="{{ asset('dist/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/owl.theme.default.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <!--slider area start-->
    @include('layouts.frontend.partial.home-banner')
    <!--slider area end-->
    <!--categories section start-->
    <div class="category_section  py-4 ">
        <div class="container">
            <div class="row">
                <div class="col-12">   
                    <div class="categorie_banner_title">
                        <h3>Product Categories</h3>
                    </div>
                </div>    
            </div>
            <div class="row cat">
                @foreach ($categories as $key=>$category)
                    <div class="col-lg-3 col-sm-4 col-6">
                        <div class="product text-center grey-section mb-4">
                            <figure class="product-media mb-0">
                                <a href="{{ route('category',$category->slug) }}">
                                    <img style="width: 263px; height: 263px;" src="
                                        @if ($category->image=='default.png')
                                            {{ asset('images/default.png') }}
                                        @else
                                            {{ asset($category->image) }}
                                        @endif
                                    " alt="product">
                                </a>
                            </figure>
                            <div class="category-bottom py-2">
                                <h3 class="title mb-0" title="Gardening">
                                    <a href="{{ route('category',$category->slug) }}">{{ $category->name }}</a>
                                </h3>
                                <!-- <div class="product-quantity">
                                    <span>10 Products</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">   
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('all_category') }}" class="btn-product vbtn-sm text-capitalize" title="View More">view more<i class="fa fa-angle-double-right ml-2" aria-hidden="true"></i></a>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!--categories section end-->
    <!--Best selling start-->
    <div class="best_selling_section  py-4 grey-section ">
        <div class="container">
            <div class="row">
                <div class="col-12">   
                    <div class="categorie_banner_title">
                        <h3>Best Selling</h3>
                    </div>
                </div>    
            </div>
            <div class="row cat">
                <div class="categorie_banner_active owl-carousel">
                    @if ($best_selling->count() > 0)
                        @foreach ($best_selling as $key=>$best)
                            @php
                                $stock = App\Purchase::where('product_id',$best->id)->get();
                            @endphp
                            @if ($stock->count() > 0)
                                <div class="col-lg-3">
                                    <div class="product text-center mb-4 bg-white">
                                        <figure class="product-media mb-0">
                                            <a href="{{ route('product_details',$best->slug) }}">
                                                <img style="width: 263px; height: 263px;" src="{{ URL::to($best->cover_photo) }}" alt="{{ $best->title }}">
                                            </a>
                                            <div class="product-label-group">
                                                @if($best->discount)
                                                    <span class="product-label label-sale">{{$best->discount}}% off</span>
                                                @endif
                                            </div>
                                            <div class="product-action-vertical">
                                                <!-- <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a> -->
                                            </div>
                                        </figure>
                                        <div class="Service-bottom py-3">
                                            <h3 class="title" title="{{ $best->title }}">
                                                <a href="{{ route('product_details',$best->slug) }}">{{ $best->title }}</a>
                                            </h3>
                                            <div class="product-price">
                                                <ins class="new-price">৳ {{ $best->sell_price }}</ins>
                                                @if($best->discount)
                                                    <del class="old-price">৳ {{ $best->regular_price }}</del>
                                                @endif
                                            </div>
                                            <div class="product-action">
                                                <a href="{{ route('add_to_cart',$best->id) }}" class="btn-product pbtn-sm ml-0 text-capitalize rounded-pill" title="Quick View">buy now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">   
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{route('best.selling')}}" class="btn-product vbtn-sm text-capitalize" title="View More">view more<i class="fa fa-angle-double-right ml-2" aria-hidden="true"></i></a>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!--Best selling end-->
    <!--New Arrival start-->
    <div class="new_arrival_section  py-4 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">   
                    <div class="categorie_banner_title">
                        <h3>New Arrival</h3>
                    </div>
                </div>    
            </div>
            <div class="row cat">
                <div class="categorie_banner_active owl-carousel">
                    @if ($new_arrival->count() > 0)
                        @foreach ($new_arrival as $key=>$arrival)
                            @php
                                $stock = App\Purchase::where('product_id',$arrival->id)->get();
                            @endphp
                            @if ($stock->count() > 0)
                                <div class="col-lg-3">
                                    <div class="product text-center mb-4 grey-section">
                                        <figure class="product-media mb-0">
                                            <a href="{{ route('product_details',$arrival->slug) }}">
                                                <img style="width: 263px; height: 263px;" src="{{ URL::to($arrival->cover_photo) }}" alt="{{ $arrival->title }}">
                                            </a>
                                            <div class="product-label-group">
                                                @if($arrival->discount)
                                                    <span class="product-label label-sale">{{$arrival->discount}}% off</span>
                                                @endif
                                            </div>
                                            <div class="product-action-vertical">
                                                <!-- <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a> -->
                                            </div>
                                        </figure>
                                        <div class="Service-bottom py-3">
                                            <h3 class="title" title="{{ $arrival->title }}">
                                                <a href="{{ route('product_details',$arrival->slug) }}">{{ $arrival->title }}</a>
                                            </h3>
                                            <div class="product-price">
                                                <ins class="new-price">৳ {{ $arrival->sell_price }}</ins>
                                                @if($arrival->discount)
                                                    <del class="old-price">৳ {{ $arrival->regular_price }}</del>
                                                @endif
                                            </div>
                                            <div class="product-action">
                                                <a href="{{ route('add_to_cart',$arrival->id) }}" class="btn-product pbtn-sm ml-0 text-capitalize rounded-pill" title="Buy Now">buy now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">   
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{route('new.arrival')}}" class="btn-product vbtn-sm text-capitalize" title="View More">view more<i class="fa fa-angle-double-right ml-2" aria-hidden="true"></i></a>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!--New Arrival end-->
    <!--Popular Product start-->
    <div class="best_selling_section  py-4 grey-section ">
        <div class="container">
            <div class="row">
                <div class="col-12">   
                    <div class="categorie_banner_title">
                        <h3>Popular Product</h3>
                    </div>
                </div>    
            </div>
            <div class="row cat">
                <div class="categorie_banner_active owl-carousel">
                    @if ($popular_product->count() > 0)
                        @foreach ($popular_product as $key=>$popular)
                            @php
                                $stock = App\Purchase::where('product_id',$popular->id)->get();
                            @endphp
                            @if ($stock->count() > 0)
                                <div class="col-lg-3">
                                    <div class="product text-center mb-4 bg-white">
                                        <figure class="product-media mb-0">
                                            <a href="{{ route('product_details',$popular->slug) }}">
                                                <img style="width: 263px; height: 263px;" src="{{ URL::to($popular->cover_photo) }}" alt="{{ $popular->title }}">
                                            </a>
                                            <div class="product-label-group">
                                                @if($popular->discount)
                                                    <span class="product-label label-sale">{{$popular->discount}}% off</span>
                                                @endif
                                            </div>
                                            <div class="product-action-vertical">
                                                <!-- <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a> -->
                                            </div>
                                        </figure>
                                        <div class="Service-bottom py-3">
                                            <h3 class="title" title="{{ $popular->title }}">
                                                <a href="{{ route('product_details',$popular->slug) }}">{{ $popular->title }}</a>
                                            </h3>
                                            <div class="product-price">
                                                <ins class="new-price">৳ {{ $popular->sell_price }}</ins>
                                                @if($popular->discount)
                                                    <del class="old-price">৳ {{ $popular->regular_price }}</del>
                                                @endif
                                            </div>
                                            <div class="product-action">
                                                <a href="{{ route('add_to_cart',$popular->id) }}" class="btn-product pbtn-sm ml-0 text-capitalize rounded-pill" title="Quick View">buy now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">   
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{route('popular.product')}}" class="btn-product vbtn-sm text-capitalize" title="View More">view more<i class="fa fa-angle-double-right ml-2" aria-hidden="true"></i></a>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!--Popular Product end-->
    <!--New Feature start-->
    <div class="new_arrival_section  py-4 bg-white">
        <div class="container"> 
            <div class="row">
                <div class="col-12">   
                    <div class="categorie_banner_title">
                        <h3>Feature</h3>
                    </div>
                </div>    
            </div>
            <div class="row cat">
                <div class="categorie_banner_active owl-carousel">
                    @if ($feature->count() > 0)
                        @foreach ($feature as $key=>$fea)
                            @php
                                $stock = App\Purchase::where('product_id',$fea->id)->get();
                            @endphp
                            @if ($stock->count() > 0)
                                <div class="col-lg-3">
                                    <div class="product text-center mb-4 grey-section">
                                        <figure class="product-media mb-0">
                                            <a href="{{ route('product_details',$fea->slug) }}">
                                                <img style="width: 263px; height: 263px;" src="{{ URL::to($fea->cover_photo) }}" alt="{{ $fea->title }}">
                                            </a>
                                            <div class="product-label-group">
                                                @if($fea->discount)
                                                    <span class="product-label label-sale">{{$fea->discount}}% off</span>
                                                @endif
                                            </div>
                                            <div class="product-action-vertical">
                                                <!-- <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a> -->
                                            </div>
                                        </figure>
                                        <div class="Service-bottom py-3">
                                            <h3 class="title" title="{{ $fea->title }}">
                                                <a href="{{ route('product_details',$fea->slug) }}">{{ $fea->title }}</a>
                                            </h3>
                                            <div class="product-price">
                                                <ins class="new-price">৳ {{ $fea->sell_price }}</ins>
                                                @if($fea->discount)
                                                    <del class="old-price">৳ {{ $fea->regular_price }}</del>
                                                @endif
                                            </div>
                                            <div class="product-action">
                                                <a href="{{ route('add_to_cart',$fea->id) }}" class="btn-product pbtn-sm ml-0 text-capitalize rounded-pill" title="Buy Now">buy now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">   
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{route('feature.product')}}" class="btn-product vbtn-sm text-capitalize" title="View More">view more<i class="fa fa-angle-double-right ml-2" aria-hidden="true"></i></a>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!-- feature end  -->
    <!--Popular services start-->
    <div class="best_selling_section  py-4 grey-section ">
        <div class="container">
            <div class="row">
                <div class="col-12">   
                    <div class="categorie_banner_title">
                        <h3>Our Services</h3>
                    </div>
                </div>    
            </div>
            <div class="row cat">
                <div class="categorie_banner_active owl-carousel">
                    @foreach ($services as $key=>$service)
                        <div class="col-lg-3">
                            <div class="product text-center bg-white mb-4">
                                <figure class="product-media mb-0">
                                    <a href="{{ route('services.details', $service->slug) }}">
                                        <img style="height: 263px; width: 263px;" src="{{asset($service->image)}}" alt="product">
                                    </a>
                                </figure>
                                <div class="Service-bottom py-3">
                                    <h3 class="title mb-0 font-si" title="{{$service->title}}">
                                        <a href="{{ route('services.details', $service->slug) }}">{{$service->title}}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12">   
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{route('our.services')}}" class="btn-product vbtn-sm text-capitalize" title="View More">view more<i class="fa fa-angle-double-right ml-2" aria-hidden="true"></i></a>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!--Popular services end-->
@endsection
@push('js')
  <script>
    function wishlist_form_submit(id) {
        document.getElementById('wishlist_form_'+id).submit();
    }
  </script>
  <script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>
@endpush
