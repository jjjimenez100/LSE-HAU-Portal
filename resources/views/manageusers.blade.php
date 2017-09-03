@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Manage Users</h4></div>

                    <div class="panel-body">

                        <div class="table-responsive">
                            <button class="btn btn-success" data-toggle="modal" id="btnAdd" data-target="#add"><i class="fa fa-user-plus" aria-hidden="true"></i> Add New Member</button>
                            <button class="btn btn-default" style="float: right;"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                            <br><br>
                            @include('partials.users')
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @include('partials.modals.addusers')
    @include('partials.modals.success')
    @include('partials.modals.failed')
    @include('partials.modals.delete')
    @include('partials.modals.confirmation')
@endsection

@section('additionalScriptFiles')
    @include('partials.dTablesExternalJs')
    <script type="text/javascript" src="{{ asset('js/initializeDataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/crudAndModals.js') }}"></script>
    <script src="{{ asset('js/users-management.js') }}"></script>
    <script>
        initializeRoutes("{{ route('users.store') }}", "{{ route('users.update') }}", "{{ route('users.delete') }}", "{{ route('password.email') }}");
    </script>
@endsection