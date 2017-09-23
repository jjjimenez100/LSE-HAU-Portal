<html>
<head>
    <title>League of Students for Excellence | Holy Angel University</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/lse-logo.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    @yield('additionalFiles')
</head>

<body>
<div class="blur-container">
    <div id="wrap">
        <header class="mainheader">
            <div class="container">
                <a href="{{ route('lse') }}"><img src="{{ asset('images/lse-logo.png') }}" width="132" height="120" style="padding: 5;"/></a>
                <a href="{{ route('lse') }}"><img src="{{ asset('images/header.png') }}" id="header-logo" height="100" style="padding: 5;"/></a>
            </div>
        </header>
        <div class="container-full">
            <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="150" style="box-shadow: 0px 2px 15px 0px rgba(0,0,0,0.55); border-radius: 0; border: 0; border-bottom: 5px solid #F39C12; background: #202020; margin: 0;">
                <div class="container">
                    <div class="container">
                        <button type="button" class="navbar-toggle" aria-expanded="false" aria-controls="navbar" data-toggle="collapse" data-target="#nav_menu">
                            <span class="glyphicon glyphicon-menu-hamburger" style="color: white;"></span><span style="color: white;"> MENU</span>
                        </button>
                    </div>
                    <div id="nav_menu" class="collapse navbar-collapse" style="transition: 0.5s ease; ">
                        <ul class="nav navbar-nav" style="font-weight: bold;">
                            <li id="HOME"><a class="main-menu" style="color: #DDD7CF;" href="{{ route('lse') }}">HOME</a></li>
                            <li id="GALLERY"><a class="main-menu" href="{{ route('gallery') }}">GALLERY</a></li>
                            <li id="EVENTS"><a class="main-menu" href="{{ route('events') }}">EVENTS</a></li>
                            <li id="ABOUT" class="dropdown"><a class="dropdown-toggle main-menu " data-toggle="dropdown" href="#">ABOUT</a>
                                <ul class="dropdown-menu">
                                              <li><a href="{{ route('birth') }}">THE BIRTH OF LSE</a></li>
                                              <li><a href="{{ route('mnv') }}">OUR MISSION AND VISION</a></li>
                                            </ul>
                            </li>
                            <li id="CONTACT"><a class="main-menu" href="{{ route('contact') }}">CONTACT</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right" style="margin: 0 15px 0 15px;">
                            @if(!Auth::check())
                                <li id="unq-btn1" class="register"><a href="#Registration" style="color: white;" class="btn btn-success" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                                <li class="hidden-block-separator hidden-xs" style="width:10px; height: 50px;"></li>
                                <li id="unq-btn2" class="login"><a href="#Login" style="color: white;" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            @else
                                @if(Auth::user()->role->role != "User")
                                    <li id="unq-btn2"><a href="{{ route('users.index') }}" style="color: white;" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Portal</a></li>
                                @else
                                    <li id="unq-btn2"><a href="{{ route('profile') }}" style="color: white;" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Portal</a></li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

    @yield('content')
    </div>
    <footer id="footer">
        <div class="container-full">
            <div class="footwrap-col-1">
                <div class="foot-row1-col1" style="color: white;">
                    <div style="height: 85%; width:auto; float: right; color: white; padding: 30px;">
                        <div style="display: inline-block; height: 100%; width: 50%;">
                            <div style="height: 25%;width:160px;"><h4><a class="footer-links" href="{{ route('contact') }}">Contact</a></h4></div>
                            <div style="height: 25%;width:160px;"><h4><a class="footer-links" href="https://www.facebook.com/lsehauofficial/" target="_blank">Like Us</a></h4></div>
                            <div style="height: 25%;width:160px;"><h4><a class="footer-links" href="https://twitter.com/LSEHAUofficial" target="_blank">Follow Us</a></h4></div>
                        </div>
                        <div style="display: inline-block; height: 100%; width: 50%;float: left;">
                            <div style="height: 25%;width:160px;"><h4><a class="footer-links" href="{{ route('lse') }}">Home</a></h4></div>
                            <div style="height: 25%;width:160px;"><h4><a class="footer-links" href="{{ route('events') }}">Events</a></h4></div>
                            <div style="height: 25%;width:160px;"><h4><a class="footer-links" href="{{ route('birth') }}">About</a></h4></div>
                            <div style="height: 25%; width:160px;"><h4><a class="footer-links" href="{{ route('gallery') }}">Gallery</a></h4></div>
                        </div>
                    </div>
                </div>
                <div class="foot-row2-col1">
                    <div style="height: auto; width:auto; float: right; margin-top: 22px; margin-right: 70px; padding: 30px;">
                        <p style="color: #999;">
                            Holy Angel University<br/> One St. Santo Rosario St, Angeles, Pampanga<br/>
                            HAU Tel. (045) 887 5748<br/>
                            lsehauofficial@gmail.com<br/>
                            <a class="ref-link" href="http://hau.edu.ph/">hau.edu.ph</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="footwrap-col-2" style="text-align: center;"><a href="{{ route('lse') }}">
                    <img src="{{ asset('images/lse-logo.png') }}" class="img-responsive" height="230" width="280" style="margin: auto; padding-top: 30px;" />
                    <img src="{{ asset('images/header.png') }}" class="img-responsive" height="120" width="280" style="margin: auto; padding-top: 30px;" />
                </a></div>


            <div class="footwrap-col-3">
                <div class="foot-row1-col3">
                    <div style="height: auto; width:auto; float: left; margin-left: 60px; color: white;">
                        <h2 style="font-family: DKChalk !important; font-size: 48px;"><span style="padding: 20px;">Follow Us</span></h2>
                        <a href="https://www.facebook.com/lsehauofficial/" target="_blank"><i class="fa fa-facebook-square" style="font-size:48px;color:white; padding: 10px;"></i></a>
                        <a href="https://twitter.com/LSEHAUofficial" target="_blank"><i class="fa fa-twitter-square" style="font-size:48px;color:white; padding: 10px;"></i></a>
                        <a href="#"><i class="fa fa-google-plus-square" style="font-size:48px;color:white; padding: 10px;"></i></a>
                        <br/>
                        @if(!Auth::check())
                            <button href="#Login" type="button" class="btn btn-transparent login" style="width: 100px;" data-toggle="modal" data-target="#myModal" >Log In</button>
                            <button href="#Registration" type="button" class="btn btn-transparent register" style="width: 100px;" data-toggle="modal" data-target="#myModal" >Sign Up</button>
                        @endif
                    </div>
                </div>
                <div class="foot-row2-col3">
                    <div style="height: auto; width:auto; float: left; margin-top: 20px; margin-left: 40px; padding: 30px;">
                        <p style="color: #999;">
                            &copy; 2017 League of Student for Excellence, An Organization<br/>Serving the Angelites for the Better. All Rights Reserved.<br/>
                            Maintained by: Jerez Orayle DESIGN<br/>
                            John Joshua Jimenez MEDIA APPLICATIONS<br/>
                            Joemel Bituin DATABASE
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </footer>
</div>
@yield('modal')
<script type="text/javascript" src=" {{ asset('js/validations.js') }}"></script>
<script>
    $('.login').each(function(){
        $(this).on('click', showLoginForm);
    });

    $('.register').each(function(){
        $(this).on('click', showRegistrationForm);
    });

    function showLoginForm(){
        $('.nav-tabs a[href="#Login"]').tab('show');
    }

    function showRegistrationForm(){
        $('.nav-tabs a[href="#Registration"]').tab('show');
    }
    var btnSave = $('#registerBtn');
    var inputEmail = $('#email');
    var inputPassword = $('#password');

    inputContactNumber.on('input', validateContactNumber);
    inputPassword.on('input', validatePassword);
    inputConfirmPassword.on('input', validateConfirmPassword);
    inputName.on('input', validateName);
    inputEmail.on('input', validateEmail);
</script>
</body>
</html>