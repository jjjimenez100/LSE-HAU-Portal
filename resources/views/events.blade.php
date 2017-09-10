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

                            <button class="btn btn-default btn-lg" disabled>Reserved!</button>
                            <button class="btn btn-success btn-lg">Reserve me a seat!</button>
                            <button class="btn btn-default btn-lg" disabled>Login to reserve your seat!</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('modal')
    @include('partials.LoginSignUpModal')
    <script>
        $('#EVENTS').addClass('active');
    </script>
@endsection

