$('.guju').click(function () {
window.location.href = baseUrl + '/family/details/'+ groupid + '?type=gujurathi';
});

$('.english').click(function () {
window.location.href = baseUrl + '/family/details/'+ groupid + '?type=english';
});

$('.hindi').click(function () {
window.location.href = baseUrl + '/family/details/'+ groupid + '?type=hindi';
});
$('.noteSave').click(function() {
    if( $.trim($('.comment').val()) == '') {
        return false;
    }
    var groupid = $(this).data('gid');
    var queryString = $('#addNote').serialize();
    $.post(baseUrl + '/family/addNote?gid=' + groupid, queryString, function (data) {
            if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                $('.addNoteForm').toggle('slow');
                setTimeout(function () {
                    $('.jssuccessMessage').hide('slow');
                     $('.noteid').val('');
                    $('.comment').val('');
                    oTable.fnDraw(true);
                }, 2500);
            }
        }, "json");    
    
});
$('.addnote').click(function () {
    $('.noteid').val('');
    $('.addNoteForm').toggle('slow');
});
$('.self').click(function () {
    var $this = $(this);
    var id = $this.data('id');
    var gid = $this.data('gid');

    doRedirectUrl(baseUrl + "/family/index?type=self&id=" + id + "&gid=" + gid, '{ "type":"self","fid":"' + id + '","gid":"' + gid + '"}');

});

$('.editaddress').click(function () {
    var $this = $(this);
    var id = $this.data('id');
    var aid = $this.data('aid');
    var gid = $this.data('gid');

    doRedirectUrl(baseUrl + "/family/addAddress?type=self&id=" + id + "&aid=" + aid + "&gid=" + gid,
            '{ "type":"self","fid":"' + id + '","aid":"' + aid + '","gid":"' + gid + '"}');

});

$('.editbusiness').click(function () {
    var $this = $(this);
    var id = $this.data('id');
    var aid = $this.data('aid');
    var gid = $this.data('gid');

    doRedirectUrl(baseUrl + "/family/addBusiness?type=self&id=" + id + "&aid=" + aid + "&gid=" + gid,
            '{ "type":"self","fid":"' + id + '","aid":"' + aid + '","gid":"' + gid + '"}');

});


$('.addspouse').click(function () {
    var $this = $(this);
    var id = $this.data('id');
    var first_name = $this.data('first_name');
    var gid = $this.data('gid');
    doRedirectUrl(baseUrl + "/family/searchPeople?type=addspouse",
            '{ "type":"addspouse","fid":"' + id + '","gid":"' + gid + '","name_parent":"' + first_name + '"}');
       
    
});

$('.addexspouse').click(function () {
    var $this = $(this);
    var id = $this.data('id');
    var first_name = $this.data('first_name');
    var gid = $this.data('gid');
    doRedirectUrl(baseUrl + "/family/index?type=addexspouse",
            '{ "type":"addexspouse","fid":"' + id + '","gid":"' + gid + '","name_parent":"' + first_name + '"}');
       
    
});

$('.addfather').click(function () {
    var $this = $(this);
    var id = $this.data('id');
    var gid = $this.data('gid');
    var first_name = $this.data('first_name');

    doRedirectUrl(baseUrl + "/family/searchPeople?type=addfather",
            '{ "type":"addfather","fid":"' + id + '","gid":"' + gid + '","name_parent":"' + first_name + '"}');
});

$('.addmother').click(function () {
    var $this = $(this);
    var id = $this.data('id');
    var gid = $this.data('gid');
    var first_name = $this.data('first_name');
    doRedirectUrl(baseUrl + "/family/searchPeople?type=addmother",
            '{ "type":"addmother","fid":"' + id + '","gid":"' + gid + '","name_parent":"' + first_name + '"}');

});
$('.addchild').click(function () {

    var $this = $(this);
    var id = $this.data('id');
    var first_name = $this.data('first_name');
    var gid = $this.data('gid');
doRedirectUrl(baseUrl + "/family/searchPeople?type=addchilld",
            '{ "type":"addchilld","fid":"' + id + '","gid":"' + gid + '","name_parent":"' + first_name + '"}');
            
   


});
var dialog;
$(document).ready(function () {
    $( ".combobox" ).combobox({width: '180px',select: function( event, ui ) {
      $('.owner').val(ui.item.value);
      }});
    dialog = $("#dialog-form").dialog({
        autoOpen: false,
        height: 'auto',
        width: 'auto',
        modal: false,
        buttons: {
        "Submit": transferUser,
        Cancel: function () {
                dialog.dialog("close");
            }
        },
        close: function () {
        }
    });

});

function transferUser()
{
   
     $.ajax({
        url: baseUrl + '/family/transfer',
        dataType: 'json',
        data: {id: $(this).data('id'),ownergroupid:$('.owner').val()},
        type: "POST",
        success: function (response) {
            var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            setTimeout(function () {
                $('.jssuccessMessage').hide('slow');
                window.location.href = baseUrl + '/family/details/' + groupid;
                
            }, 2500);
        }
    });
    
}

$(".transfer-family").on("click", function () {
    
    $("#dialog-form").data('id',$(this).data('id')).dialog("open");
    return false;
});

$('.deletemember').click(function(){
 var result = confirm("Want to delete?");
    if (result === true) {
     var $this = $(this);
    var id = $this.data('id');
    var gid = $this.data('gid');
     $.ajax({
        url: baseUrl + '/family/deleteMember',
        dataType: 'json',
        data: {id: id,groupid:gid},
        type: "POST",
        success: function (response) {
            var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            setTimeout(function () {
                $('.jssuccessMessage').hide('slow');
                window.location.href = baseUrl + '/family/details/' + gid;
                
            }, 2500);
        }
    });
} else {
return;
}
});

$('.make_hof').click(function(){
   var $this = $(this);
   var id = $this.data('id');
   var hofId = $this.data('hofid');
    var gid = $this.data('gid');
    $.ajax({
        url: baseUrl + '/family/makeHOF',
        dataType: 'json',
        data: {id: id, hofid: hofId, gid : gid},
        type: "POST",
        success: function (response) {
            var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            setTimeout(function () {
                $('.jssuccessMessage').hide('slow');
                window.location.href = baseUrl + '/family/details/' + gid;
                
            }, 2500);
        }
    });
});

$('.removeassco').click(function(){
    var $this = $(this);
    var id = $this.data('id');
    var gid = $this.data('gid');
    var relationType = $this.data('type');
    var assocationId;
    if( relationType == 'mother') {
        assocationId = $this.data('m_id');
    } else {
        assocationId = $this.data('f_id');
    }
    
    $.ajax({
        url: baseUrl + '/family/removeRelationship',
        dataType: 'json',
        data: {
            id: id, 
            type: relationType, 
            gid : gid,
            associationId: assocationId
        },
        type: "POST",
        success: function (response) {
            var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            setTimeout(function () {
                $('.jssuccessMessage').hide('slow');
                window.location.href = baseUrl + '/family/details/' + gid;
                
            }, 2500);
        }
    });
});
