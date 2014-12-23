$(document).ready(function () {
   
$('.selectpicker').selectpicker();

$( ".combobox" ).combobox();

 late(is_late);
if( userType =='addmother') {
showmaidensurname('Female');
} else if(userType == 'addfather') {
    showmaidensurname('Male');
} else {
    showmaidensurname('Male');
}

    $("#createFamily").validate({
         errorElement: "div",
          errorPlacement: function(error, element) {
               var type = $(element).attr("type");
            if (typeof type == 'undefined') {
                error.appendTo(element.parent());
            }else if(  type == 'radio' ) {
                error.appendTo(element.parent().parent());
            }
            else {
                error.insertAfter(element);
            }
        },
        rules: {
             'sect': {
                required: true,
                maxlength: 25
            },
            'gender' : {
                required: true,
                maxlength: 25
            },
            'martial_status': {
                required: true,
                maxlength: 25
            },
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
            
             'data[People][village]': {
                required: true
            },
            'data[People][main_surname]': {
                required: true
            },
        },
        messages: {
            'sect': {
                 required: 'Please select sect',
            },
            'gender' : {
                 required: 'Please select gender',
            },
             'martial_status': {
                 required: 'Please select martial status',
             },
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
            'data[People][village]': {
                required: 'Please select village'
            },
            'data[People][main_surname]': {
                required: 'Please select main surname',
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
                    
                    if ( grpid == '') {
                        grpid = data.grpid;
                    }
                    window.location.href = baseUrl + "/family/details/"+ grpid;
                }, 2500);
            }
               
            }, "json");
        
            return false;
        }
    });
});

$(".editOwnButton").click(function () {
    
    if (userType == 'addnew' && $("#PeopleIsLate").is(':checked') ==  true) {
            $('.phone_number').rules('remove', 'required');
    } else {
        $('.phone_number').rules('add', 'required');
    }
    if( userType != 'addnew') {
        $('.phone_number').rules('remove', 'required');
    }
    if ($("#PeopleIsLate").is(':checked') ==  false) {
        $('.date_of_death').rules('remove', 'required');
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

$("#PeopleIsLate").click(function () {
   
    late(1);
});

function late(is_late) {
   
    if ($("#PeopleIsLate").is(':checked') ==  true || is_late == 1) {
       
        $(".dd").show();
        //$('.date_of_death').rules('add', 'required');
    } else {
        $(".dd").hide();
       
        //$('.date_of_death').rules('remove', 'required');
    }   
}

