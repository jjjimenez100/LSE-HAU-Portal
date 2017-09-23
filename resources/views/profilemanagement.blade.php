@extends('portal.portal-home-user')

@section('additionalcssfiles')
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

        body.loading {
            overflow: hidden;
        }

        body.loading .loadingDiv {
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                <i class="fa fa-calendar" aria-hidden="true"></i> <strong>Profile Management</strong>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            @include('partials.profile')
        </div>

        <div class="col-md-6">
            <div class="jumbotron">
                <h1><i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i> <span class="text-danger">Attention</span></h1>
                <br>
                <p class="text-justify">In case that you would like to update your information with us, just fill up the form and click update.
                <br><br><strong>Leave the new password and confirm password inputs blank if you don't like to change your password.</strong></p>
            </div>
        </div>
    </div>

    @include('partials.modals.success')
    @include('partials.modals.failed')
@endsection

@section('additionalScriptFiles')
    <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/crudAndModals.js') }}"></script>
    <script type="text/javascript" src=" {{ asset('js/validations.js') }}"></script>
    <script>
        $('#profileManagement').addClass('active');
         contactError = false;
         passwordError = false;
         nameError = false;
         emailError = false;
         confirmError = false;
         var inputCollege = $('select[name="college"]');
        inputContactNumber.on('input', validateContactNumber);
        inputPassword.on('input', validatePassword);
        inputConfirmPassword.on('input', validateConfirmPassword);
        inputName.on('input', validateName);
        inputEmail.on('input', validateEmail);
        btnSave.on('click', updateUserProfile);
        modalSuccess.on('hide.bs.modal', function(){
            window.location.reload(true);
        });

        function updateUserProfile(){
            var values = {
                "id": "{{ Auth::user()->id }}",
                "college": inputCollege[0].selectedIndex + 1,
                "contactNumber": inputContactNumber.val(),
                "email": inputEmail.val(),
                "name": inputName.val(),
                "_method": 'PUT'
            };
            if(inputPassword.val() !== "" && inputConfirmPassword.val() !== ""){
                values["password"] = inputPassword.val();
            }

            console.log(values);
            $.ajax({
                type: "PUT",
                url: "{{ route('profile.update') }}",
                data: values,
                dataType: "json",
                success: function(data){
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
                    modalFailed.modal('show');
                }
            });
        }
    </script>
@endsection