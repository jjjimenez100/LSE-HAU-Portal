@extends('layouts.app2')

@section('content')
    <section class="container-full" style=" background: repeating-linear-gradient(45deg,#DBDBDB,#DBDBDB 2px,#F0F0F0 2px,#F0F0F0 4px);">
        <!-- CAROUSEL START -->
        <div id="myCarousel" class="carousel slide carousel-default" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="{{ asset('images/lipad.jpg') }}"/>
                </div>
                <div class="item">
                    <img class="img-responsive" src="{{ asset('images/1.jpg') }}">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span style="color: #404040;" class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span style="color: #808080;" class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- CAROUSEL END -->
    </section>

    @include('partials.Banner')

    <section class="container-fluid" style="background: repeating-linear-gradient(45deg,#d4d4d4,#d4d4d4 2px,#e1e1e1 2px,#e1e1e1 4px); padding: 60px 0 60px 0;">
        <div class="container" style="text-align:center; color: #191919; width: 70%;">
            <h1>
                <img src="{{ asset('images/orig_lse_logo.png') }}" height="70" width="80" style="filter: invert(10%);"/>
                <span style="font-family: DKChalk !important; font-weight: bold; font-size: 70px; vertical-align: bottom;">About Us</span>
            </h1>
            <blockquote style="border-color: #909090; border: none;">
                <h3>
                    "The birth of <abbr title="League of Students for Excellence"><strong>LSE</strong></abbr> was unexpected. As the founder of this organization,
                    I will confess to you that I am also one of those people who were surprised of our existence.
                </h3>
                <h4 class="hidden-xxs">It all started when I received a letter from CEFA.VNIVERSITAS.HAU last October 2015 inviting me to be part of the Ab Initio VI Scholarship.
                    After series of talks about "Leading Leaders: Youth in Nation Building" and "Good Governance", Ab Initio scholars are mandated to create a Voices Analysis,
                    where our group, after series of meetings, planned to focus on two fields: Culture and Heritage and, Education."
                </h4>
                <footer>Paul Ernest D. Carreon FOUNDING PRESIDENT</footer>
            </blockquote>
            <a href="{{ route('birth') }}" class="btn btn-rd-more btn-lg">LEARN MORE</a>
        </div>
    </section>
    <div class="box-footer-end"></div>

    <!-- GALLERY PART START -->

    <section class="container-fluid"  style="background: #f29b32; color: white; text-align:center;">
        <div class="container" style="padding: 60px 0 60px 0;">
            <div class="side-container1"></div>
            <div class="side-container2"></div>
            <div class="container">
                <h1>
                    <img src="{{ asset('images/orig_lse_logo.png') }}" height="70" width="80" style="filter: invert(100%);"/>
                    <span style="font-family: DKChalk !important; font-weight: bold; font-size: 70px; vertical-align: bottom;">GALLERY</span>
                </h1>
                <hr/>
                <h4 style="padding: 30px 0 30px 0">
                    See our photos and recent activities.
                </h4>
                <a href="{{ route("gallery") }}" class="btn btn-rd-more-inverse  btn-lg" style="border-radius: 0; width: 220px; font-size: 15px;">GOTO GALLERY</a>
            </div>
        </div>
    </section>

    <div class="box-footer-end" style="background: repeating-linear-gradient(45deg,#dc7d25,#dc7d25 2px,#f29b32 2px,#f29b32 4px);"></div>

    <section class="container-full bg-cover" style="background: url('{{ asset('images/lse2.jpg') }}') no-repeat center; background-size: cover; height: 550px; ">
        <img class="cover-logo" src="{{ asset('images/lse-logo2.png') }}" height="255px" width="290px" style="opacity: 0.8; position: relative; top: 50%; left: 40%; margin-left: -550px;"/>
    </section>
@endsection

@section('modal')
    @include('partials.LoginSignUpModal')
    <script>
        $('#HOME').addClass('active');
    </script>
@endsection



