/**
 * Created by Joshua on 9/1/2017.
 */

var eventNameForm = $('#eventNameFormGrp');
var eventNameError = $('#eventNameError');
var eventNameErrorText = $('#eventNameErrorText');
var eventName = $('#eventName');

var seatCountForm = $('#seatCountFormGrp');
var seatCountError = $('#seatCountError');
var seatCountErrorText = $('#seatCountErrorText');
var seatCount = $('#seatCount');

var eventDateForm = $('#eventDateFormGrp');
var eventDateError = $('#eventDateError');
var eventDateErrorText = ('#eventDateErrorText');
var eventDate = $('#eventDate');

var eventPosterForm = $('#eventPosterFormGrp');
var eventPosterError = $('#eventPosterError');
var eventPosterErrorText = $('#eventPosterErrorText');
var eventPoster = $('#eventPoster');
var file;
var nameError, seatError, dateError, posterError;
var isPureDigits = new RegExp("^[0-9]+$");
var posterPreview = $('#posterPreview');
var fileNameLabel = $('#fileName');
var routeAdd, routeUpdate, routeDelete;
var tblEvents = $('#tblEvents');
var addForm = $('#addFormGrp');

var addBtnLayout = '<i class="fa fa-calendar-check-o" aria-hidden="true"></i> Add';
var editBtnLayout = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update';

$('document').on('load', initializeElements(tblEvents));
eventPoster.on('change', function(upload){
    posterPreview.attr('src', URL.createObjectURL(upload.target.files[0])).width(200).height(150);
    fileNameLabel.text(upload.target.files[0].name);
    posterError = false;
    posterPreview.removeClass('hidden');
    fileNameLabel.removeClass('hidden');
    isValid();
});

eventName.on('input', validateEventname);
seatCount.on('input', validateSeatCount);
eventDate.on('input', validateDate);

btnSave.on('click', save);
btnAdd.on('click', addLayout);
editBtns.on('click', editLayout);
deleteBtns.on('click', fDelete);

var routeAdd, routeUpdate, routeDelete;

function initializeRoutes(rAdd, rUpdate, rDelete){
        routeAdd = rAdd;
        routeUpdate = rUpdate;
        routeDlete = rDelete;
}

function validateEventname(){
    if(eventName.val().length < 6){
        eventNameForm.removeClass('has-success');
        eventNameForm.addClass('has-error');
        eventNameError.removeClass('hidden');
        nameError = true;
    }

    else{
        removeNameError();
        eventNameForm.addClass('has-success');
        nameError = false;
    }
    isValid();
}

function removeNameError(){
    eventNameForm.removeClass('has-error');
    eventNameError.addClass('hidden');
}

function validateSeatCount(){
    var testString = seatCount.val();
    if(testString < 0 || !(isPureDigits.test(testString))){
        seatCountForm.removeClass('has-success');
        seatCountForm.addClass('has-error');
        seatCountError.removeClass('hidden');
        seatError = true;
    }

    else{
        removeSeatError();
        seatCountForm.addClass('has-success');
        seatError = false;
    }
    isValid();
}

function removeSeatError(){
    seatCountForm.removeClass('has-error');
    seatCountError.addClass('hidden');
}

function validateDate(){
    var dateString = getDateToday();

    if(!(eventDate.val() >= dateString)){
        eventDateForm.removeClass('has-success');
        eventDateForm.addClass('has-error');
        eventDateError.removeClass('hidden');
        dateError = true;
    }

    else{
        removeDateError();
        eventDateForm.addClass('has-success');
        dateError = false;
    }
    isValid();
}

function removeDateError(){
    eventDateForm.removeClass('has-error');
    eventDateError.addClass('hidden');
}

function isValid(){
    if(nameError === false
        && seatError == false
        && dateError == false
        && posterError == false){
        btnSave.removeClass('disabled');
        btnSave.prop('disabled', false);
    }
    else{
        btnSave.addClass('disabled');
        btnSave.prop('disabled', true);
    }
}

