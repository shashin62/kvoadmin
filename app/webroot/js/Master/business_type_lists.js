var oTable;
$(function() {

    oTable = $('#getBusinessType').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/BusinessType/getAjaxData",
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
            $('td:eq(5)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editBusinessType(' + aData[0] + ', \'' + aData[1]+ '\', \'' + aData[5] + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteBusinessType(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function(row, data) {

        },
        "fnInitComplete": function(oSettings, json) {

        }
    });
    $('#getBusinessType').removeClass('display').addClass('table table-striped table-bordered');
});

$("#addBusinessType").validate({
    errorElement: "span",
    rules: {
        'data[BusinessType][name]': {
            required: true,
            maxlength: 25
        },
        'data[BusinessType][business_nature_id]': {
            required: true
        }
    },
    messages: {
        'data[BusinessType][name]': {
            required: 'Please enter Business Type',
            maxlength: 'Length exceeds 25 charaters'
        },
        'data[BusinessType][business_nature_id]': {
            required: 'Please select Business Nature'
        }
    },
    submitHandler: function(form) {
        var queryString = $('#addBusinessType').serialize();

        $.post(baseUrl + '/BusinessType/add', queryString, function(data) {
            if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addBusinessTypeForm').toggle('slow');
                setTimeout(function() {
                    $('.jssuccessMessage').hide('slow');
                    $('.businesstypeid').val('');
                    $('.bname').val('');
                    oTable.fnDraw(true);
                }, 2500);
            }
        }, "json");
        return false;
    }
});
$(".bgButton").click(function() {
    $("#addBusinessType").submit();
    return false;
});

$('.addbusinesstype').click(function() {
    $('.businesstypeid').val('');
    $('.bname').val('');
    $('.business_nature').val('');
    $('.addBusinessTypeForm').toggle('slow');
});

function deleteBusinessType(id)
{

    $.ajax({
        url: baseUrl + '/BusinessType/delete',
        dataType: 'json',
        data: {id: id},
        type: "POST",
        success: function(response) {
            var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            setTimeout(function() {
                $('.jssuccessMessage').hide('slow');
                oTable.fnDraw(true);
            }, 2500);


        }
    });
}

function editBusinessType(id, name, nature)
{
    $.trim($('.bname').val(name));
    $('.businesstypeid').val(id);
    $('.business_nature').val(nature);
    $('.addBusinessTypeForm').show();
}

$('.bname').keyup(function() {
    if ($('.bname').val().length >= 0) {
        $('span.error').css('display', 'none');
    } else {
        $('span.error').find('.error').css('display', 'block');
    }
});