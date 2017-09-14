@extends('layouts.app2')
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
    <section class="container-full" style=" background: repeating-linear-gradient(45deg,#DBDBDB,#DBDBDB 2px,#F0F0F0 2px,#F0F0F0 4px); text-align: center;">
        <div class="container-auto-width">
        @foreach($events as $event)
                <div class="event-cont">
                    <div class="thumbnail">
                        <img src="{{ asset($event->posterPath) }}">

                        <div class="caption">
                            <h3>{{ $event->eventName }}</h3>
                            <p>
                                Remaining Slots: {{ $seatCounts[$loop->index] }}<br>
                                Date: {{ $event->eventDate }}
                            </p>

                            @if(Auth::check())
                                @if(!empty($registered))
                                    @if($registered[$loop->index] == true)
                                        <button class="btn btn-default btn-lg" disabled>Reserved!</button>
                                    @elseif($seatCounts[$loop->index] == 0)
                                        <button class="btn btn-default btn-lg" disabled>No remaining seats available</button>
                                    @else
                                        <button class="btn btn-success btn-lg reserve" id="{{ $event->id }}" >Reserve me a seat!</button>
                                    @endif
                                @else
                                    @if($seatCounts[$loop->index] == 0)
                                        <button class="btn btn-default btn-lg" disabled>No remaining seats available</button>
                                    @else
                                        <button class="btn btn-success btn-lg reserve" id="{{ $event->id }}" >Reserve me a seat!</button>
                                        @endif
                                @endif
                            @else
                                <button class="btn btn-default btn-lg" disabled>Login to reserve your seat!</button>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('modal')
    @include('partials.LoginSignUpModal')
    @include('partials.modals.success')
    @include('partials.modals.tryagain')
    <script type="text/javascript" src="{{ asset("js/ajax.js") }}"></script>
    <script>
        $('#EVENTS').addClass('active');
        var reserveBtn = $('.reserve');
        var msg = $('#msg');
        var successModal = $('#success');
        var tryModal = $('#tryAgain');
        successModal.on('hidden.bs.modal', function(){
            window.location.reload(true);
        });
        msg.html(msg.html() + "<br><br>To cancel your registration, go to the registrations tab at the web portal.");
        reserveBtn.on('click', registerUser);

        function registerUser(){
            $.ajax({
                "type": "POST",
                "url" : "{{ route('registerevent') }}",
                "data" : {
                    "eventID" : $(this).prop('id'),
                    "userID" :  "{{ $userId }}"
                },
                "dataType" : "json",
                "success" : function(data){
                    successModal.modal('show');
                },
                "error" : function(data){
                    tryModal.modal('show');
                }
            });
        }
    </script>
@endsection

