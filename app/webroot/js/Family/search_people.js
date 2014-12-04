var oTable;

$(function () {

    oTable = $('#all_users').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/family/getAjaxSearch",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(1)',nRow).html('<span title="Father: ' + aData[6]+ ',Mother : ' + aData[7] +'">' + aData[1] + '</span>');
            $('td:eq(4)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editBloodGroup(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Insert</a> \n');
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });


    $('#all_users').removeClass('display').addClass('table table-striped table-bordered');
    
    $(".search, .search_username").bind("keyup", function(){
	var table = $('#all_users').DataTable();
			table
                .column( $(this).attr('custom') )
                .search( this.value )
                .draw();
	
	
	});
});
