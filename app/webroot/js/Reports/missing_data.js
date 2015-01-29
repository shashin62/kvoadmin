var oTable;
$(function () {

    oTable = $('#getMissingData').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/report/getMissingRecords",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(4)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick=""><span class="glyphicon glyphicon-edit"></span>Edit</a>');
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });
    $('#getMissingData').removeClass('display').addClass('table table-striped table-bordered');
});
