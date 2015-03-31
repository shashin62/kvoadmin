var oTable;
$(function() {

    oTable = $('#getPoll').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": baseUrl + "/poll/getPollAjaxData",
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
            $('td:eq(2)', nRow).html('<a class="edit_row btn btn-xs btn-success" onclick="editPoll(' + aData[0] + ')"  data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-edit"></span>Edit</a> \n\
<a class="delete_row btn btn-xs btn-danger" onclick="deletePoll(' + aData[0] + ')" data-rowid=' + aData[0] + '><span class="glyphicon glyphicon-trash">Delete</a>');

        },
        "rowCallback": function(row, data) {

        },
        "fnInitComplete": function(oSettings, json) {

        }
    });
    $('#getPoll').removeClass('display').addClass('table table-striped table-bordered');
});

$("#addPolls").validate({
    errorElement: "span",
    rules: {
        'data[Poll][name]': {
            required: true
        },
        'data[Poll][control_type]': {
            required: true
        }
    },
    messages: {
        'data[Poll][name]': {
            required: 'Please enter poll question'
        },
        'data[Poll][control_type]': {
            required: 'Please select control type'
        }
    },
    submitHandler: function(form) {
        var queryString = $('#addPolls').serialize();

        $.post(baseUrl + '/poll/addPoll', queryString, function(data) {

            if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addPollForm').toggle('slow');
                setTimeout(function() {
                    $('.jssuccessMessage').hide('slow');
                    $('.poll_name').val('');

                    oTable.fnDraw(true);
                }, 2500);
            }
            document.getElementById("addPolls").reset();
        }, "json");
        return false;
    }
});
$(".bgButton").click(function() {
    $("#addPolls").submit();
    return false;
});

$('.addPoll').click(function() {
    $('.pollid').val('');
    $('.addPollForm').toggle('slow');
});

$('#btnAddAnswer').click(function() {
    var ansNo = parseInt($('#ans_no').val()) + 1;
    $('#ans_no').val(ansNo);
    cloneAnswerField(ansNo);
});

function cloneAnswerField(ansNo) {
    var con = '<div class="form-group"><label class="col-lg-4 col-md-4 col-xs-4 control-label" for="answer_'+ansNo+'"></label><div class="col-lg-6 col-md-6 col-xs-6"><input name="data[Poll][answer_'+ansNo+']" id="answer_'+ansNo+'" placeholder="Enter Answer '+ansNo+'" title="" class="form-control bname" type="text"></div></div>';
    $('#answers').append(con);
}

function editPoll(id) {
    document.getElementById("addPolls").reset();
    $.post(baseUrl + '/poll/getPollData', { id: id }, function(data) {

            if (data.id) {
                $('#id').val(data.id);
                $('#ans_no').val(data.ans_no);
                $('#name').val(data.name);
                
                if (data.control_type == 'radio') {
                    $('#control_type_1').prop("checked", true);
                    $('#control_type_1').parent().addClass('active');
                } else {
                    $('#control_type_2').prop("checked", true);
                    $('#control_type_2').parent().addClass('active');
                }
                $('#control_type').val(data.name);
                
                for (i=1; i<= parseInt(data.ans_no); i++) {
                    if ($('#answer_'+i).length) {
                        $('#answer_'+i).val(data['answer_'+i]);
                    } else {
                        cloneAnswerField(i);
                        $('#answer_'+i).val(data['answer_'+i]);
                    }
                }
                $('.addPollForm').show();
            }
        }, "json");
}

function deletePoll(id) {
    var con = confirm("Are you sure, you want to delete this poll?");
    
    if (con) {
        $.ajax({
            url: baseUrl + '/poll/deletePoll',
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