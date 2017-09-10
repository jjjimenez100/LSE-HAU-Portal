@extends('portal.portal-home')
@section('additionalcssfiles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>
    <style>
        .loadingDiv {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
            url('https://www.thestudio.com/wp-content/themes/thestudio/images/lightbox/filters-load.gif')
            50% 50%
            no-repeat;
        }

        body.loading {
            overflow: hidden;
        }

        body.loading .loadingDiv {
            display: block;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                <i class="fa fa-calendar" aria-hidden="true"></i> <strong>Manage Events</strong>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive col-md-12">
            <button class="btn btn-success" data-toggle="modal" id="btnAdd" data-target="#add"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Add New Event</button>
            <button class="btn btn-primary" style="float: right;" id="btnExport"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</button>
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
        $('#eventsManagement').addClass('active');
        initializeRoutes("{{ route('events.store') }}", "{{ route('events.update') }}", "{{ route('events.delete') }}");
    </script>
@endsection