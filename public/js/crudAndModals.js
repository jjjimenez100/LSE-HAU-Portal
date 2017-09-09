/**
 * Created by Joshua on 9/3/2017.
 * mauna crud and modals
 */
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
var USER_MODE = 1;
var page = $(document);
var currentUserId;
var selectedUser;

btnDismiss.on('click', function(){
    modalFailed.modal('hide');
    modalAdd.modal('show');
});

function extractId(str){
    return str.substr(6);
}

function removeAllSuccess(){
    $('.has-success').removeClass('has-success');
}