$(document).ready(function () {

    $("#createFamily").validate({
        errorElement: "span",
        rules: {
            'data[People][first_name]': {
                required: true,
                maxlength: 25
            },
            'data[People][last_name]': {
                required: true,
                maxlength: 25
            },
            'data[People][phone_number]': {
                required: true,
                maxlength: 10
            },
            'data[People][email]': {
                required: true,
                email: true
            },
            'data[People][gender]': {
                required: true
            },
        },
        messages: {
            'data[People][first_name]': {
                required: 'Please enter first name',
                maxlength: 'Length exceeds 25 charaters'
            },
            'data[People][last_name]': {
                required: 'Please enter last name',
                maxlength: 'Length exceeds 25 charaters'
            },
            'data[People][phone_number]': {
                required: 'Please enter phone',
                maxlength: 'Please enter valid phone number'
            },
            'data[People][email]': {
                required: 'Please enter email',
                email: 'Please enter valid email',
            },
            'data[People][gender]': {
                required: 'Please select gender'
            },
        },
        submitHandler: function (form) {
            var queryString = $('#createFamily').serialize();
            var type = userType;
            var peopleid = pid;
            
            $.post(baseUrl + '/family/editOwnDetails?type=' + type + '&peopleid=' + peopleid, queryString, function (data) {
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
                    window.location.href = baseUrl + "/family/details/1";
                }, 2500);
            }
               
            }, "json");
        
            return false;
        }
    });
});

$(".editOwnButton").click(function () {
    $("#createFamily").submit();
    return false;
});