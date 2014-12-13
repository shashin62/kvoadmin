$(document).ready(function () {

$('.selectpicker').selectpicker();

$( ".combobox" ).combobox();
if( userType =='addmother') {
showmaidensurname('Female');
} else if(userType == 'addfather') {
    showmaidensurname('Male');
} else {
    showmaidensurname('Male');
}

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
            'data[People][mobile_number]': {
                required: true,
                maxlength: 10
            },
            'data[People][email]': {
                required: false,
                email: true
            },
            'data[People][gender]': {
                required: true
            },
             'data[People][village]': {
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
            'data[People][mobile_number]': {
                required: 'Please enter phone number',
                maxlength: 'Please enter valid phone number'
            },
            'data[People][email]': {
                email: 'Please enter valid email',
            },
            'data[People][gender]': {
                required: 'Please select gender'
            },
            'data[People][village]': {
                required: 'Please select village'
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
                    window.location.href = baseUrl + "/family/familiyGroups";
                }, 2500);
            }
               
            }, "json");
        
            return false;
        }
    });
});

$(".editOwnButton").click(function () {
    if( userType != 'addnew') {
        $('.phone_number').rules('remove', 'required');
    }
    $("#createFamily").submit();
    return false;
});

$('.genders > label').click(function()
{
   showmaidensurname($(this).text());
});

function showmaidensurname($this)
{
    
    if( $.trim($this) == "Male") {
       $(".maidensurname").hide();
   } else {
        $(".maidensurname").show();
   }
}
$(".male").click(function () {
    $(".maidensurname").hide();
    $(".widower").val('widower');
    
    return false;
});

$(".female").click(function () {
    $(".maidensurname").show();
     $(".widower").val('widow');
    return false;
});


