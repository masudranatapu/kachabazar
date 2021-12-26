<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
      $website = App\Website::get()->last();
    ?>
    {{-- for heder icon --}}
  @if (isset($website->favicon))
    <link rel="shortcut icon" href="{{ URL::to($website->favicon) }}" />
  @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Ecommerce') }}</title>
    {{-- for meta tag  --}}
    @yield('meta')

    {{-- for header link --}}
    @include('layouts.frontend.partial.head')

    {{-- for css input --}}
    @stack('css')

    {{-- for tostr js --}}
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

</head>
<body>
  @include('layouts.frontend.partial.header')

  @yield('content')

  @include('layouts.frontend.partial.footer')

  {{-- for footer link --}}
  @include('layouts.frontend.partial.foot')

<script src="{{ asset('js/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}','Error',{
                  closeButton:true,
                  progressBar:true,
               });
        @endforeach
    @endif
</script>

@stack('js')
</body>
</html>

