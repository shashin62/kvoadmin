var oTable;
function format(d) {
    console.log(d);
    return '<table cellpadding="2" cellspacing="0" border="0" style="">' +
            '<tr>' +
            '<td>&nbsp<b>Father</b>:' +
            '' + d['10'] + '</td>&nbsp;' +
            '<td>&nbsp<b>Mother</b>: ' +
            '' + d['11'] + '</td>&nbsp;' +
            '<td>&nbsp<b>Village</b>: ' +
            '' + d['8'] + '</td>&nbsp;' +
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
        "sAjaxSource": baseUrl + "/family/getAjaxSearch?type=" + actiontype,
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
            $('td:eq(6)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="insertUser(' + aData[1] + ', \'' + aData + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Insert</a> \n');
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
                .search(this.value)
                .draw();
    });
    $(".search_DOB").bind("change", function () {
        var table = $('#all_users').DataTable();
        table
                .column($(this).attr('custom'))
                .search(this.value)
                .draw();
    });
    
});


function insertUser(id, data)
{
    var peopleId = id;
    data = data.split(',');
    
    var peopleData = {};
    peopleData['first_name'] = data[2];
    peopleData['last_name'] = data[3];
    peopleData['phone_number'] = data[4];
    peopleData['village'] = data[8];
    peopleData['email'] = data[9];
    
    $.ajax({
        url: baseUrl + '/family/insertUser',
        dataType: 'json',
        data: {peopleid: peopleId, type: actiontype, id: user_id, gid: group_id,data: peopleData},
        type: "POST",
        success: function (response) {
            var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            setTimeout(function () {
                $('.jssuccessMessage').hide('slow');
                window.location = baseUrl + '/family/familiyGroups';
            }, 2500);
        }
    });
}