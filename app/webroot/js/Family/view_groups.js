var oTable;
var showhof  = '';
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

    $('#getFamilyGroup tfoot th').each(function () {
        if ($(this).index() !== 0 && $(this).index() != 11 && $(this).index() != 9 && $(this).index() != 10 ) {
            var title = $('#getFamilyGroup thead th').eq($(this).index()).text();
            
            if (title == 'DOB') {
                $(this).html('<input  size="10" id = "date_of_birth" type="text" class="form-control dp search_DOB" type="text" placeholder="" />');
            } else {
                $(this).html('<input size="10"  class="form-control" type="text" placeholder="Search" />');
            }
        }
    });

    oTable = $('#getFamilyGroup').DataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
         "aoColumnDefs" : [ {
            'bSortable' : false,
            'aTargets' : [ 9,11 ]
        },{ "width": "7%", "aTargets": [8, 9,10] }],
     
        "sAjaxSource": baseUrl + "/family/getAjaxGroups?showhof="+ showhof,
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            
            $('td:eq(11)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editFamilyGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
');
          if( roleid == 1 || userid == aData[9]) {
                $('td:eq(11)', nRow).append('<a class="delete_row btn btn-xs btn-danger" onclick="deleteFamilyGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');
            }
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {
        }
    });


    $('#getFamilyGroup').removeClass('display').addClass('table table-striped table-bordered');
    
    oTable.columns().eq( 0 ).each( function ( colIdx ) {
        if( colIdx != 0 && colIdx != 6 && colIdx != 7 && colIdx != 8 ) {
        $( 'input', oTable.column( colIdx ).footer() ).on( 'keyup change', function () {
            oTable
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    }
    } );
   
        $("#date_of_birth").datepicker({
            format: "dd/mm/yyyy"
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

$('.showmy').click(function(){
     if ($(".showmy").is(':checked') == true) {
         $('.showhof').attr('checked',false);
        var myArray = {
            "showmy": true
        };

      
    } else {
       
         var myArray = {
            "showhmy": false
        };
    }
      var oTable = $("#getFamilyGroup").dataTable();
        oTable.fnReloadAjax(oTable.oSettings, myArray);
     
});


$('.showhof').click(function () {
    if ($(".showhof").is(':checked') == true) {
        $('.showmy').attr('checked',false);
        showhof = 1;

        var myArray = {
            "showhof": true
        };

      
    } else {
        
         var myArray = {
            "showhof": false
        };
    }
      var oTable = $("#getFamilyGroup").dataTable();
        oTable.fnReloadAjax(oTable.oSettings, myArray);
});


function deleteFamilyGroup(id)
{
    var result = confirm("Want to delete?");
    if (result === true) {
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
    } else {
        return;
    }
   
}
