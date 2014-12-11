var oTable;
$(function () {

    oTable = $('#getStates').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/state/getAjaxData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(5)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editBloodGroup(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteBloodGroup(' + aData[0] + ')"  data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });
    $('#getStates').removeClass('display').addClass('table table-striped table-bordered');
});

$("#addState").validate({
    errorElement: "span",
    rules: {
        'data[State][name]': {
            required: true,
            maxlength: 25
        }
    },
    messages: {
        'data[State][name]': {
            required: 'Please enter state',
            maxlength: 'Length exceeds 25 charaters'
        }
    },
    submitHandler: function (form) {
        var queryString = $('#addState').serialize();

        $.post(baseUrl + '/state/add', queryString, function (data) {
            if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addStateForm').toggle('slow');
                setTimeout(function () {
                    $('.jssuccessMessage').hide('slow');
                    $('.stateid').val('');
                    $('.bname').val('');
                    oTable.fnDraw(true);
                }, 2500);
            }
        }, "json");
        return false;
    }
});
$(".bgButton").click(function () {

    $("#addState").submit();
    return false;
});

$('.addstate').click(function () {
    $('.stateid').val('');
    $('.addStateForm').toggle('slow');
});

function deleteBloodGroup(id)
{

    $.ajax({
        url: baseUrl + '/state/delete',
        dataType: 'json',
        data: {id: id},
        type: "POST",
        success: function (response) {
            var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            oTable.fnDraw(true);
            setTimeout(function () {
                $('.jssuccessMessage').hide('slow');
            }, 2500);


        }
    });
}

function editBloodGroup(id, name)
{
    $.trim($('.bname').val(name));
    $('.stateid').val(id);
    $('.addStateForm').show();
}

$('.bname').keyup(function(){
        if($('.bname').val().length >= 0) {
            $('span.error').css('display','none');
        } else {
            $('span.error').find('.error').css('display','block');
        }
    });