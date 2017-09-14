@extends('portal.portal-home-user')

@section('additionalcssfiles')
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
                <i class="fa fa-calendar" aria-hidden="true"></i> <strong>Profile Management</strong>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            @include('partials.profile')
        </div>

        <div class="col-md-6">
            <div class="jumbotron">
                <h1><i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i> <span class="text-danger">Attention</span></h1>
                <br>
                <p>In case that you change your mind on cancelling  your reservation on our event, you can simply go back to the main page and reserve again (Given that the remaining seats are not yet 0).</p>
            </div>
        </div>
    </div>

    @include('partials.modals.success')
    @include('partials.modals.failed')
@endsection

@section('additionalScriptFiles')
    <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
    <script>


        modalSuccess.on('hide.bs.modal', function(){
            window.location.reload(true);
        });
        function cancelRegistration(){
            $.ajax({
                "type": "DELETE",
                "url" : "{{ route('deleteregistration') }}",
                "data" : {
                    "id" : $(this).prop('id')
                },
                "dataType" : "JSON",
                "success" : function(data){
                    modalSuccess.modal('show');
                },
                "error" : function(data){
                    modalTryAgain.modal('show');
                }
            })
        }
    </script>
@endsection