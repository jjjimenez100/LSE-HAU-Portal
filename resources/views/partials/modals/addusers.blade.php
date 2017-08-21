<div class="modal fade" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                     User Information</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" method="POST" action="{{ route('register') }}" id="addFormGrp">
                    {{ csrf_field() }}

                    <div class="form-group" id="nameFormGrp">
                        <label for="name" class="col-sm-2 control-label">
                            Name</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Full Name" name="name" required/>
                                    <span class="help-block hidden" id="nameError">
                                <strong id="nameErrorText"></strong>
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
                                    <option>{{ $college->collegeDepartment }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="roleFormGrp">
                        <label for="college" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="role" id="roleSelect">
                                @foreach($roles as $role)
                                    <option>{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="emailFormGrp">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required/>
                            <span class="help-block hidden" id="emailError">
                        <strong id="emailErrorText"></strong>
                    </span>
                        </div>
                    </div>

                    <div class="form-group" id="contactNumberFormGrp">
                        <label for="contactNumber" class="col-sm-2 control-label">Contact Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="contactNumber" placeholder="Mobile (+63)" name="contactNumber" required/>
                            <span class="help-block hidden" id="emailError">
                        <strong id="emailErrorText"></strong>
                    </span>
                        </div>
                    </div>

                    <div class="form-group" id="passwordFormGrp">
                        <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required/>
                            <span class="help-block hidden" id="passwordError">
                        <strong id="passwordErrorText"></strong>
                    </span>
                        </div>
                    </div>

                    <div class="form-group" id="confirmPasswordFormGrp">
                        <label for="confirm-password" class="col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation" required/>
                            <span class="help-block hidden" id="confirmPasswordError">
                        <strong id="confirmPasswordErrorText"></strong>
                    </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success disabled" id="triggerAdd">
                    <i class="fa fa-user-plus" aria-hidden="true"></i> Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i> Close</button>
            </div>
        </div>
    </div>
</div>