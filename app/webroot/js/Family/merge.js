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
            
            $('.villagediv_first').find('.ui-autocomplete-input').val(response.village);
            $('.sectdiv_first').find('.ui-autocomplete-input').val(response.sect);
            $('.main_surnamediv_first').find('.ui-autocomplete-input').val(response.main_surname);
            
            $('.genderdiv_first').find('.ui-autocomplete-input').val(response.gender);
            
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
            
            $('.villagediv_second').find('.ui-autocomplete-input').val(response.village);
            
            
            
            $('.main_surnamediv_second').find('.ui-autocomplete-input').val(response.main_surname);
             $('.sectdiv_second').find('.ui-autocomplete-input').val(response.sect);
            $('.genderdiv_second').find('.ui-autocomplete-input').val(response.gender);
            $('.first_name_second').val(response.first_name);
            $('.last_name_second').val(response.last_name);
            
            $('.mobile_number_second').val(response.mobile_number);
            $('.email_second').val(response.email);
            
            $('.date_of_birth_second').val(response.date_of_birth);
        }
    });
    
});


$('.mergeButton').click(function(){
   var form = {};
   
   form['firstid'] = $('.firstId').val();
   form['secondid'] = $('.secondId').val();
   
   $.each($('input[type=radio]:checked'), function(i,val){
       
       var name = $(this).data('d');
       
       if (  $(this).attr('name') == 'village_radio') {
          
           form['data[People][village]'] = $('[data-d='+ name +']').parent().parent().find('.ui-autocomplete-input').val();
       }
         if (  $(this).attr('name') == 'main_surname_radio') {
          
           form['data[People][main_surname]'] = $('[data-d='+ name +']').parent().parent().find('.ui-autocomplete-input').val();
       }
       
        if (  $(this).attr('name') == 'sect_radio') {
          
           form['data[People][sect]'] = $('[data-d='+ name +']').parent().parent().find('.ui-autocomplete-input').val();
       }
       
         if (  $(this).attr('name') == 'gender_radio') {
          
           form['data[People][gender]'] = $('[data-d='+ name +']').parent().parent().find('.ui-autocomplete-input').val();
       }
       
       if ( typeof $(this).parent().next().find('.form-control').attr('name') != 'undefined') {
        form[$(this).parent().next().find('.form-control').attr('name')] = $(this).parent().next().find('.form-control').val();
    }
     //  console.log($(this).parent().next().find('.form-control').attr('name')); 
   });
    console.log(form);
    
      $.ajax({
        url: baseUrl + '/family/mergeData',
        dataType: 'json',
        data: {data: form},
        type: "POST",
        success: function (response) {
            
             var displayMsg = response.message;
            showJsSuccessMessage(displayMsg);
            setTimeout(function () {
            window.location.href = baseUrl + "/family/merge";
        },1000);
        }
        
   });
    
});

