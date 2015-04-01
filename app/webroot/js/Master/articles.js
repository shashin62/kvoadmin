var oTable;
$(function() {
    
    if (successMessage) {
        showJsSuccessMessage(successMessage);
        setTimeout(function () {
            $('.jssuccessMessage').hide('slow');
        }, 2500);
    }

    oTable = $('#getArticle').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/article/getArticleAjaxData",
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
            $('td:eq(4)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editArticle(' + aData[0] + ')"  data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deleteArticle(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function(row, data) {

        },
        "fnInitComplete": function(oSettings, json) {

        }
    });
    $('#getArticle').removeClass('display').addClass('table table-striped table-bordered');
});

$('.summernote').summernote({
    height: 120,
    toolbar: [
        ['style', ['bold', 'italic', 'underline']],
        ['para', ['paragraph']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['codeview']]
    ],
    styleWithSpan: false
});

$.validator.addMethod("editorchk", function(value, element) {
    var sHTML = $('.summernote').code();
    if (sHTML != '' && sHTML != '<p><br></p>') {
        return true;
    }
    return false;
}, "Please enter article description");

$("#addArticle").validate({
    errorElement: "span",
    rules: {
        'data[Article][title]': {
            required: true
        },
        'data[Article][author]': {
            required: true
        },
        'data[Article][body]': {
            editorchk: true
        }
    },
    errorPlacement: function(error, element) {
        if (element.attr("id") == "body" ) {
          error.insertAfter(".note-editor");
        } else {
          error.insertAfter(element);
        }
    },
    messages: {
        'data[Article][title]': {
            required: 'Please enter article title'
        },
        'data[Article][author]': {
            required: 'Please enter author name'
        },
        'data[Article][body]': {
            editorchk: 'Please enter article description'
        }
    }
});
$(".bgButton").click(function() {
    $("#addArticle").submit();
    return false;
});

$('.addArticle').click(function() {
    $('.articleid').val('');
    $('.image-name').parent().hide();
    $('.addArticleForm').toggle('slow');
});


function editArticle(id) {
    document.getElementById("addArticle").reset();
    $('.summernote').code('');
    $.post(baseUrl + '/article/getArticleData', { id: id }, function(data) {

            if (data.id) {
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#author').val(data.author);
                $('#body').val(data.body);
                $('.summernote').code(data.body);
                $('.image-name').html(data.image);
                $('.image-name').parent().show();
                $('.addArticleForm').show();
            }
        }, "json");
}

function deleteArticle(id) {
    var con = confirm("Are you sure, you want to delete this article?");
    
    if (con) {
        $.ajax({
            url: baseUrl + '/article/deleteArticle',
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
}