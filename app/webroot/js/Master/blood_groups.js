var oTable;

$(function () {

    oTable = $('#getBloodGroup').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/BloodGroup/getAjaxData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(4)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editBloodGroup(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteBloodGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {



        }
    });


    $('#getBloodGroup').removeClass('display').addClass('table table-striped table-bordered');
});

$("#addBloodGroup").validate({
    errorElement: "span",
    rules: {
        'data[BloodGroup][name]': {
            required: true,
            maxlength: 25
        }
    },
    messages: {
        'data[BloodGroup][name]': {
            required: 'Please enter blood group',
            maxlength: 'Length exceeds 25 charaters'
        }
    },
    submitHandler: function (form) {
        var queryString = $('#addBloodGroup').serialize();

        $.post(baseUrl + '/BloodGroup/add', queryString, function (data) {
            if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addBgroupForm').toggle('slow');
                setTimeout(function () {
                    $('.jssuccessMessage').hide('slow');
                     $('.bloodgroupid').val('');
                    $('.bname').val('');
                    oTable.fnDraw(true);
                }, 2500);
            }
        }, "json");
        return false;
    }
});
$(".bgButton").click(function () {
    $("#addBloodGroup").submit();
    return false;
});

$('.addbgroup').click(function () {
    $('.bloodgroupid').val('');
    $('.addBgroupForm').toggle('slow');
});

function deleteBloodGroup(id)
{

    $.ajax({
        url: baseUrl + '/BloodGroup/delete',
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
    $('.bloodgroupid').val(id);
    $('.addBgroupForm').show();
}

$('.bname').keyup(function(){
        if($('.bname').val().length >= 0) {
            $('span.error').css('display','none');
        } else {
            $('span.error').find('.error').css('display','block');
        }
    });