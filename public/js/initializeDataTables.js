var dataTableClasses = $.fn.dataTable.ext.classes;
var dataTableInstance;
function initializeElements(tableSelector, fileName){
    dataTableClasses.sPageButton = 'btn btn-default';
    dataTableClasses.sPageButtonActive = 'btn btn-primary';
    dataTableClasses.sPageButton = 'btn btn-default';
    dataTableInstance = tableSelector.DataTable({
        //"dom" : '<lf<t>ip>'
        "dom": 'B<lf<t>ip>',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<button class="btn btn-default hidden">Export to Excel</button>',
                title: fileName +" "+ new Date().toISOString().slice(0, 10)
            }
         ]
    });
}

$('#btnExport').on('click', function(){
    $('.buttons-html5').trigger('click');
});