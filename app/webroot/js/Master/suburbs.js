var oTable;
$(function () {

    oTable = $('#getSuburbs').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/suburb/getAjaxData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(3)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editSuburb(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteSuburb(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });
    $('#getSuburbs').removeClass('display').addClass('table table-striped table-bordered');
});
$("#addSuburb").validate({
    errorElement: "span",
    rules: {
        'data[Suburb][name]': {
            required: true,
            maxlength: 25
        }
    },
    messages: {
        'data[Suburb][name]': {
            required: 'Please enter Suburb',
            maxlength: 'Length exceeds 25 charaters'
        }
    },
    submitHandler: function (form) {
        var queryString = $('#addSuburb').serialize();

        $.post(baseUrl + '/suburb/add', queryString, function (data) {
            if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addSuburbForm').toggle('slow');
                setTimeout(function () {
                    $('.jssuccessMessage').hide('slow');
                    $('.suburbid').val('');
                    $('.bname').val('');
                    oTable.fnDraw(true);
                }, 2500);
            }
        }, "json");
        return false;
    }
});
$(".bgButton").click(function () {
    $("#addSuburb").submit();
    return false;
});

$('.addsuburb').click(function () {
    $('.suburbid').val('');

    $('.addSuburbForm').toggle('slow');
});

function deleteSuburb(id)
{

    $.ajax({
        url: baseUrl + '/suburb/delete',
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

function editSuburb(id, name)
{
    $.trim($('.bname').val(name));
    $('.suburbid').val(id);
    $('.addSuburbForm').show();
}

 $('.bname').keyup(function(){
        if($('.bname').val().length >= 0) {
            $('span.error').css('display','none');
        } else {
            $('span.error').find('.error').css('display','block');
        }
    });