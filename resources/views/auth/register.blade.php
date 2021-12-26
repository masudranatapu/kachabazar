@extends('layouts.frontend.app')

@section('title','Register')

@section('meta')

@endsection

@push('css')
    <style>
        .panel_bg {
            background-color: #0D7E40;
            color: white;
        }
    </style>
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
							<li>Register </li>
						</ul>
					</div>
				</div>
			</div>
		</div>         
	</div>
    <section class="pad-tb-25 mt-30">
      <div class="container">
          <div class="row">
                <div class="col-3"></div>
              <div class="col-md-6 col-md-offset-3">
                <div class="alert panel_bg">
                    <strong>
                        REGISTER
                    </strong>
                </div>
                <div class="thumbnail login" style="padding:15px;box-shadow:0 0 10px rgba(0,0,0,0.1);">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                       <div class="form-group">
                            <label>Full Name</label>
                            <input id="name" type="text" class="@error('name') is-invalid @enderror form-control" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Full Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input id="phone" type="text" class=" @error('phone') is-invalid @enderror form-control" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Phone">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror form-control" name="password" required autocomplete="new-password"
                            placeholder="Min 6 word.">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea id="address" type="text" class=" @error('address') is-invalid @enderror form-control" name="address" required autocomplete="address" autofocus placeholder="Address">{{ old('address') }}</textarea>

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-sm btn-success" value="Register">
                    </form>
                    <h5 class="mt-20">
                        <i class="fa fa-info-circle text-success" aria-hidden="true"></i>
                        If you have an account <a href="{{ route('login') }}">Login</a>
                    </h5>
                  </div>
              </div>
          </div>
      </div>
  </section>

@endsection

@push('js')


@endpush


