@extends('layouts.app2')

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
                                    @else
                                        <button class="btn btn-success btn-lg reserve" id="{{ $event->id }}" >Reserve me a seat!</button>
                                    @endif
                                @else
                                    <button class="btn btn-success btn-lg reserve" id="{{ $event->id }}" >Reserve me a seat!</button>
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
                    "userID" :  "{{ Auth::user()->id }}"
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

