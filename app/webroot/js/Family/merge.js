$(document).ready(function () {
   
$('.selectpicker').selectpicker();

$( ".combobox" ).combobox();
$( ".combobox1" ).combobox();

});

$('.submitButton1').click(function(){
    var peopleid = $.trim($('.firstId').val());
    
     $.ajax({
        url: baseUrl + '/family/getDataById',
        dataType: 'json',
        data: {id: peopleid},
        type: "POST",
        success: function (response) {
            console.log(response);
             $('.genders_first').find('.btn-default').removeClass('active');
             $('.sects_first').find('.btn-default').removeClass('active');
            $('.villagediv_first').find('.ui-autocomplete-input').val(response.village);
            
            $('.main_surnamediv_first').find('.ui-autocomplete-input').val(response.main_surname);
            
            $('.genders_first').find('[data-gender_first=' + response.gender + ']').parent().addClass('active').attr('checked', 'checked');
            
            $('[data-gender_first=' + response.gender + ']').attr('checked', 'checked');
            
            
            $('.sects_first').find('[data-sect_first=' + response.sect + ']').parent().addClass('active').attr('checked', 'checked');
            
            $('[data-sect_first=' + response.sect + ']').attr('checked', 'checked');
            
            
            $('.first_name_first').val(response.first_name);
            $('.last_name_first').val(response.last_name);
            
            $('.mobile_number_first').val(response.mobile_number);
            $('.email_first').val(response.email);
            
            $('.date_of_birth_first').val(response.date_of_birth);
        }
    });
    
});

$('.submitButton2').click(function(){
    var peopleid = $.trim($('.secondId').val());
    
     $.ajax({
        url: baseUrl + '/family/getDataById',
        dataType: 'json',
        data: {id: peopleid},
        type: "POST",
        success: function (response) {
             $('.genders_second').find('.btn-default').removeClass('active');
             $('.sects_second').find('.btn-default').removeClass('active');
            $('.villagediv_second').find('.ui-autocomplete-input').val(response.village);
            
            $('.main_surnamediv_second').find('.ui-autocomplete-input').val(response.main_surname);
            
            $('.genders_second').find('[data-gender_second=' + response.gender + ']').parent().addClass('active').attr('checked', 'checked');
            
            $('[data-gender_second=' + response.gender + ']').attr('checked', 'checked');
            
            $('.sects_second').find('[data-sect_second=' + response.sect + ']').parent().addClass('active').attr('checked', 'checked');
            
            $('[data-sect_second=' + response.sect + ']').attr('checked', 'checked');
            
            
            $('.first_name_second').val(response.first_name);
            $('.last_name_second').val(response.last_name);
            
            $('.mobile_number_second').val(response.mobile_number);
            $('.email_second').val(response.email);
            
            $('.date_of_birth_second').val(response.date_of_birth);
        }
    });
    
});


$('.mergeButton').click(function(){
   
    
});

