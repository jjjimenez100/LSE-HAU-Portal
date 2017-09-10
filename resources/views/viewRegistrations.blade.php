@extends('portal.portal-home')
@section('additionalcssfiles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                View Registrations
            </h2>
        </div>
    </div>
<div class="row">
    <div class="table-responsive">
        @include('partials.registrations')
    </div>
</div>



@endsection

@section('additionalScriptFiles')
    @include('partials.dTablesExternalJs')
    <script type="text/javascript" src=" {{ asset('js/initializeDataTables.js') }}"></script>
    <script>
            $('.table').each(function(){
               initializeElements($(this));
            });

            $('#eventsList').children().first().addClass('active');
            $('#tblContents').children().first().addClass('active');
    </script>
@endsection