var oTable;
$(function () {

    oTable = $('#getCountry').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/country/getAjaxData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(4)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editCountry(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteBloodGroup(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {
           
        }
    });
    $('#getCountry').removeClass('display').addClass('table table-striped table-bordered');
});
$("#addCountry").validate({
    errorElement: "span",
    rules: {
        'data[Country][name]': {
            required: true,
            maxlength: 25
        }
    },
    messages: {
        'data[Country][name]': {
            required: 'Please enter country',
            maxlength: 'Length exceeds 25 charaters'
        }
    },
    submitHandler: function (form) {
        var queryString = $('#addCountry').serialize();

        $.post(baseUrl + '/country/add', queryString, function (data) {
            if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addCountryForm').toggle('slow');
                setTimeout(function () {
                    $('.jssuccessMessage').hide('slow');
                    $('.countryid').val('');
                    $('.bname').val('');
                    oTable.fnDraw(true);
                }, 2500);
            }
        }, "json");
        return false;
    }
});
$(".bgButton").click(function () {
    $("#addCountry").submit();
    return false;
});

$('.addcountry').click(function () {
    $('.countryid').val('');
    $('.addCountryForm').toggle('slow');
});

function deleteBloodGroup(id)
{

    $.ajax({
        url: baseUrl + '/country/delete',
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

function editCountry(id, name)
{
    $.trim($('.bname').val(name));
    $('.countryid').val(id);
    $('.addCountryForm').show();
}
