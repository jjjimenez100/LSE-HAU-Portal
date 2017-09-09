//input fields
var inputContactNumber = $('input[name="contactNumber"]');
var inputEmail = $('input[name="email"]');
var inputPassword = $('input[name="password"]');
var inputConfirmPassword = $('input[name="password_confirmation"]');
var inputName = $('input[name="name"]');

//regex
var isPureDigits = new RegExp("^[0-9]+$");
var emailChecker = new RegExp("[^\s@]+@[^\s@]+\.[^\s@]+");
var passwordLength = new RegExp("(?=.{6,})");
var passwordStrength = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])");

//errors
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