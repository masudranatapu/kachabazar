@extends('layouts.frontend.app')

@section('title','Login')

@section('meta')

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
							<li>Login</li>
						</ul>
					</div>
				</div>
			</div>
		</div>         
	</div>
    <!-- customer login start -->
    <div class="customer_login">
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
               <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form login">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <p>
                                <label>Username or email <span>*</span></label>
                                <input id="login" type="text" name="login" value="{{ old('phone') ?: old('email') }}" required autofocus placeholder="Email / Phone">
                             </p>
                             <p>
                                <label>Passwords <span>*</span></label>
                                <input  id="password" type="password" class="custom_inputbox form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="current-password">
                             </p>
                            <div class="login_submit">
                                <button type="submit">login</button>
                                <label for="remember">
                                    <input id="remember" type="checkbox">
                                    Remember me
                                </label>
                                <a href="{{ route('register') }}">Create a new account !</a>
                            </div>

                        </form>
                     </div>
                </div>
                <!--login area start-->
            </div>
        </div>
    </div>
    <!-- customer login end -->
  {{-- <section class="pad-tb-25">
      <div class="container">
          <div class="row">

              <div class="col-md-4 col-md-offset-4">
                <h4 class="p-title">LOGIN</h4>
                <div class="thumbnail login" style="padding:15px;box-shadow:0 0 10px rgba(0,0,0,0.1);">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                      <div class="form-group">
                          <label>Email / Phone</label>
                          <input id="login" type="text"
                                 class="form-control {{ $errors->has('phone') || $errors->has('email') ? ' is-invalid' : '' }}"
                                 name="login" value="{{ old('phone') ?: old('email') }}" required autofocus placeholder="Email / Phone">

                          @if ($errors->has('phone') || $errors->has('email'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('phone') ?: $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                      <div class="form-group">
                          <label>Password</label>
                          <input id="password" type="password" class="custom_inputbox form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="current-password">

                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <button type="submit" class="btn btn-success btn-sm">{{ __('Login') }}</button>
                    </form>
                    <h5><i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> Forgot your password?
                      @if (Route::has('password.request'))
                          <a href="{{ route('password.request') }}">
                              click here
                          </a>
                      @endif
                    </h5>
                    <h5><i class="fa fa-info-circle text-success" aria-hidden="true"></i> If you don't have any account<a href="{{ route('register') }}"> sign up</a></h5>
                </div>
              </div>

          </div>
      </div>
  </section> --}}

@endsection

@push('js')


@endpush


