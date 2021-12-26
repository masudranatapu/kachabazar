@extends('layouts.frontend.app')

@section('title')
	{{$product->title}}
@endsection

@section('meta')
	<?php 
	  $website = App\Website::get()->last();
	?>
   <meta name='subject' content='ecommerce's subject'>
   <meta name='title' content='@if (isset($product->title)) {{$product->title}} @endif || {{ config('app.name') }}'>
    <meta name='description' content='@if (isset($product->meta_description)) {{$product->meta_description}} @endif'>
    <meta name='keywords' content='@if (isset($product->meta_keyword)) {{$product->meta_keyword}} @endif'>

    <meta property="og:image:url" content="{{ Storage::disk('public')->url('product/'.$product->cover_photo) }}">
    <meta property="og:title"  content="@if (isset($product->title)) {{$product->title}} @endif || {{ config('app.name') }}" />

    <meta name='author' content='yousuf1648|projanmoit.com'>
    <meta name='copyright' content='yousuf1648|projanmoit.com'>
@endsection

@push('css')
	<link rel="stylesheet" href="{{ asset('css/review.css') }}">
	<link href="{{ asset('dist/css/zoomy.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/zoom/style.css')}}">
@endpush

@section('content')

    @php 
        $related_product = App\Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->get();
    @endphp

	@include('layouts.frontend.partial.product_details')

@endsection

@push('js')
    <script src="{{asset('frontend/zoom/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/zoom/jquery.ez-plus.js')}}"></script>
    <script src="{{asset('frontend/zoom/script.js')}}"></script>
    <script src="{{ asset('dist/js/zoomy.js') }}"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61385eedbd8b385d"></script>
    <script>
        @php
        $post_image = explode("|",$product->others_photo);
        @endphp
        var urls = ['{{ Storage::disk('public')->url('product/'.$product->cover_photo) }}',
        @foreach ($post_image as $key=>$image)
            '{{ Storage::disk('public')->url('product/'.$image) }}',
        @endforeach
        ];
        var options = {
            //thumbLeft:true,
            //thumbRight:true,
            //thumbHide:true,
            //width:300,
            //height:350,
        };
        $("#el").zoomy(urls, options);
    </script>
	<script>
		function wishlist_form_submit(id) {
		    document.getElementById('wishlist_form_'+id).submit();
		}
	</script>
     <script>
        $('.btn-number').click(function(e){
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {
                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr(true);
                    }
                } else if(type == 'plus') {
                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }
                }
            } else {
                input.val(0);
            }
        });
    </script>
@endpush