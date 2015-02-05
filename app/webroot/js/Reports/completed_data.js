var oTable;
$.fn.dataTableExt.oApi.fnReloadAjax = function (oSettings, sNewSource, myParams) {
    if (oSettings.oFeatures.bServerSide) {
        if (typeof sNewSource != 'undefined' && sNewSource != null) {
            oSettings.sAjaxSource = sNewSource;
        }
        oSettings.aoServerParams = [];
        oSettings.aoServerParams.push({"sName": "user",
            "fn": function (aoData) {
                for (var index in myParams) {
                    aoData.push({"name": index, "value": myParams[index]});
                }
            }
        });
        this.fnClearTable(oSettings);
        return;
    }
};
$(function () {

    oTable = $('#getCompletedData').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "bFilter": false,
        "sAjaxSource": baseUrl + "/report/getCompletedRecords",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
          //  $('td:eq(5)', nRow).html('<a onclick="editMissingRecords(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + ' class="edit_row btn btn-xs btn-success" onclick=""><span class="glyphicon glyphicon-edit"></span>Edit</a>');
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });
    $('#getCompletedData').removeClass('display').addClass('table table-striped table-bordered');
});

