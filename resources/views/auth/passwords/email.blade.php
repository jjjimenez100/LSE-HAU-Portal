@extends('layouts.app2')
@section('content')
	<section class="container-full" style=" background: repeating-linear-gradient(45deg,#DBDBDB,#DBDBDB 2px,#F0F0F0 2px,#F0F0F0 4px);">
		<div class="container">
			<div class="row" style="margin: 50px 0 140px 0;">
				<div class="col-md-8 col-centered" style="text-align:left; background: white; border-radius: 10px; box-shadow: 0px 2px 15px 0px rgba(0,0,0,0.55)">
					<div class="progress" style="margin: 0 -15px 0 -15px; border-radius: 0; height: 10px;">
						  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
							     aria-valuemin="0" aria-valuemax="100" style="width:50%"></div>
					</div>
					<div class="container-fluid">
						<h3>Account Recovery</h3><hr/>
						<div class="email-container" style="margin: 60px 40px 100px 40px; text-align: center;">
							@if (session('status'))
								<div class="alert alert-success">
									{{ session('status') }}
								</div>
							@endif
							<form method="POST" action="{{ route('password.email') }}">
								{{ csrf_field() }}
								  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="email">Let's find your account! Please enter your email below.</label><br/>
									    <input type="email" class="form-control" id="email" name="email" placeholder="Email" style="width: 500px; margin: auto;" value="{{ old('email') }}"/>
									@if ($errors->has('email'))
										<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
									@endif
								</div>
								  <button type="submit" class="btn btn-default">Send Password Reset Link</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
@endsection

@section('modal')
	@include('partials.modals.success')
	@include('partials.modals.tryagain')
	@include('partials.LoginSignUpModal')
@endsection