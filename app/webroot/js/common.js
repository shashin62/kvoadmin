function doFormPost(url , data) {    
    var data = $.parseJSON(data);   
    var number = Math.ceil(Math.random() * 10) + 3;    
    var form = '<form method="POST" action ='+ url+ ' id="form_'+ number +'">';   
    for( var key in data) {       
        form += '<input type ="hidden" name="'+ key +'" value="'+ data[key]+'">';
    }
    form += '</form>';    
    $('body').append(form);
    $('#form_'+number).submit();
}

function showJsSuccessMessage(message) {
    centerMessage('customFlash');
    $('.jssuccessMessage').show().html(message);
    
}

function centerMessage(holder){
    var msgWidth, bodyWidth, successMsg, finalVal;
	bodyWidth = $('body').width();
	successMsg = $('#'+holder);
	msgWidth = successMsg.width();
	
	var finalVal = ((bodyWidth - msgWidth)/2);
	
	successMsg.css({left: finalVal+'px'}).show();
}
var filterFlag;
function displayErrors(ename,etype,error, callType, marginLeft)
{   
    marginLeft = typeof(marginLeft) != 'undefined' ? marginLeft : "";


    //alert(marginLeft)
    if($('#'+ename+'_err').length > 0) {
        if(callType == 'server') {
            $('#'+ename+'_err').attr('style',"display:;");
            $('#'+ename+'_err').html(error);
        } else {
            $('#'+ename+'_err').html(error.text());
        }
       
        var eid = ename+'_err';
        //$("#"+eid).css('margin-left', marginLeft);

    } else {

        if(callType == "server") {
            errorMsg = '<span htmlfor="'+ename+'" id="'+ename+'_err" generated="true" class="error" style="display:;">'+error+'</span>';
        } else {
            error.attr("id",ename+'_err');
            errorMsg = error;
        }

        if(etype == 'select-one') {
            $('#'+ename).parent().append(errorMsg);
        } else if(etype == "radio") {
            if(callType == 'server') {               
                $('#'+ename).parent().parent().append(errorMsg);
            } else {
                $('#'+ename).parent().parent().append(errorMsg);
            }
        } else if(etype == 'select-multiple'){
            $('#'+ename).parent().append(errorMsg);
        } else if(etype == "postdate") {
            if(callType == 'server') {
                $('#'+ename).parent().parent().append(errorMsg);
            } else {
                $('#'+ename).parent().parent().append(errorMsg);
            }
        } else {
            $('#'+ename).parent().append(errorMsg);
        }
        
        // overwrite the margin-left
        var eid = ename+'_err';
        //if(marginLeft != "") {
            //$("#"+eid).css('margin-left', marginLeft);
        //}
    }
}
