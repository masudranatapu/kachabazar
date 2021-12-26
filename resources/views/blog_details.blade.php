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
							<li>{{$blog->title}}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>         
	</div>
	<section class="pad-tb-25">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<div class="thumbnail policy" style="padding: 10px;">
	            	    <img src="{{ Storage::disk('public')->url('blog/'.$blog->cover_photo) }}" width="100%" class="featured-img" />
	            	    <h4 class="blog-title" style="font-weight: 600">{{ $blog->title }}</h4>
	            	    <h5 class="post-on"><i class="fa fa-calendar-o" aria-hidden="true"></i> {{ $blog->created_at->format('M d, Y') }}</h5>
	            	    <div>
	            	    	{!! $blog->description !!}
	            	    </div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</section>
@endsection

@push('js')


@endpush