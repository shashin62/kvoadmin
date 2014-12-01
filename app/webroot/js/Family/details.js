$('.addspouse').click(function(){
   var $this =  $(this);
   var id = $this.data('id');
  
   doFormPost(baseUrl+"/family/index?type=addspouse",'{ "type":"addspouse","fid":"'+ id +'"}');
   
    
});

$('.addfather').click(function(){
   var $this =  $(this);
   var id = $this.data('id');
  
   doFormPost(baseUrl+"/family/index?type=addfather",'{ "type":"addfather","fid":"'+ id +'"}');
   
    
});

$('.addmother').click(function(){
   var $this =  $(this);
   var id = $this.data('id');
  
   doFormPost(baseUrl+"/family/index?type=addmother",'{ "type":"addmother","fid":"'+ id +'"}');
   
    
});