var oTable;
$(function() {

    oTable = $('#getBusinessNature').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/BusinessNature/getAjaxData",
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
            $('td:eq(4)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editBusinessNature(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteBusinessNature(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function(row, data) {

        },
        "fnInitComplete": function(oSettings, json) {

        }
    });
    $('#getBusinessNature').removeClass('display').addClass('table table-striped table-bordered');
});

$("#addBusinessNature").validate({
    errorElement: "span",
    rules: {
        'data[BusinessNature][name]': {
            required: true,
            maxlength: 25
        }
    },
    messages: {
        'data[BusinessNature][name]': {
            required: 'Please enter Business Nature',
            maxlength: 'Length exceeds 25 charaters'
        }
    },
    submitHandler: function(form) {
        var queryString = $('#addBusinessNature').serialize();

        $.post(baseUrl + '/BusinessNature/add', queryString, function(data) {
            if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addBusinessNatureForm').toggle('slow');
                setTimeout(function() {
                    $('.jssuccessMessage').hide('slow');
                    $('.businessnatureid').val('');
                    $('.bname').val('');
                    oTable.fnDraw(true);
                }, 2500);
            }
        }, "json");
        return false;
    }
});
$(".bgButton").click(function() {
    $("#addBusinessNature").submit();
    return false;
});

$('.addbusinessnature').click(function() {
    $('.businessnatureid').val('');
    $('.bname').val('');
    $('.addBusinessNatureForm').toggle('slow');
});

function deleteBusinessNature(id)
{

    $.ajax({
        url: baseUrl + '/BusinessNature/delete',
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

function editBusinessNature(id, name)
{
    $.trim($('.bname').val(name));
    $('.businessnatureid').val(id);
    $('.addBusinessNatureForm').show();
}

$('.bname').keyup(function() {
    if ($('.bname').val().length >= 0) {
        $('span.error').css('display', 'none');
    } else {
        $('span.error').find('.error').css('display', 'block');
    }
});