$(function () {

    var oTable = $('#getVillages').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/village/getAjaxData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(4)', nRow).html('<a class="edit_row btn btn-xs btn-success" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {
            $('.edit_row').click(function () {
                console.log($(this).data('rowid'));
            });

            $('.delete_row').click(function () {
                $.ajax({
                    url: baseUrl + '/village/delete',
                    dataType: 'json',
                    data: {id: $(this).data('rowid')},
                    type: "POST",
                    success: function (response) {
                        oTable.fnDraw(true);
                    }
                });
            });
        }
    });
    $('#getVillages').removeClass('display').addClass('table table-striped table-bordered');
});