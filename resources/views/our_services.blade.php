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
							<li>Service Details</li>
							<li><i class="fa fa-angle-right"></i></li>
							<li>{{$title}}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>         
	</div>
    <div class="best_selling_section  py-4">
        <div class="container">
            <div class="row cat">
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
    </div>
@endsection

@push('js')

@endpush