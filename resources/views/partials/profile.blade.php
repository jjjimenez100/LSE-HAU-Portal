<form role="form" class="form-horizontal" method="POST" action="{{ route('register') }}" id="addFormGrp">
    {{ csrf_field() }}

    <div class="form-group" id="nameFormGrp">
        <label for="name" class="col-sm-2 control-label">
            Name</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Full Name" name="name"  value="{{ Auth::user()->name }}" required/>
                    <span class="help-block hidden" id="nameError">
                                <strong id="nameErrorText">Please input a name.</strong>
                            </span>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group" id="collegeFormGrp">
        <label for="college" class="col-sm-2 control-label">College</label>
        <div class="col-sm-10">
            <select class="form-control" name="college" id="collegeSelect">
                @foreach($colleges as $college)
                    @if(Auth::user()->college->collegeDepartment == $college->collegeDepartment)
                        <option selected>{{ $college->collegeDepartment }}</option>
                    @else
                        <option>{{ $college->collegeDepartment }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group" id="emailFormGrp">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ Auth::user()->email }}" required/>
            <span class="help-block hidden" id="emailError">
                        <strong id="emailErrorText">Emails should at least contain both @ and . symbols.</strong>
                    </span>
        </div>
    </div>

    <div class="form-group" id="contactNumberFormGrp">
        <label for="contactNumber" class="col-sm-2 control-label">Contact Number</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="contactNumber" placeholder="Mobile (+63)" name="contactNumber" value="{{ Auth::user()->contactNumber }}"required/>
            <span class="help-block hidden" id="contactError">
                        <strong id="contactNumberErrorText"></strong>
                    </span>
        </div>
    </div>

    <div class="form-group" id="passwordFormGrp">
        <label for="password" class="col-sm-2 control-label">New Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" placeholder="New Password" name="password" required/>
            <span class="help-block hidden" id="passwordError">
                        <strong id="passwordErrorText"></strong>
                    </span>
        </div>
    </div>

    <div class="form-group" id="confirmPasswordFormGrp">
        <label for="confirm-password" class="col-sm-2 control-label">Confirm Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password_confirmation" placeholder="Re-type new password" name="password_confirmation" required/>
            <span class="help-block hidden" id="confirmPasswordError">
                        <strong id="confirmPasswordErrorText">Passwords do not match.</strong>
                    </span>
        </div>
    </div>

    <div class="form-group" id="confirmPasswordFormGrp">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <button type="button" class="btn btn-primary" id="triggerAdd">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Profile</button>
        </div>
    </div>
</form>

