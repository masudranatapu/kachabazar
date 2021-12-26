@extends('layouts.frontend.app')

@section('title')

@endsection

@section('meta')
@php
	$website = App\Website::get()->last();
@endphp

@endsection

@push('css')

@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area commun_bread py-3 grey-section">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul class="text-capitalize">
                            <li><a href="index.html">home</a></li>
                            <li><i class="fa fa-angle-right"></i></li>
                            <li>service</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
@endsection

@push('js')

@endpush