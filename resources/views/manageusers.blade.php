@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Manage Users</h4></div>

                    <div class="panel-body">

                        <div class="table-responsive">
                            <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fa fa-user-plus" aria-hidden="true"></i> Add New User</button>
                            <button class="btn btn-default" style="float: right;"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                            <br><br>
                            @include('partials.users')
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>EDIT GOES HERE&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="background-color: green">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" >Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

   @include('partials.modals.addusers')
    @include('partials.modals.success')
    @include('partials.modals.failed')

@endsection