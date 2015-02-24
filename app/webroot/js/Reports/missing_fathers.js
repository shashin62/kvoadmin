var oTable;
$(function () {

    oTable = $('#getMissingData').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/report/getMissingFathers",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(5)', nRow).html('<a onclick="editMissingRecords(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + ' class="edit_row btn btn-xs btn-success" onclick=""><span class="glyphicon glyphicon-edit"></span>Edit</a>');
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });
    $('#getMissingData').removeClass('display').addClass('table table-striped table-bordered');
});

function editMissingRecords(id, groupid)
{
    window.location.href = baseUrl + '/family/details/' + groupid;
}