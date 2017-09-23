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
							<form class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-sm-3" for="email">Old Password</label>
									<div class="col-sm-9">
										    <input type="password" class="form-control" id="old_password" placeholder="Old Password"/>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3" for="new_password">New Password</label>
									<div class="col-sm-9">
										    	<input type="password" class="form-control" id="new_password" placeholder="New Password"/>
									</div>
									 	</div>
								<div class="form-group">
									<label class="control-label col-sm-3" for="retype_new_password">Retype New Password</label>
									<div class="col-sm-9">
										    	<input type="password" class="form-control" id="retype_new_password" placeholder="Retype New Password"/>
									</div>
									 	</div>
								<button type="submit" class="btn btn-success">Finish</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	@endsection