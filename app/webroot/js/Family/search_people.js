var oTable;
function format ( d ) {
    
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Father:</td>'+
            '<td>'+d['7'] +'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Mother:</td>'+
            '<td>'+d['8']+'</td>'+
        '</tr>'+
    '</table>';
}

$(function () {

    oTable = $('#all_users').DataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/family/getAjaxSearch",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "aaData": 1 },
            { "aaData":2 },
            { "aaData": 3 },
            {"aaData" : 4},
            {"aaData" : 5}
            
        ],
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
          
            $('td:eq(5)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="insertUser(' + aData[1] + ', \'' + aData + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Insert</a> \n');
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });
 $('#all_users tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        
        var row = oTable.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

    $('#all_users').removeClass('display').addClass('table table-striped table-bordered');
    
    $(".search, .search_username").bind("keyup", function(){
	var table = $('#all_users').DataTable();
			table
                .column( $(this).attr('custom') )
                .search( this.value )
                .draw();
	
	
	});
       
});


function insertUser(id, data)
{
    var peopleId = id;
    
     $.ajax({
        url: baseUrl + '/family/insertUser',
        dataType: 'json',
        data: {peopleid: peopleId,type: actiontype,id:user_id,gid: group_id},
        type: "POST",
        success: function (response) {
            var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            setTimeout(function () {
                $('.jssuccessMessage').hide('slow');
                window.location = baseUrl + 'family/details/4';
            }, 2500);
        }
    });
}