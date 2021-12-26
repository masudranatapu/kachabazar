@extends('layouts.frontend.app')

@section('title')
	{{$title}}
@endsection

@section('meta')
@php
	$website = App\Website::get()->last();
@endphp

@endsection

@push('css')

@section('content')
	<div class="breadcrumbs_area commun_bread py-3 grey-section">
		<div class="container">   
			<div class="row">
				<div class="col-12">
					<div class="breadcrumb_content">
						<ul class="text-capitalize">
							<li><a href="{{ route('home') }}">home</a></li>
							<li><i class="fa fa-angle-right"></i></li>
							<li>{{$title}}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>         
	</div>
    <div class="best_selling_section  py-4 grey-section ">
        <div class="container">
            <div class="row cat">
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
                                            <img style="width: 263px; height: 263px;" src="{{ URL::to($best->cover_photo) }}" alt="{{ $best->title }}" class="w-100">
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
    </div>
@endsection

@push('js')

@endpush