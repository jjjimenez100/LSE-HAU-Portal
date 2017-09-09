@extends('portal.portal-home')

@section('additionalcssfiles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Manage Members
            </h1>
        </div>
    </div>
<div class="row">
    <div class="table-responsive col-lg-12">
        <button class="btn btn-success" data-toggle="modal" id="btnAdd" data-target="#add"><i class="fa fa-user-plus" aria-hidden="true"></i> Add New Member</button>
        <button class="btn btn-default" style="float: right;"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
        <br><br>
        @include('partials.users')
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
    <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/crudAndModals.js') }}"></script>
    <script type="text/javascript" src=" {{ asset('js/validations.js') }}"></script>
    <script src="{{ asset('js/users-management.js') }}"></script>
    <script>
        initializeRoutes("{{ route('users.store') }}", "{{ route('users.update') }}", "{{ route('users.delete') }}", "{{ route('password.email') }}");
    </script>
@endsection