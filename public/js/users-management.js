//variable declarations
//and caching jquery selectors

var inputRole = $('select[name="role"]');
var roleOptions = $('#roleSelect option');

var inputCollege = $('select[name="college"]');
var collegeOptions = $('#collegeSelect option');

var inputCollege = $('#collegeSelect');
var inputRole = $('#roleSelect');

var resetPassBtns = $('.resetPass');
var triggerResetPassword = $('#triggerResetPass');

var addBtnLayout = '<i class="fa fa-user-plus" aria-hidden="true"></i> Add';
var editBtnLayout = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update';
//attach event handlers
page.ready(initializeElements($('#tblUsers'), "LSE-HAU MEMBERS"));
btnSave.on('click', save);
btnAdd.on('click', addLayout);

editBtns.on('click', editLayout);
deleteBtns.on('click', fDelete);
resetPassBtns.on('click', resetDialog);
btnDelete.on('click', deleteUser);
triggerResetPassword.on('click', resetPassword);
modalSuccess.on('hidden.bs.modal', function(){
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
    inputRole.val("User");

    btnSave.addClass('disabled');
    btnSave.prop('disabled', true);
    btnSave.html(addBtnLayout);
    btnSave.removeClass('btn-primary');
    btnSave.addClass('btn-success');
}
