var oTable;


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
            {"aaData": 6},
            {"aaData": 7}

        ],
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(7)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="insertUser(' + aData[1] + ', \'' + aData + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Insert</a> \n');
        },
        "rowCallback": function (row, data) {
        },
        "fnInitComplete": function (oSettings, json) {
        }
    });
    

    $('#all_users').removeClass('display').addClass('table table-striped table-bordered');

    $(".search, .search_username").bind("keyup", function () {
        var table = $('#all_users').DataTable();
        console.log($(this).attr('custom'));
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
function insertUser(id, data)
{
    var peopleId = id;
    data = data.split(',');
    
    var peopleData = {};
   
    peopleData['first_name'] = data[2];
    peopleData['last_name'] = data[3];
    peopleData['phone_number'] = data[5];
    peopleData['village'] = data[4];
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
                window.location = baseUrl + '/family/details/'+ response.group_id;
            }, 2500);
        }
    });
}