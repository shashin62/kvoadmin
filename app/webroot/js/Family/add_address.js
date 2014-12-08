$(document).ready(function () {

    $("#addressForm").validate({
        errorElement: "span",
        rules: {
            
        },
        messages: {
           
        },
        submitHandler: function (form) {
            var queryString = $('#addressForm').serialize();
            var peopleid = pid;
            var addressid = aid;
            
            $.post(baseUrl + '/family/doProcessAddress?peopleid=' + peopleid + '&addressid=' + addressid + '&parentid=' + prntid, queryString, function (data) {
                 if (0 == data.status) {
                if (data.error.name.length > 0) {
                    for (var i = 0; i < data.error.name.length; i++) {
                        displayErrors(data.error.name[i], $("#" + data.error.name[i]).attr('type'), data.error.errormsg[i], "server");
                    }
                }
            } else {
                 var displayMsg = data.message;
                showJsSuccessMessage(displayMsg);
                setTimeout(function () {
                    $('.jssuccessMessage').hide('slow');
                    window.location.href = baseUrl + "/family/familiyGroups";
                }, 2500);
            }
            }, "json");
            return false;
        }
    });
});

$(".addressButton").click(function () {
    $("#addressForm").submit();
    return false;
});

$('.same_as').click(function(){
    if ( $(this).is(':checked') == true) {
        $('.addresscontainer').hide();
    } else {
        $('.addresscontainer').show();
    }
});