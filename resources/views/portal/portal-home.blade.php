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
        .active a{
            background: #3f4144 !important;
        }

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
                <a class="navbar-brand" href="index.html">LSE-HAU</a>
            </div>
            <!-- Top Menu Items -->

            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <br>
                    <img src="{{ asset('images/lse-logo2.png') }}" style="width: 220px;, height: 220px;" class="center-block">
                    <br>
                    <li class="active">
                        <a href="index.html"><i class="fa fa-user-circle" aria-hidden="true"></i> Member Profile</a>
                    </li>
                    <li>
                        <a href="../../../../../Documents/startbootstrap-sb-admin-3.3.7/blank-page.html"><i class="fa fa-list-ol" aria-hidden="true"></i> Event Registrations</a>
                    </li>
                    <li>
                        <a href="../../../../../Documents/startbootstrap-sb-admin-3.3.7/index-rtl.html"><i class="fa fa-sign-in" aria-hidden="true"></i> Conferencing Rooms</a>
                    </li>

                    <li>
                        <a href="../../../../../Documents/startbootstrap-sb-admin-3.3.7/index-rtl.html"><i class="fa fa-globe" aria-hidden="true"></i> Main Website</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

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
