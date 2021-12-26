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
							<li>Contact Us</li>
						</ul>
					</div>
				</div>
			</div>
		</div>         
	</div>
	<section id="contact" class="pad-tb-75 mt-10">
		<div class="container">
	    	<div class="row">
	        	<div class="col-md-6">
	            	<div class="thumbnail">
	                	<form action="{{ route('contuct_form') }}" method="post">
	                		@csrf
	                		
	                    	<div class="form-group">
	                        	<label>Your Name</label>
	                            <input type="text" required name="name" class="form-control" placeholder="Your Name">
	                            <div class="border"></div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-md-6">
	                            	<div class="form-group">
	                                    <label>Your Email</label>
	                                    <input type="email" required name="email" class="form-control" placeholder="Your Email">
	                                    <div class="border"></div>
	                                </div>
	                            </div>
	                            <div class="col-md-6">
	                            	<div class="form-group">
	                                    <label>Your Phone</label>
	                                    <input type="text" required name="phone" class="form-control" placeholder="Your Phone">
	                                    <div class="border"></div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label for="form-message">Message</label>
	                            <textarea required  name="message" class="form-control" placeholder="Write Your Message" id="exampleFormControlTextarea1" rows="6"></textarea>
	                        </div>
	                        <input type="submit" class="btn btn-success mb-20" value="Send">
	                    </form>
	                </div>
	            </div>
	            <div class="col-md-6">
	            	<h4 style="font-weight:600;"><i class="fa fa-home" aria-hidden="true"></i> Registered Office (BANGLADESH) </h4>
	                <h5><i class="fa fa-map-marker" aria-hidden="true"></i> Address :<strong>{{$website->address}}</strong></h5>
	                <h5><i class="fa fa-envelope-open-o" aria-hidden="true"></i> Send email :<strong>{{$website->email}}</strong></h5>
	                <h5><i class="fa fa-phone" aria-hidden="true"></i> Call us on :<strong>{{$website->phone}}</strong></h5>
	            </div>
	        </div>
	    </div>
	</section>
    
@endsection

@push('js')


@endpush