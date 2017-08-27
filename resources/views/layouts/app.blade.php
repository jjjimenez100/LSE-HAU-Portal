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

    var USER_MODE = 1; //1 - add
    //2 - edit

    //var buttons = '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit"> <i class="fa fa-pencil-square-o" aria-hidden="true"> Update</i> </button> <br><br><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete"> <i class="fa fa-trash-o" aria-hidden="true"> Delete</i> </button>';
    var partialBtn1 = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add" id="update';
    var partialBtn2 = '"> <i class="fa fa-pencil-square-o" aria-hidden="true"> Update</i> </button> <br><br><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete" id="delete';
    var partialBtn3 = '"> <i class="fa fa-trash-o" aria-hidden="true"> Delete</i> </button>';
    var addBtnLayout = '<i class="fa fa-user-plus" aria-hidden="true"></i> Add';
    var editBtnLayout = '<i class="fa fa-floppy-o" aria-hidden="true"></i> Update';
    //cache jquery selectors
    var dataTableClasses = $.fn.dataTable.ext.classes;
    var page = $(document);
    var dataTableInstance;

    var btnDismiss = $('#btnDismiss');
    var btnSave = $('#triggerAdd');
    var modalAdd = $('#add');
    var modalSuccess = $('#success');
    var modalFailed = $('#failed');
    var editBtns = $('.edit');
    var deleteBtns = $('.delete');
    var btnAdd = $('#btnAdd');
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

    var inputCollege = $('#collegeSelect');
    var inputRole = $('#roleSelect');

    page.ready(initializeElements());

    btnSave.on('click', save);
    btnAdd.on('click', addLayout);
    btnDismiss.on('click', function(){
       modalFailed.modal('hide');
       modalAdd.modal('show');
    });
    editBtns.on('click', editLayout);
    deleteBtns.on('click', fDelete);

    inputContactNumber.on('input', validateContactNumber);
    inputPassword.on('input', validatePassword);
    inputConfirmPassword.on('input', validateConfirmPassword);
    inputName.on('input', validateName);
    inputEmail.on('input', validateEmail);

    var contactError = true;
    var passwordError = true;
    var nameError = true;
    var emailError = true;
    var confirmError = true;

    var emailGrp = $('#emailFormGrp');
    var emailGrpError = $('#emailError');
    var emailErrorText = $('#emailErrorText');

    var contactGrp = $('#contactNumberFormGrp');
    var contactGrpError = $('#contactError');
    var contactErrorText = $('#contactNumberErrorText');

    var nameGrp = $('#nameFormGrp');
    var nameGrpError = $('#nameError');
    var nameErrorText = $('#nameErrorText');

    var passwordGrp = $('#passwordFormGrp');
    var passwordGrpError = $('#passwordError');
    var passwordErrorText = $('#passwordErrorText');

    var confirmPassGrp = $('#confirmPasswordFormGrp');
    var confirmGrpError = $('#confirmPasswordError');

    var currentUserId;
    var selectedUser;
    function initializeElements(){
        btnSave.prop('disabled', true);
        dataTableClasses.sPageButton = 'btn btn-default';
        dataTableClasses.sPageButtonActive = 'btn btn-primary';
        dataTableClasses.sPageButton = 'btn btn-default';
        dataTableInstance = $('#test').DataTable({
            "dom" : '<lf<t>ip>'
        });
    }

    function save(){
        if(USER_MODE == 1){
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
                        data.id,
                        collegeOptions.eq(data.collegeID-1).val(),
                        roleOptions.eq(data.roleID-1).val(),
                        data.contactNumber,
                        data.email,
                        data.name,
                        data.created_at,
                        data.updated_at,
                        '1'
                    ]).draw(false);
                    dataTableInstance.page('last').draw(false);
                    modalAdd.modal('hide');
                    modalSuccess.modal('show');
                    var btn = partialBtn1 + data.id + partialBtn2 + data.id + partialBtn3;
                    $('#test tr:last').attr('id', data.id); //di iccache to
                    $('#test td:last').html(btn); //kasi nag uupdate everytime.
                    $('#update'+data.id).on('click', editLayout);
                    $('#delete'+data.id).on('click', fDelete);
                },
                error: function(data){
                    if(data.responseJSON.errors.contactNumber){
                        contactGrp.removeClass('has-success');
                        contactGrp.addClass('has-error');
                        contactGrpError.removeClass('hidden');
                        contactError = true;
                        contactErrorText.text(data.responseJSON.errors.contactNumber[0]);
                        isValid();
                    }

                    if(data.responseJSON.errors.email){
                        emailGrp.removeClass('has-success');
                        emailGrp.addClass('has-error');
                        emailGrpError.removeClass('hidden');
                        emailError = true;
                        emailErrorText.text(data.responseJSON.errors.email[0]);
                        isValid();
                    }
                    modalAdd.modal('hide');
                    modalFailed.modal('show');
                }
            });
        }
        else if(USER_MODE == 2){
            $.ajax({
                    type: "POST",
                    url: "{{ route('users.update') }}",
                    data: {
                        "id" : currentUserId,
                        "role" : inputRole[0].selectedIndex + 1,
                        "college" : inputCollege[0].selectedIndex + 1,
                        "contactNumber" : inputContactNumber.val(),
                        "email" : inputEmail.val(),
                        "name" : inputName.val()
                    },
                    dataType: "json",
                    success: function(data){
                        console.log(data);
                        selectedUser.find("td:eq(1)").html(collegeOptions.eq(data.collegeID-1).val());
                        selectedUser.find("td:eq(2)").html(roleOptions.eq(data.roleID-1).val());
                        selectedUser.find("td:eq(3)").html(data.contactNumber);
                        selectedUser.find("td:eq(4)").html(data.email);
                        selectedUser.find("td:eq(5)").html(data.name);
                        modalAdd.modal('hide');
                        modalSuccess.modal('show');
                    },
                    error: function(data){
                        if(data.responseJSON.errors.contactNumber){
                            contactGrp.removeClass('has-success');
                            contactGrp.addClass('has-error');
                            contactGrpError.removeClass('hidden');
                            contactError = true;
                            contactErrorText.text(data.responseJSON.errors.contactNumber[0]);
                            isValid();
                        }

                        if(data.responseJSON.errors.email){
                            emailGrp.removeClass('has-success');
                            emailGrp.addClass('has-error');
                            emailGrpError.removeClass('hidden');
                            emailError = true;
                            emailErrorText.text(data.responseJSON.errors.email[0]);
                            isValid();
                        }
                        modalAdd.modal('hide');
                        modalFailed.modal('show');
                    }
                }
            );
        }
    }

    function validateEmail(){
        if(!emailChecker.test(inputEmail.val())){
            emailGrp.removeClass('has-success');
            emailGrp.addClass('has-error');
            emailGrpError.removeClass('hidden');
            emailError = true;
        }
        else{
            removeEmailError();
            emailGrp.addClass('has-success');
            emailError = false;
        }
        isValid();
    }

    function validateName(){
        //trim spaces
        var name = inputName.val().replace(/^\s+/, "").replace(/\s+$/, "").replace(/\s+/, " ");

        if(name === ""){
            nameGrp.removeClass('has-success');
            nameGrp.addClass('has-error');
            nameGrpError.removeClass('hidden');
            nameError = true;
        }

        else{
            removeNameError();
            nameGrp.addClass('has-success');
            nameError = false;
        }
        isValid();
    }

    function validatePassword(){
        var pass = inputPassword.val();
        if(pass !== ""){
            validateConfirmPassword();
        }
        if(!passwordLength.test(pass)){
            passwordGrp.removeClass('has-success');
            passwordGrp.addClass('has-error');
            passwordGrpError.removeClass('hidden');
            passwordError = true;
            passwordErrorText.text("Minimum of 6 characters.");
        }

        else if(!passwordStrength.test(pass)){
            passwordGrp.removeClass('has-success');
            passwordGrp.addClass('has-error');
            passwordGrpError.removeClass('hidden');
            passwordError = true;
            passwordErrorText.text("Should at least contain 1 lowercase, 1 uppercase and 1 numeric character.");
        }

        else{
            removePasswordError();
            passwordGrp.addClass('has-success');
            passwordError = false;
        }
        isValid();
    }

    function validateConfirmPassword(){
        var confirmPass = inputConfirmPassword.val();
        if(confirmPass !== inputPassword.val()){
            confirmPassGrp.removeClass('has-success');
            confirmPassGrp.addClass('has-error');
            confirmGrpError.removeClass('hidden');
            confirmError = true;
        }

        else{
            removeConfirmPassError();
            confirmPassGrp.addClass('has-success');
            confirmError = false;
        }
        isValid();
    }

    function validateContactNumber(){
        var contact = inputContactNumber.val();
        if(contact.length !== 11){
            contactGrp.removeClass('has-success');
            contactGrp.addClass('has-error');
            contactGrpError.removeClass('hidden');
            contactError = true;
            contactErrorText.text("Contact numbers should be 11 digits long.");
        }

        else if(contact.charAt(0) !== '0' ||
            inputContactNumber.val().charAt(1) !== '9'){
            contactGrp.removeClass('has-success');
            contactGrp.addClass('has-error');
            contactGrpError.removeClass('hidden');
            contactError = true;
            contactErrorText.text("Contact numbers should start with 09.");
        }

        else if(!isPureDigits.test(contact.substr(2))){
            contactGrp.removeClass('has-success');
            contactGrp.addClass('has-error');
            contactGrpError.removeClass('hidden');
            contactError = true;
            contactErrorText.text("Contact numbers should consist of only digits.");
        }

        else{
            removeContactNumberError();
            contactGrp.addClass('has-success');
            contactError = false;
        }
        isValid();
    }

    function isValid(){
        if(emailError === false
            && emailError == false
            && contactError == false
            && passwordError == false
            && confirmError == false){
                btnSave.removeClass('disabled');
                btnSave.prop('disabled', false);
        }
        else{
                btnSave.addClass('disabled');
                btnSave.prop('disabled', true);
        }
    }

    function removeNameError(){
        nameGrp.removeClass('has-error');
        nameGrpError.addClass('hidden');
    }

    function removeEmailError(){
        emailGrp.removeClass('has-error');

        emailGrpError.addClass('hidden');
    }

    function removeContactNumberError(){
        contactGrp.removeClass('has-error');
        contactGrpError.addClass('hidden');
    }

    function removePasswordError(){
        passwordGrp.removeClass('has-error');
        passwordGrpError.addClass('hidden');
    }

    function removeConfirmPassError(){
        confirmPassGrp.removeClass('has-error');
        confirmGrpError.addClass('hidden');
    }

    function removeAllErrors(){
        removeNameError();
        removeConfirmPassError();
        removeContactNumberError();
        removeEmailError();
        removePasswordError();
    }

    function removeAllSuccess(){
        $('.has-success').removeClass('has-success');
    }

    function setErrorFlags(booleanValue){
        contactError = booleanValue;
        passwordError = booleanValue;
        nameError = booleanValue;
        emailError = booleanValue;
        confirmError = booleanValue;
    }

    function extractId(str){
        return str.substr(6);
    }

    function emptyInputFields(){
        inputName.val("");
        inputCollege[0].selectedIndex = 0;
        inputRole[0].selectedIndex = 0;
        inputEmail.val("");
        inputContactNumber.val("");
        inputPassword.val("");
        inputConfirmPassword.val("");
    }

    function editLayout(){

        USER_MODE = 2;
        currentUserId = extractId(this.id);
        selectedUser = $('#'+currentUserId);
        removeAllErrors();
        removeAllSuccess();
        setErrorFlags(false);
        btnSave.removeClass('disabled');
        btnSave.prop('disabled', false);

        passwordGrp.addClass('hidden');
        confirmPassGrp.addClass('hidden');

        btnSave.html(editBtnLayout);
        btnSave.removeClass('btn-success');
        btnSave.addClass('btn-primary');

        inputCollege.val(selectedUser.find("td:eq(1)").text());
        inputRole.val(selectedUser.find("td:eq(2)").text());
        inputContactNumber.val(selectedUser.find("td:eq(3)").text());
        inputEmail.val(selectedUser.find("td:eq(4)").text());
        inputName.val(selectedUser.find("td:eq(5)").text());
    }

    function fDelete(){
        var userId = extractId(this.id);
    }

    function addLayout(){
        USER_MODE = 1;

        removeAllErrors();
        removeAllSuccess();
        setErrorFlags(true);
        passwordGrp.removeClass('hidden');
        confirmPassGrp.removeClass('hidden');

        emptyInputFields();

        btnSave.addClass('disabled');
        btnSave.prop('disabled', true);
        btnSave.html(addBtnLayout);
        btnSave.removeClass('btn-primary');
        btnSave.addClass('btn-success');
    }
</script>
</body>
</html>
