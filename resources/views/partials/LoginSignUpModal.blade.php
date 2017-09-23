<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><strong>Login</strong> to LSE or <strong>Sign up</strong> to Join the League!</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="tabs">
                            <li class="active"><a href="#Login" data-toggle="tab">Login</a></li>
                            <li><a href="#Registration" data-toggle="tab">Sign Up</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <br/>
                        <div class="tab-content">
                            <div class="tab-pane active" id="Login">
                                <form role="form" class="form-horizontal" method="POST" action="{{ route('login') }}" id="form-login">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') && ($errors->first('email') != "This email has already been taken.") ? ' has-error' : '' }}">
                                        <label for="emailLogin" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="emailLogin" name="email" placeholder="Email" required/>
                                            @if ($errors->has('email') && ($errors->first('email') != "This email has already been taken."))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="passwordLogin" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="Password" required/>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-success" style="width: 120px;">Login</button>
                                            <a href="{{ route('password.request') }}" style="padding-left: 15px;">Forgot your password?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="Registration">
                                <form role="form" class="form-horizontal" method="POST" action="{{ route('register') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="nameFormGrp">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Full Name" name="name" required/>
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @else
                                                        <span class="help-block hidden" id="nameError">
                                                            <strong id="nameErrorText">Please input a name.</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <label for="college" class="col-sm-2 control-label">College</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="college">
                                                @foreach($colleges as $college)
                                                    <option>{{ $college->collegeDepartment }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') && ($errors->first('email') != "These credentials do not match our records.") ? ' has-error' : '' }}" id="emailFormGrp">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required/>
                                            @if ($errors->has('email') && ($errors->first('email') != "These credentials do not match our records."))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>

                                                @else
                                                <span class="help-block hidden" id="emailError">
                                                    <strong id="emailErrorText">Emails should at least contain both @ and . symbols.</strong>
                                                </span>
                                            @endif


                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('contactNumber') ? ' has-error' : '' }}" id="contactNumberFormGrp">
                                        <label for="contactNumber" class="col-sm-2 control-label">Contact Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="contactNumber" placeholder="Mobile (+63)" name="contactNumber" required/>
                                            @if ($errors->has('contactNumber'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contactNumber') }}</strong>
                                                </span>

                                                @else
                                                <span class="help-block hidden" id="contactError">
                                                <strong id="contactNumberErrorText"></strong>
                                            </span>
                                            @endif


                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" id="passwordFormGrp">
                                        <label for="password" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required/>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>

                                                @else
                                                <span class="help-block hidden" id="passwordError">
                                                <strong id="passwordErrorText"></strong>
                                            </span>
                                            @endif


                                        </div>
                                    </div>

                                    <div class="form-group" id="confirmPasswordFormGrp">
                                        <label for="confirm-password" class="col-sm-2 control-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" name="password_confirmation" required/>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>

                                                @else
                                                <span class="help-block hidden" id="confirmPasswordError">
                                                <strong id="confirmPasswordErrorText">Passwords do not match.</strong>
                                            </span>
                                            @endif


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary" id="registerBtn">Register Account</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4"> -->
                    <!-- <div class="row text-center sign-with"> -->
                    <!-- <div class="col-md-12"> -->
                    <!-- <h3> -->
                    <!-- Sign in with</h3> -->
                    <!-- </div> -->
                    <!-- <div class="col-md-12"> -->
                    <!-- <div class="btn-group btn-group-justified"> -->
                    <!-- <a href="#" class="btn btn-primary">Facebook</a> <a href="#" class="btn btn-danger"> -->
                    <!-- Google</a> -->
                    <!-- </div> -->
                    <!-- </div> -->
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->all())
    <script>
        $('#myModal').modal('show');
        @if($errors->first('email') != "These credentials do not match our records.")
            $('.nav-tabs a[href="#Registration"]').tab('show')
        @else
            $('.nav-tabs a[href="#Login"]').tab('show')
        @endif
    </script>
@endif