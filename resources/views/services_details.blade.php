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
    <section class="pad-tb-25">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<div class="thumbnail policy" style="padding: 10px;">
	            	    <img src="{{asset($services->image)}}" />
	            	    <h4 class="blog-title" style="font-weight: 600">{{ $services->title }}</h4>
	            	    <h5 class="post-on"><i class="fa fa-calendar-o" aria-hidden="true"></i> {{ $services->created_at->format('M d, Y') }}</h5>
	            	    <div>
	            	    	{!! $services->details !!}
	            	    </div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</section>
@endsection

@push('js')

@endpush