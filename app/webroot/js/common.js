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
