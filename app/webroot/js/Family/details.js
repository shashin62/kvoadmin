$('.self').click(function(){
   var $this =  $(this);
   var id = $this.data('id');
   var gid = $this.data('gid');
   
   doFormPost(baseUrl+"/family/index?type=self&id="+ id+ "&gid=" + gid,'{ "type":"self","fid":"'+ id +'","gid":"'+ gid +'"}');
   
});

$('.editaddress').click(function(){
   var $this =  $(this);
   var id = $this.data('id');
  var aid = $this.data('aid');
  var gid = $this.data('gid');
  
   doFormPost(baseUrl+"/family/addAddress?type=self&id="+ id + "&aid="+ aid + "&gid=" + gid,
   '{ "type":"self","fid":"'+ id +'","aid":"'+ aid +'","gid":"'+ gid +'"}');
   
});

$('.editbusiness').click(function(){
   var $this =  $(this);
   var id = $this.data('id');
  var aid = $this.data('aid');
  var gid = $this.data('gid');
  
   doFormPost(baseUrl+"/family/addBusiness?type=self&id="+ id + "&aid="+ aid + "&gid=" + gid,
   '{ "type":"self","fid":"'+ id +'","aid":"'+ aid +'","gid":"'+ gid +'"}');
   
});


$('.addspouse').click(function(){
    var $this =  $(this);
    var id = $this.data('id');
    var first_name = $this.data('first_name');
    
   doFormPost(baseUrl+"/family/index?type=addspouse",'{ "type":"addspouse","fid":"'+ id +'","name_parent":"'+ first_name +'"}');
    
});

$('.addfather').click(function(){
   var $this =  $(this);
   var id = $this.data('id');
   var gid = $this.data('gid');
   var first_name = $this.data('first_name');
   
   doFormPost(baseUrl+"/family/searchPeople?type=addfather",
   '{ "type":"addfather","fid":"'+ id +'","gid":"'+ gid +'","name_parent":"'+ first_name +'"}');
});

$('.addmother').click(function(){
   var $this =  $(this);
   var id = $this.data('id');  
   var gid = $this.data('gid');
   var first_name = $this.data('first_name');
   doFormPost(baseUrl+"/family/searchPeople?type=addmother",
   '{ "type":"addmother","fid":"'+ id +'","gid":"'+ gid +'","name_parent":"'+ first_name +'"}');
    
});
$('.addchild').click(function(){
   var $this =  $(this);
   var id = $this.data('id');
  var first_name = $this.data('first_name');
  
   doFormPost(baseUrl+"/family/index?type=addchilld",'{ "type":"addchilld","fid":"'+ id +'","name_parent":"'+ first_name +'"}');
   
    
});
