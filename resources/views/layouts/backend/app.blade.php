<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php 
      $website = App\Website::get()->last();
    ?>
    {{-- for heder icon --}}
  @if (isset($website->favicon))
    <link rel="shortcut icon" href="{{ Storage::disk('public')->url('logo/favicon/'.$website->favicon) }}" />
  @endif
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    {{-- for meta tag  --}}
    {{-- @yield('meta') --}}

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/font-awesome.min.css')}} ">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/AdminLTE.min.css')}} ">
  <!-- AdminLTE Skins. Choose a skin from the css/skins -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/_all-skins.min.css')}} ">
  <link rel="stylesheet" href="{{asset('assets/backend/css/select2.min.css')}} ">
  <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
  {{-- for css input --}}
  @stack('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 {{-- for header --}}
   @include('layouts.backend.partial.topbar')

  <!-- Left side column. contains the logo and sidebar -->
  {{-- for side bar --}}
  @include('layouts.backend.partial.sidebar')


  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @yield('content')
</div>
  <!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2016 - {{date('Y')}} <a href="https://www.projanmoit.com/" target="blank"> Projanmo It</a>.</strong> All rights
    reserved.
</footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('assets/backend/js/jquery.min.js')}} "></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/backend/js/jquery-ui.min.js')}} "></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('assets/backend/js/bootstrap.min.js')}} "></script>
<!-- fontwesome 5 -->
<!-- Slimscroll -->
<script src="{{asset('assets/backend/js/jquery.slimscroll.min.js')}} "></script>
<!-- FastClick -->
<script src="{{asset('assets/backend/js/fastclick.js')}} "></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/backend/js/adminlte.min.js')}} "></script>
<script src="{{asset('assets/backend/js/select2.full.min.js')}} "></script>


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

