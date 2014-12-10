var oTable;

$(function () {

// $('#getFamilyGroup tfoot th').each( function () {
//     if( $(this).index() !== 0) {
//            var title = $('#getFamilyGroup thead th').eq( $(this).index() ).text();
//        $(this).html( '<input size="7" class="form-control" type="text" placeholder="Search '+title+'" />' );
//     }
//        
//    } );

    oTable = $('#getFamilyGroup').DataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/family/getAjaxGroups",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            
            $('td:eq(6)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editFamilyGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteFamilyGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {



        }
    });


    $('#getFamilyGroup').removeClass('display').addClass('table table-striped table-bordered');
    
//    oTable.columns().eq( 0 ).each( function ( colIdx ) {
//        $( 'input', oTable.column( colIdx ).footer() ).on( 'keyup change', function () {
//            oTable
//                .column( colIdx )
//                .search( this.value )
//                .draw();
//        } );
//    } );
});

function editFamilyGroup(id)
{
    window.location = baseUrl + '/family/details/' + id;
}

$('.addfamily').click(function(){
   var $this =  $(this);
   doFormPost(baseUrl+"/family/searchPeople?type=addnew",'{ "type":"addnew"}');
   
});

function deleteFamilyGroup(id)
{
    $.ajax({
        url: baseUrl + '/family/deleteFamily',
        dataType: 'json',
        data: {gid: id},
        type: "POST",
        success: function (response) {
            var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            setTimeout(function () {
                $('.jssuccessMessage').hide('slow');
                oTable.fnDraw(true);
            }, 2500);


        }
    });
}
