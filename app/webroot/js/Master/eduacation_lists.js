    var oTable;
$(function () {

    oTable = $('#getEducation').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/education/getAjaxData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(4)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editBloodGroup(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteBloodGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {
           
        }
    });
    $('#getEducation').removeClass('display').addClass('table table-striped table-bordered');
});

 $("#addEducation").validate({
     errorElement: "span",
      rules: {
            'data[Education][name]': {
                required: true,
                maxlength: 25
            }
        },
         messages: {
            'data[Education][name]': {
                required: 'Please enter education',
                maxlength: 'Length exceeds 25 charaters'
            }
        },
        submitHandler: function (form) {
             var queryString = $('#addEducation').serialize();

            $.post(baseUrl + '/education/add', queryString, function (data) {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addEducationForm').toggle('slow');
                setTimeout(function () {
                    $('.jssuccessMessage').hide('slow');
                   oTable.fnDraw(true);
                }, 2500);
            }, "json");
            return false;
        }
 });
$(".bgButton").click(function () {
    $("#addEducation").submit();
    return false;
});

$('.addeducation').click(function() {
     $('.educationid').val('');
    $('.addEducationForm').toggle('slow');
});

function deleteBloodGroup(id)
{

    $.ajax({
        url: baseUrl + '/education/delete',
        dataType: 'json',
        data: {id: id},
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

function editBloodGroup(id, name)
{
    $.trim($('.bname').val(name));
    $('.educationid').val(id);
   $('.addEducationForm').show();
}