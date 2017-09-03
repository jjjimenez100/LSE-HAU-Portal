@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>View Registrations Per Event</h4></div>

                    <div class="panel-body">

                        <div class="table-responsive">
                            @include('partials.registrations')
                        </div>
                    </div>
                </div>
            </div>
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
    </script>
@endsection