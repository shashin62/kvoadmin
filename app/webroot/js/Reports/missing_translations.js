var oTable;
$(function () {

    oTable = $('#getTranslations').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/report/getReportsData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
           
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });
    $('#getTranslations').removeClass('display').addClass('table table-striped table-bordered');
});
