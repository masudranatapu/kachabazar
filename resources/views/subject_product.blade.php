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
	<!-- breadcrumb start -->
	@include('layouts.frontend.partial.breadcrumb')

	<section class="cat-wise sections pad-tb-25">
	    <div class="container">
	        <div class="row">
	            <h4 class="title">{{$title}}</h4>

	            <div class="col-md-3 filter dektop">
	                {{-- for sidebar --}}
	                @include('layouts.frontend.partial.sub_sidebar')
	            </div>

	            <div class="col-md-9">
	                {{-- for product --}}
	                @include('layouts.frontend.partial.product')
	                {{$products->onEachSide(2)->links()}}
	            </div>

	            <div class="col-md-3 filter mobile">
	                {{-- for sidebar --}}
	                @include('layouts.frontend.partial.sub_sidebar')
	            </div>
	        </div>
	    </div>
	</section>
@endsection

@push('js')
	<script>
		function wishlist_form_submit(id) {
		    document.getElementById('wishlist_form_'+id).submit();
		}

	</script>
@endpush