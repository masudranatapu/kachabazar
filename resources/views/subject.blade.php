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
	<section class="categories pad-tb-25">
	    <div class="container">
	        <div class="row">
	            @foreach ($subjects as $subject)
	            	<div class="col-md-2">
	            		<div class="thumbnail">
	            			<a href="{{ route('subject_cat',$subject->slug) }}">
	            				<img src="@if ($subject->image=='default.png')
	            				../../../images/subject.jpeg @else {{ Storage::disk('public')->url('subject/'.$subject->image) }} @endif">
	            				<h4 align="center">{{$subject->name}}</h4>
	            			</a>
	            		</div>
	            	</div>
	            @endforeach
	        </div>
	        {{$subjects->onEachSide(2)->links()}}
	    </div>
	</section>
@endsection

@push('js')


@endpush