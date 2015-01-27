    var oTable;
$(function () {

    oTable = $('#getZipcode').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/zip/getZipAjaxData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(7)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editTranslation(' + aData[0] + ', \'' + aData + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteTranslation(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {
           
        }
    });
    $('#getZipcode').removeClass('display').addClass('table table-striped table-bordered');
});

 $("#addZipCodes").validate({
     errorElement: "span",
      rules: {
            'data[ZipCode][zip_code]': {
                required: true,
                maxlength: 25
            },
            'data[ZipCode][suburb]': {
                required: true,
                maxlength: 25
            },
            'data[ZipCode][zone]': {
                required: true,
                maxlength: 25
            },
            'data[ZipCode][city]': {
                required: true,
                maxlength: 25
            },
            'data[ZipCode][state]': {
                required: true,
                maxlength: 25
            },
            'data[ZipCode][std]': {
                required: true,
                maxlength: 25
            }
        },
         messages: {
             'data[ZipCode][zip_code]': {
                required: 'Please enter zip code',
                maxlength: 'Length exceeds 25 charaters'
            },
            'data[ZipCode][suburb]': {
                required: 'Please enter suburb',
                maxlength: 'Length exceeds 25 charaters'
            },
            'data[ZipCode][zone]': {
                required: 'Please enter zone',
                maxlength: 'Length exceeds 25 charaters'
            },
            'data[ZipCode][city]': {
                required: 'Please enter city',
                maxlength: 'Length exceeds 25 charaters'
            },
            'data[ZipCode][state]': {
                required: 'Please enter state',
                maxlength: 'Length exceeds 25 charaters'
            },
            'data[ZipCode][std]': {
                required: 'Please enter std',
                maxlength: 'Length exceeds 25 charaters'
            }
        },
        submitHandler: function (form) {
             var queryString = $('#addZipCodes').serialize();

            $.post(baseUrl + '/zip/addZip', queryString, function (data) {
                
                 if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addZipcodeForm').toggle('slow');
                setTimeout(function () {
                    $('.jssuccessMessage').hide('slow');
                    $('.zipcodeid').val('');
                    $('.bname').val('');
                    $('.suburb').val('');
                    
                    $('.zone').val('');
                    $('.city').val('');
                    $('.state').val('');
                    $('.std').val('');
                    
                   oTable.fnDraw(true);
                }, 2500);
            }
            }, "json");
            return false;
        }
 });
$(".bgButton").click(function () {
    $("#addZipCodes").submit();
    return false;
});

$('.addZipCode').click(function() {
     $('.zipcodeid').val('');
    $('.addZipcodeForm').toggle('slow');
});

function deleteTranslation(id)
{

    $.ajax({
        url: baseUrl + '/zip/deleteZip',
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

function editTranslation(id, aData)
{
   aData = aData.split(',');
   
   $('.bname').val(aData[1]);
   $('.suburb').val(aData[2]);
                    
                    $('.zone').val( aData[3]);
                    $('.city').val( aData[4]);
                    $('.state').val( aData[5]);
                    $('.std').val(aData[6]);
   
    $('.zipcodeid').val(id);
   $('.addZipcodeForm').show();
}

$('.bname').keyup(function(){
        if($('.bname').val().length >= 0) {
            $('span.error').css('display','none');
        } else {
            $('span.error').find('.error').css('display','block');
        }
    });
    
    $('.gujurathiname').keyup(function(){
        if($('.gujurathiname').val().length >= 0) {
            $('span.error').css('display','none');
        } else {
            $('span.error').find('.error').css('display','block');
        }
    });
    
    $('.hindiname').keyup(function(){
        if($('.hindiname').val().length >= 0) {
            $('span.error').css('display','none');
        } else {
            $('span.error').find('.error').css('display','block');
        }
    });