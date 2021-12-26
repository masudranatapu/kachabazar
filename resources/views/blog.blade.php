@extends('layouts.frontend.app')

@section('title')
	{{$title}}
@endsection

@section('meta')
@php
	$website = App\Website::get()->last();
@endphp
   <meta name='subject' content='ecommerce's subject'>
      <meta name='title' content='{{$title}} || {{ config('app.name') }}'>
      <meta name='description' content='@if (isset($website->meta_tag)) {{$website->meta_tag}} @endif'>
      <meta name='keywords' content='@if (isset($website->meta_keyword)) {{$website->meta_keyword}} @endif'>
      <meta name='author' content='yousuf1648|projanmoit.com'>
      <meta name='copyright' content='yousuf1648|projanmoit.com'>
@endsection

@push('css')

@endpush

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
	<div class="container">
		<div class="row cat" style="margin-top: 10px;">
	        @foreach ($blogs as $blog)
				<div class="col-lg-3 col-sm-4 col-6">
					<div class="product text-center grey-section mb-4">
						<figure class="product-media mb-0">
							<a href="{{ route('blog_details',$blog->slug) }}">
								<img src="{{ Storage::disk('public')->url('blog/'.$blog->cover_photo) }}" alt="product" class="w-100">
							</a>
						</figure>
						<div class="category-bottom py-2">
							<h3 class="title mb-0" title="Gardening">
								<a href="{{ route('blog_details',$blog->slug) }}">{{str_limit($blog->title,20)}}</a>
							</h3>
							<!-- <div class="product-quantity">
								<span>10 Products</span>
							</div> -->
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endsection

@push('js')


@endpush