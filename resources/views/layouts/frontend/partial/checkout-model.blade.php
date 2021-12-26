<div class="modal fade in" id="checkout" role="dialog" style="display: block;">
    <div class="modal-dialog">

      <!--Edit Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <ul class="nav nav-tabs" style="border-bottom: none;">
              <div class="row">
                  <div class="col-md-5">
                      <a data-toggle="tab" href="#register" class="cencel_btn btn btn-primary">Register</a>
                  </div>
                  <div class="col-md-7">
                      Already have an account? please <a data-toggle="tab" href="#login" class="cencel_btn btn btn-primary">Login</a>
                  </div>
              </div>
          </ul>
        </div>
        <div class="modal-body">
          <div class="tab-content">
              <div id="register" class="tab-pane active">

                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" action="http://127.0.0.1:8001/register">
                            <input type="hidden" name="_token" value="VmmJyBcKaUqpZvwOk2FCfpupWNdm9fq14bquzQjg">
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Full Name <i class="text-danger">*</i></label>

                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control" name="name" value="" required="" autofocus="">

                                                                  </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-3 col-form-label text-md-right">Phone Number <i class="text-danger">*</i></label>

                                <div class="col-md-9">
                                    <input id="phone" type="text" class="form-control" name="phone" value="" required="" autofocus="">

                                                                  </div>
                            </div>

                            <div class="form-group row">
                                <label for="district " class="col-md-3 col-form-label text-md-right">District/State <i class="text-danger">*</i></label>

                                <div class="col-md-9">
                                    <input id="district " type="text" class="form-control" name="district" value="" required="" autofocus="">

                                                                  </div>
                            </div>

                            <div class="form-group row">
                                <label for="area" class="col-md-3 col-form-label text-md-right">Area <i class="text-danger">*</i></label>

                                <div class="col-md-9">
                                 <textarea id="area" type="text" class="form-control" name="area" required="" autofocus="" rows="4"></textarea>

                                                                  </div>
                            </div>

                            <div class="form-group row">
                                <label for="postal_code" class="col-md-3 col-form-label text-md-right">Zip/Postal Code </label>

                                <div class="col-md-9">
                                    <input id="postal_code" type="text" class="form-control" name="postal_code" value="" autofocus="">

                                                                  </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">E-Mail Address </label>

                                <div class="col-md-9">
                                    <input id="email" type="email" class="form-control" name="email" value="">

                                                                  </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-right">Password <i class="text-danger">*</i></label>

                                <div class="col-md-9">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="min 6 character" required="">

                                                                  </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-right">Confirm Password <i class="text-danger">*</i></label>

                                <div class="col-md-9">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
              <div id="login" class="tab-pane">

                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" action="http://127.0.0.1:8001/login">
                            <input type="hidden" name="_token" value="VmmJyBcKaUqpZvwOk2FCfpupWNdm9fq14bquzQjg">
                            <div class="form-group row">
                                <label for="login" class="col-sm-4 col-form-label text-md-right">
                                    Phone or E-Mail
                                </label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control" name="login" value="" required="" autofocus="">

                                                                  </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required="">

                                                                  </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                                                          <a class="btn btn-link" href="http://127.0.0.1:8001/password/reset">
                                            Forgot Your Password?
                                        </a>
                                                                  </div>
                            </div>
                        </form>
                    </div>
                </div>

              </div>
          </div>


        </div>

      </div>

    </div>
  </div>
