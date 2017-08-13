@extends('layouts.app2')

@section('content')
    <section class="container-full" style=" background: repeating-linear-gradient(45deg,#DBDBDB,#DBDBDB 2px,#F0F0F0 2px,#F0F0F0 4px); text-align: center;">
        <div class="container-auto-width">

            <div class="event-cont1">

                <div class="thumbnail">
                    <img src="..." alt="picture mo picture ko picture nating lahat" height="200" width="242">
                    <div class="caption">
                        <h3>Event #1</h3>
                        <p>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                        </p>
                        <h1><a href="#" class="btn btn-success btn-lg" role="button" style="width: 130px;">JOIN!</a></h1>
                    </div>
                </div>

            </div>

            <div class="event-cont2">

                <div class="thumbnail">
                    <img src="..." alt="picture nya naman bes" height="200" width="242">
                    <div class="caption">
                        <h3>Event #2</h3>
                        <p>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                        </p>
                        <h1><a href="#" class="btn btn-success btn-lg" role="button" style="width: 130px;">JOIN!</a></h1>
                    </div>
                </div>

            </div>

            <div class="event-cont3">


                <div class="thumbnail">
                    <img src="..." alt="picture ni crush" height="200" width="242">
                    <div class="caption">
                        <h3>Event #3</h3>
                        <p>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                            Blah<br/>
                        </p>
                        <h1><a href="#" class="btn btn-success btn-lg" role="button" style="width: 130px;">JOIN!</a></h1>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

@section('modal')
    @include('partials.LoginSignUpModal')
    <script>
        $('#EVENTS').addClass('active');
    </script>
@endsection

