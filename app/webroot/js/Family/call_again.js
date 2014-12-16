var oTable;
$(function () {

    oTable = $('#callAgain').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/people/callAgain",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
           
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });
    $('#callAgain').removeClass('display').addClass('table table-striped table-bordered');
});