function getDateToday(){
    var dateToday = new Date();
    var month = dateToday.getMonth() + 1;
    var day = dateToday.getDate();
    return (dateToday.getFullYear()) + "-" +
        ((month < 10) ? "0" + month : month) + "-" +((day < 10) ? "0" + day : day);
}

function removeAllErrors(){
    removeNameError();
    removeSeatError();
    removeDateError();
}

function setErrorFlags(booleanValue){
    nameError = booleanValue;
    seatError = booleanValue;
    dateError = booleanValue;
    posterError = booleanValue;
}

function emptyInputFields(){
    addForm.trigger('reset');
}

function editLayout(){
    USER_MODE = 2;
    posterPreview.addClass('hidden');
    fileNameLabel.addClass('hidden');
    eventPosterError.removeClass('hidden');
    currentUserId = extractId(this.id);
    selectedUser = $('#'+currentUserId);
    removeAllErrors();
    removeAllSuccess();
    setErrorFlags(false);

    btnSave.removeClass('disabled');
    btnSave.prop('disabled', false);

    btnSave.html(editBtnLayout);
    btnSave.removeClass('btn-success');
    btnSave.addClass('btn-primary');

    eventName.val(selectedUser.find("td:eq(2)").text());
    seatCount.val(selectedUser.find("td:eq(3)").text());
    eventDate.val(selectedUser.find("td:eq(4)").text());
}

function addLayout(){
    USER_MODE = 1;
    posterPreview.addClass('hidden');
    fileNameLabel.addClass('hidden');
    eventPosterError.addClass('hidden');
    removeAllErrors();
    removeAllSuccess();
    setErrorFlags(true);
    emptyInputFields();

    btnSave.addClass('disabled');
    btnSave.prop('disabled', true);
    btnSave.html(addBtnLayout);
    btnSave.removeClass('btn-primary');
    btnSave.addClass('btn-success');
}
//
function eventsManagementAjax(requestType, url, userData, modalSelector, modalFailedSelector){
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
            if(data.responseJSON.errors.eventName){
                eventNameForm.removeClass('has-success');
                eventNameForm.addClass('has-error');
                eventNameError.removeClass('hidden');
                nameError = true;
                nameErrorText.text(data.responseJSON.errors.contactNumber[0]);
                isValid();
            }

            if(data.responseJSON.errors.seatCount){
                seatCountForm.removeClass('has-success');
                seatCountForm.addClass('has-error');
                seatCountError.removeClass('hidden');
                seatError = true;
                seatCountErrorText.text(data.responseJSON.errors.email[0]);
                isValid();
            }

            if(data.responseJSON.errors.eventDate){
                eventDateForm.removeClass('has-success');
                eventDateForm.addClass('has-error');
                eventDateError.removeClass('hidden');
                dateError = true;
                eventDateErrorText.text(data.responseJSON.errors.email[0]);
                isValid();
            }
            modalFailedSelector.modal('show');
        }
    });
}

function save(){
    if(USER_MODE == 1){
        /*file = eventPoster.prop('files')[0];
        var reader = new FileReader();
        reader.readAsText(file, 'UTF-8');
        reader.onload = upload;*/

        //var formData = new FormData($(this)[0]);
        //upload(formData);
        upload();
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

function upload(){
    //var result = event.target.result;
    //var fileName = eventPoster.prop('files')[0].name;
    var file_data = eventPoster.prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('eventName', eventName.val());
    $.ajax({
       "url": routeAdd,
        "type": 'POST',
        "data": form_data,
        "contentType" : false,
        "cache" : false,
        "processData" : false,
        "success" : function(data){
           console.log('success!');
        }
    });
}

function fDelete(){
    USER_MODE = 3;
    currentUserId = extractId(this.id);
    selectedUser = $('#'+currentUserId);
    $('#deleteMsg').html("Are you sure you want to delete <strong>" + selectedUser.find("td:eq(5)").text() + "</strong>?");
}


