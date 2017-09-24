@extends('layouts.app2')
@section('content')
    <section class="container-full" style=" background: repeating-linear-gradient(45deg,#DBDBDB,#DBDBDB 2px,#F0F0F0 2px,#F0F0F0 4px);">
        <div class="container">
            <div class="row" style="margin: 50px 0 140px 0;">
                <div class="col-md-8 col-centered" style="text-align:left; background: white; border-radius: 10px; box-shadow: 0px 2px 15px 0px rgba(0,0,0,0.55)">
                    <div class="progress" style="margin: 0 -15px 0 -15px; border-radius: 0; height: 10px;">
                          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="99"
                                 aria-valuemin="0" aria-valuemax="100" style="width:99%"></div>
                    </div>
                    <div class="container-fluid">
                        <h3>Account Recovery</h3><hr/>
                        <div class="pass-container" style="margin: 60px 40px 100px 40px; text-align: center;">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-3" for="email">Email Address</label>
                                    <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" required/>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-3" for="password">New Password</label>
                                    <div class="col-sm-9">
                                            	<input type="password" class="form-control" id="password" name="password" placeholder="New Password" required/>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                     	</div>

                                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-3" for="password-confirm">Retype New Password</label>
                                    <div class="col-sm-9">
                                            	<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Retype New Password"/>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                     	</div>
                                <button type="submit" class="btn btn-success">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection