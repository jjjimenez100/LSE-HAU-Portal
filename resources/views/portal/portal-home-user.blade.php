<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="LSE-HAU's Web Portal">
    <meta name="author" content="Joshua Jimenez">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LSE Portal</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('additionalcssfiles')
    <style>
        .navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:focus, .navbar-inverse .navbar-nav > .active > a:hover{
            background: #373d42;
        }

        div.dt-buttons {
            float: right;
        }
    </style>
</head>
<body>

    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #212529;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>

            <img class="navbar-brand" src="{{ asset('images/logo.png') }}" >
            <ul class="nav navbar-right top-nav">
                <li><a href="{{ route('lse') }}"><i class="fa fa-globe" aria-hidden="true"></i> Main Website</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-power-off"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <br>
                    <img src="{{ asset('images/lse-logo2.png') }}" style="width: 220px;, height: 220px;" class="center-block">
                    <br>

                    <li id="profileManagement">
                        <a href="{{ route('profile') }}"><strong><i class="fa fa-user" style="font-size: 125%; padding-right: 5%;"></i> Profile Management</strong></a>
                    </li>

                    <li id="viewRegistrations">
                        <a href="{{ route('individualregistrations') }}"><strong><i class="fa fa-list-ol" aria-hidden="true" style="font-size: 125%; padding-right: 5%;"></i> View Registrations</strong></a>
                    </li>

                    <li id="conferencingRooms">
                        <a href="{{ route('rtcuser') }}"><strong><i class="fa fa-video-camera" aria-hidden="true" style="font-size: 125%; padding-right: 5%;"></i> Conferencing Rooms</strong></a>
                    </li>

                    <li id="back">
                        <a href="{{ route('lse') }}"><strong><i class="fa fa-arrow-circle-left" style="font-size: 125%; padding-right: 5%;"></i> Back to Main Website</strong></a>
                    </li>

                    <li id="logout">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <strong><i class="fa fa-fw fa-power-off" style="font-size: 125%; padding-right: 5%;">
                                </i> Log Out</strong>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" style="border: 5px double #373d42;">

            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <div class="loadingDiv"><!-- Place at bottom of page --></div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('additionalScriptFiles')
</body>

</html>
