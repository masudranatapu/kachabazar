 @extends('layouts.frontend.app')

@section('title')
    {{$title}}
@endsection


@section('meta')

@endsection

@push('css')
    <style>
        #info {
            cursor: pointer;
            color: #93C6F2;
        }
        #info:hover {
            color: #007bff;
        }
        .panel_bg {
            background-color: #0D7E40;
            color: white;
        }
    </style>
@endpush

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area commun_bread py-3 grey-section">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul class="text-capitalize">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li>Account Information</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->

<section class="pad-tb-25 mt-10">
    <div class="container">
        <div class="row">

            <div class="col-md-3 eng">
              @include('layouts.frontend.partial.coustomer_sidebar')
            </div>
            <div class="col-md-9">
                <div class="alert panel_bg">
                    <strong>
                        Account
                    </strong>
                </div>
                <div class="panel panel-default panel_area">
                    <div class="panel-heading">
                    <h4 style="font-size:14px;font-weight:600;"> Account Information <button class="btn btn-warning btn-xs" data-toggle="modal" style="" title="edit" data-target="#edit" class="card-edit">Edit</button></h4>
                    </div>
                    <div class="panel-body">
                        <h5><strong>Name</strong> : {{Auth::user()->name}}</h5>
                        <h5><strong>Phone</strong> : {{Auth::user()->phone}}</h5>
                        <h5><strong>Mail</strong> : {{Auth::user()->email}}</h5>
                        <h5><strong>Address</strong> : {{Auth::user()->address}}</h5>
                        <div class="row mt-20">
                            <div class="col-3">
                                <h5><strong>Change Password :</strong></h5>
                            </div>
                            <div class="col-1 pull-left">
                                <input type="checkbox" name="change_password" style="height: 20px">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="account-chage-pass" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="alert panel_bg">
                            <strong>
                                Change Password
                            </strong>
                        </div>
                    </div>
                    <div class="panel-body panel_area">
                    <div style="padding:15px;">
                        <form method="POST" action="{{ route('customer.password.update') }}" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group required-field">
                                        <label for="acc-pass2">Old Password</label>
                                        <input type="password" id="old_password" class="form-control" placeholder="Enter your old password" name="old_password">
                                    </div><!-- End .form-group -->
                                </div><!-- End .col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-group required-field">
                                        <label for="acc-pass2">New Password</label>
                                        <input type="password" id="password" class="form-control" placeholder="Enter your new password" name="password">
                                    </div><!-- End .form-group -->
                                </div><!-- End .col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-group required-field">
                                        <label for="acc-pass3">Confirm Password</label>
                                        <input type="password" id="confirm_password" class="form-control" placeholder="Enter your new password again" name="password_confirmation">
                                    </div><!-- End .form-group -->
                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->
                        </form>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- edit Modal -->
<div class="modal fade" id="edit" role="dialog" style="z-index: 10000;">
  <div class="modal-dialog">

    <!--Edit Modal content-->
    <div class="modal-content">
     <form action="{{ route('customer.profile.update') }}" method="POST"  >
        @csrf
        @method('PUT')

      <div class="modal-header">
        <h4 class="modal-title text-left">Edit account information </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body clearfix">

        <div class="col-md-12">
            <div class="form-group required-field">
                <label for="acc-pass2">Name</label>
                <input type="text" id="name" class="form-control" required placeholder="Full Name" name="name" value="{{Auth::user()->name}}">
            </div><!-- End .form-group -->
        </div><!-- End .col-md-6 -->

        <div class="col-md-12">
            <div class="form-group required-field">
                <label for="acc-pass2">Phone </label>
                <input required type="text" id="phone" class="form-control" placeholder="Phone Number" name="phone" value="{{Auth::user()->phone}}">
            </div><!-- End .form-group -->
        </div><!-- End .col-md-12 -->

        <div class="col-md-12">
            <div class="form-group required-field">
                <label for="acc-pass2">Email</label>
                <input required type="text" id="email" class="form-control" placeholder="Email" name="email" value="{{Auth::user()->email}}">
            </div><!-- End .form-group -->
        </div><!-- End .col-md-12 -->

        <div class="col-md-12">
            <div class="form-group required-field">
                <label for="acc-pass2">Address</label>
                <textarea required id="address" class="form-control" placeholder="Address" name="address" rows="4">{{Auth::user()->address}}</textarea>
            </div><!-- End .form-group -->
        </div><!-- End .col-md-12 -->

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
      </div>
    </form>
    </div>

  </div>
</div> {{-- model end --}}

@endsection

@push('js')
  <script>
    jQuery(document).ready(function($) {
      $('#account-chage-pass').hide();

      $('input[type=checkbox][name=change_password]').on('click', function(event) {
        if(this.checked)
        {
            $('#account-chage-pass').show();
        }
        else
        {
            $('#account-chage-pass').hide();
        }
      });
    });
  </script>

@endpush
