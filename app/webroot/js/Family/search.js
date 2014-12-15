var oTable;
function format(d) {
    
    return '<table cellpadding="2" cellspacing="0" border="0" style="">' +
            '<tr>' +
            '<td>&nbsp<b>Father</b>:' +
            '' + d['10'] + '</td>&nbsp;' +
            '<td>&nbsp<b>Mother</b>: ' +
            '' + d['11'] + '</td>&nbsp;' +
            '<td>&nbsp<b>Village</b>: ' +
            '' + d['4'] + '</td>&nbsp;' +
            '<td>&nbsp<b>Email</b>: ' +
            '' + d['9'] + '</td>' +
            '</tr>' +
            '</table>';
}
$(function () {
    oTable = $('#all_users').DataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/family/getAjaxSearch?type=global",
        "columns": [
            {
                "className": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            {"aaData": 1},
            {"aaData": 2},            
            {"aaData": 3},
            {"aaData": 4},
            {"aaData": 5},
            {"aaData": 6}

        ],
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            //$('td:eq(7)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="insertUser(' + aData[1] + ', \'' + aData + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Insert</a> \n');
        },
        "rowCallback": function (row, data) {
        },
        "fnInitComplete": function (oSettings, json) {
        }
    });
    $('#all_users tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');

        var row = oTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('#all_users').removeClass('display').addClass('table table-striped table-bordered');

    $(".search, .search_username").bind("keyup", function () {
        var table = $('#all_users').DataTable();
        table
                .column($(this).attr('custom'))
                .search($.trim(this.value))
                .draw();
    });
    $(".search_DOB").bind("change", function () {
        var table = $('#all_users').DataTable();
        table
                .column($(this).attr('custom'))
                .search($.trim(this.value))
                .draw();
    });
    
});
