//variable declarations
//and caching jquery selectors

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

var resetPassBtns = $('.resetPass');
var triggerResetPassword = $('#triggerResetPass');

var addBtnLayout = '<i class="fa fa-user-plus" aria-hidden="true"></i> Add';
var editBtnLayout = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update';
//attach event handlers
page.ready(initializeElements($('#tblUsers')));
btnSave.on('click', save);
btnAdd.on('click', addLayout);
btnDismiss.on('click', function(){
    modalFailed.modal('hide');
    modalAdd.modal('show');
});

editBtns.on('click', editLayout);
deleteBtns.on('click', fDelete);
resetPassBtns.on('click', resetDialog);
btnDelete.on('click', deleteUser);
triggerResetPassword.on('click', resetPassword);
btnClose.on('click', function(){
    window.location.reload(true);
});

//input validation
inputContactNumber.on('input', validateContactNumber);
inputPassword.on('input', validatePassword);
inputConfirmPassword.on('input', validateConfirmPassword);
inputName.on('input', validateName);
inputEmail.on('input', validateEmail);

var routeAdd, routeUpdate, routeDelete, routeReset;

function resetPassword(){
    modalConfirm.modal('hide');
    var userEmail = selectedUser.find("td:eq(4)").text();
    $.ajax({
        "type": 'POST',
        "datatype": 'JSON',
        "url" : routeReset,
        "data" : {
            'email' : userEmail
        },
        "success": function(data){
            modalSuccess.modal('show');
        },
        "error": function(data){
            modalTryAgain.modal('show');
        }
    }
    );
}

function resetDialog(){
    currentUserId = extractId(this.id);
    selectedUser = $('#'+currentUserId);
    $('#resetPassName').text(selectedUser.find("td:eq(5)").text());
}

function initializeRoutes(rAdd, rUpdate, rDelete, rReset){
    routeAdd = rAdd;
    routeUpdate = rUpdate;
    routeDelete = rDelete;
    routeReset = rReset;
}

function save(){
    if(USER_MODE == 1){
        usersManagementAjax("POST", routeAdd, {
            "role" : inputRole[0].selectedIndex + 1,
            "college" : inputCollege[0].selectedIndex + 1,
            "contactNumber" : inputContactNumber.val(),
            "email" : inputEmail.val(),
            "name" : inputName.val(),
            "password" : inputPassword.val(),
            "password_confirmation" : inputConfirmPassword.val()
        }, modalAdd, modalFailed);
    }

    else if(USER_MODE == 2){
        usersManagementAjax("PUT", routeUpdate, {
            "id" : currentUserId,
            "role" : inputRole[0].selectedIndex + 1,
            "college" : inputCollege[0].selectedIndex + 1,
            "contactNumber" : inputContactNumber.val(),
            "email" : inputEmail.val(),
            "name" : inputName.val(),
            "_method": 'PUT'
        }, modalAdd, modalFailed);
    }
}

function deleteUser(){
    usersManagementAjax("DELETE", routeDelete, {
        "id": currentUserId,
        "_method": 'DELETE'
    }, modalDelete, modalTryAgain);
}

function usersManagementAjax(requestType, url, userData, modalSelector, modalFailedSelector){
    modalSelector.modal('hide');
    $.ajax({
        type: requestType,
        url: url,
        data: userData,
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
            modalFailedSelector.modal('show');
        }
    });
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

function setErrorFlags(booleanValue){
    contactError = booleanValue;
    passwordError = booleanValue;
    nameError = booleanValue;
    emailError = booleanValue;
    confirmError = booleanValue;
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
    USER_MODE = 3;
    currentUserId = extractId(this.id);
    selectedUser = $('#'+currentUserId);
    $('#deleteMsg').html("Are you sure you want to delete <strong>" + selectedUser.find("td:eq(5)").text() + "</strong>?");
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
