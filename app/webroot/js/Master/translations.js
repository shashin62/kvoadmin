    var oTable;
$(function () {

    oTable = $('#getTranslation').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/translation/getAjaxData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $('td:eq(5)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editTranslation(' + aData[0] + ', \'' + aData + '\')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteTranslation(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {
           
        }
    });
    $('#getTranslation').removeClass('display').addClass('table table-striped table-bordered');
});

 $("#addTranslations").validate({
     errorElement: "span",
      rules: {
            'data[Translation][name]': {
                required: true,
                maxlength: 25
            },
            'data[Translation][gujurathi_text]': {
                required: true,
                maxlength: 25
            },
            'data[Translation][hindi_text]': {
                required: true,
                maxlength: 25
            }
        },
         messages: {
             'data[Translation][name]': {
                required: 'Please enter text to be converetd',
                maxlength: 'Length exceeds 25 charaters'
            },
            'data[Translation][gujurathi_text]': {
                required: 'Please enter gujurathi transalation',
                maxlength: 'Length exceeds 25 charaters'
            },
            'data[Translation][hindi_text]': {
                required: 'Please enter hindi transalation',
                maxlength: 'Length exceeds 25 charaters'
            }
        },
        submitHandler: function (form) {
             var queryString = $('#addTranslations').serialize();

            $.post(baseUrl + '/translation/add', queryString, function (data) {
                
                 if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addTranslationForm').toggle('slow');
                setTimeout(function () {
                    $('.jssuccessMessage').hide('slow');
                    $('.translationid').val('');
                    $('.bname').val('');
                    $('.gujurathiname').val('');
                    $('.hindiname').val('');
                   oTable.fnDraw(true);
                }, 2500);
            }
            }, "json");
            return false;
        }
 });
$(".bgButton").click(function () {
    $("#addTranslations").submit();
    return false;
});

$('.addtranslation').click(function() {
     $('.translationid').val('');
    $('.addTranslationForm').toggle('slow');
});

function deleteTranslation(id)
{

    $.ajax({
        url: baseUrl + '/translation/delete',
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
    var gujuname = aData[2];
    var hindiname = aData[3];
   $('.bname').val(aData[1]);
   $('.gujurathiname').val(gujuname).text();
   $('.hindiname').val(hindiname);
    $('.translationid').val(id);
   $('.addTranslationForm').show();
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