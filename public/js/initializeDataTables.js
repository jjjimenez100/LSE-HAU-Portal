var dataTableClasses = $.fn.dataTable.ext.classes;
var dataTableInstance;
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