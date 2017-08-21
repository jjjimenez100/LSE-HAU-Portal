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
        .has-success .control-label,
        .has-success .help-block,
        .has-success .form-control-feedback {
            color: #40bf40;
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

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/r-2.1.1/datatables.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); //JOEMEL ETO YUNG SINASABI KO HAHA

    var buttons = '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit"> <i class="fa fa-pencil-square-o" aria-hidden="true"> Update</i> </button> <br><br><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete"> <i class="fa fa-trash-o" aria-hidden="true"> Delete</i> </button>';
    //cache jquery selectors
    var dataTableClasses = $.fn.dataTable.ext.classes;
    var page = $(document);
    var dataTableInstance;

    var btnAdd = $('#triggerAdd');
    var modalAdd = $('#add');
    var modalSuccess = $('#success');
    var modalFailed = $('#failed');

    //input fields cache
    //var hasSpacesOrEmpty = new RegExp("^\s*$");

    var inputRole = $('select[name="role"]');
    var roleOptions = $('#roleSelect option');

    var inputCollege = $('select[name="college"]');
    var collegeOptions = $('#collegeSelect option');

    var inputContactNumber = $('input[name="contactNumber"]');
    var isPureDigits = new RegExp("^[0-9]+$");

    var inputEmail = $('input[name="email"]');
    var emailChecker = new RegExp("[^\s@]+@[^\s@]+\.[^\s@]+");

    var inputName = $('input[name="name"]');

    var inputPassword = $('input[name="password"]');
    var inputConfirmPassword = $('input[name="password_confirmation"]');
    var passwordLength = new RegExp("(?=.{6,})");
    var passwordStrength = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])");

    page.ready(initializeElements());
    btnAdd.on('click', add);
    inputContactNumber.on('input', validateContactNumber);
    inputPassword.on('input', validatePassword);
    inputName.on('input', validateName);
    inputEmail.on('input', validateEmail);

    function initializeElements(){
        //btnAdd.prop('disabled', true);
        dataTableClasses.sPageButton = 'btn btn-default';
        dataTableClasses.sPageButtonActive = 'btn btn-primary';
        dataTableClasses.sPageButton = 'btn btn-default';
        dataTableInstance = $('#test').DataTable({
            "dom" : '<lf<t>ip>'
        });
    }

    function add(){
        $.ajax({
            type: "POST",
            url: "{{ route('users.store') }}",
            data:{
                "role" : inputRole[0].selectedIndex + 1,
                "college" : inputCollege[0].selectedIndex + 1,
                "contactNumber" : inputContactNumber.val(),
                "email" : inputEmail.val(),
                "name" : inputName.val(),
                "password" : inputPassword.val(),
                "password_confirmation" : inputConfirmPassword.val()
            },
            dataType: "json",
            success: function(data){
                dataTableInstance.row.add([
                    //data.id,
                    data.id,
                    collegeOptions.eq(data.collegeID-1).val(),
                    roleOptions.eq(data.roleID-1).val(),
                    data.contactNumber, //problem yung college
                    data.email, //gawa ng hidden attrib
                    data.name,
                    data.created_at,
                    data.updated_at,
                    '1'
                ]).draw(false);
                dataTableInstance.page('last').draw(false);
                modalAdd.modal('hide');
                modalSuccess.modal('show');
                $('#test tr:last').attr('id', data.id); //di iccache to
                $('#test td:last').html(buttons); //kasi nag uupdate everytime.
            },
            error: function(data){
                modalAdd.modal('hide');
                modalFailed.modal('show');
            }
        })
    }

    function validateEmail(){
        if(!emailChecker.test(inputEmail.val())){
            console.log("ba mali ya ing email mu!");
            if($('#emailFormGrp').hasClass('has-success')){
                $('#emailFormGrp').removeClass('has-success');
            }
            $('#emailFormGrp').addClass('has-error');
            $('#emailError').removeClass('hidden');
            $('#emailErrorText').html("Emails should at least contain both @ and . symbols.");
        }
        else{
            $('#emailFormGrp').removeClass('has-error');
            $('#emailFormGrp').addClass('has-success');
            $('#emailError').addClass('hidden');
        }
    }

    function validateName(){
        //trim spaces
        var name = inputName.val().replace(/^\s+/, "").replace(/\s+$/, "").replace(/\s+/, " ");

        if(name === ""){
            console.log("dana empty ya");
        }
    }

    function validatePassword(){
        var pass = inputPassword.val();
        if(!passwordLength.test(pass)){
            console.log("dapat 6 characters!!");
        }

        else if(!passwordStrength.test(pass)){
            console.log("one uppercase, one lowercase, one number");
        }
    }

    function validateContactNumber(){
        var contact = inputContactNumber.val();
        if(contact.length !== 11){
            console.log("dapat 12 digits lang");
        }

        else if(contact.charAt(0) !== '0' ||
            inputContactNumber.val().charAt(1) !== '9'){
            console.log("numbers should start with 09");
        }

        else if(!isPureDigits.test(contact.substr(2))){
            console.log("should only be pure digits!");
        }
    }

</script>
</body>
</html>
