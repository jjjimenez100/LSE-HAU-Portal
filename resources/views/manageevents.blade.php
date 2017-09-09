@extends('portal.portal-home')
@section('additionalcssfiles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Manage Events
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive col-lg-12">
            <button class="btn btn-success" data-toggle="modal" id="btnAdd" data-target="#add"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Add New Event</button>
            <button class="btn btn-default" style="float: right;"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
            <br><br>
            @include('partials.events')
        </div>
    </div>

    @include('partials.modals.addevents')
    @include('partials.modals.success')
    @include('partials.modals.failed')
    @include('partials.modals.deleteevents')
@endsection

@section('additionalScriptFiles')
    @include('partials.dTablesExternalJs')
    <script type="text/javascript" src="{{ asset('js/initializeDataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/crudAndModals.js') }}"></script>
    <script type="text/javascript" src=" {{ asset('js/validations.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/events-management.js') }}"></script>
    <script>
        initializeRoutes("{{ route('events.store') }}", "{{ route('events.update') }}", "{{ route('events.delete') }}");
    </script>
@endsection