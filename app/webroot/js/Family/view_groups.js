var oTable;

$(function () {

 $('#getFamilyGroup tfoot th').each( function () {
     
     if( $(this).index() !== 0 && $(this).index() != 5) {
            var title = $('#getFamilyGroup thead th').eq( $(this).index() ).text();
            if( title == 'DOB' ) {
               $(this).html( '<input id = "date_of_birth" type="text" class="form-control dp search_DOB" type="text" placeholder="" />' ); 
            } else {
        $(this).html( '<input class="form-control" type="text" placeholder="Search" />' );
    }
     } 
     
     
        
    } );

    oTable = $('#getFamilyGroup').DataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/family/getAjaxGroups",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            console.log(aData);
            $('td:eq(5)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editFamilyGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
');
          if( roleid == 1 || userid == aData[5]) {
                $('td:eq(5)', nRow).append('<a class="delete_row btn btn-xs btn-danger" onclick="deleteFamilyGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');
            }
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {
        }
    });


    $('#getFamilyGroup').removeClass('display').addClass('table table-striped table-bordered');
    
    oTable.columns().eq( 0 ).each( function ( colIdx ) {
        if( colIdx != 0 && colIdx != 5) {
        $( 'input', oTable.column( colIdx ).footer() ).on( 'keyup change', function () {
            oTable
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    }
    } );
   
        $("#date_of_birth").datepicker({
            format: "yyyy-mm-dd",
        });
        $('.dp').on('change', function () {
            $('.datepicker').hide();
        });
       
//    $(".search_DOB").bind("change", function () {
//        var table = $('#getFamilyGroup').DataTable();
//        table
//                .column($(this).attr('custom'))
//                .search($.trim(this.value))
//                .draw();
//    });
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
                oTable.draw();
            }, 2500);


        }
    });
}
