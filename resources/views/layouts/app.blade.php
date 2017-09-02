<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('LSE-HAU') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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

        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .loadingDiv {
            display: block;
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('LSE-HAU', 'LSE-HAU') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</div>
<div class="loadingDiv"><!-- Place at bottom of page --></div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var btnDismiss = $('#btnDismiss');
    var btnClose = $('#btnClose');
    var btnSave = $('#triggerAdd');
    var modalAdd = $('#add');
    var modalSuccess = $('#success');
    var modalFailed = $('#failed');
    var modalDelete = $('#delete');
    var modalConfirm = $('#confirmation');
    var modalTryAgain = $('#tryAgain');
    var editBtns = $('.edit');
    var deleteBtns = $('.delete');
    var btnAdd = $('#btnAdd');
    var btnDelete = $('#triggerDelete');
    var dataTableClasses = $.fn.dataTable.ext.classes;
    var USER_MODE = 1;
    var page = $(document);
    var currentUserId;
    var selectedUser;
    $body = $("body");


    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });

    btnDismiss.on('click', function(){
        modalFailed.modal('hide');
        modalAdd.modal('show');
    });

    function initializeElements(tableSelector){
        dataTableClasses.sPageButton = 'btn btn-default';
        dataTableClasses.sPageButtonActive = 'btn btn-primary';
        dataTableClasses.sPageButton = 'btn btn-default';
        dataTableInstance = tableSelector.DataTable({
            "dom" : '<lf<t>ip>'
            //"dom": 'Bfrtip',
            /*buttons: [
                'excelHtml5'
            ]*/
        });
    }

    function extractId(str){
        return str.substr(6);
    }

    function removeAllSuccess(){
        $('.has-success').removeClass('has-success');
    }
</script>
@yield('additionalScriptFiles')
</body>
</html>
