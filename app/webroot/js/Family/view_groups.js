var oTable;

$(function () {

    oTable = $('#getFamilyGroup').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/family/getAjaxGroups",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            
            $('td:eq(2)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editFamilyGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteFamilyGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {



        }
    });


    $('#getFamilyGroup').removeClass('display').addClass('table table-striped table-bordered');
});

function editFamilyGroup(id)
{
    window.location = baseUrl + '/family/details/' + id;
}

$('.addfamily').click(function(){
   var $this =  $(this);
   doFormPost(baseUrl+"/family/index?type=addnew",'{ "type":"addnew"}');
   
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
