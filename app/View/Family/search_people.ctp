<style type="text/css">
</style>
<div class="container-fluid">
<h3 class="heading">Search and add  <?php echo ucfirst(str_replace('add', ' ', $type));?> of <?php echo $name_parent;?></h3>
    <div class="row">
        <div class="col-xs-12 col-md-6">	
            <form class="form-horizontal addUser">
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">First Name:</label>
                    <div class="col-lg-4 col-md-4 col-xs-4">
                        <input type="text" class="form-control search_username" name="first_name" placeholder="Firstname" custom="1" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="last_name">Last Name:</label>
                    <div class="col-lg-4 col-md-4 col-xs-4">
                        <input type="text" class="form-control search_username" name="last_name" placeholder="Lastname" custom="2" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="phone_number">Contact number:</label>
                    <div class="col-lg-4 col-md-4 col-xs-4">
                        <input type="text" class="form-control search" name="phone_number" placeholder="Contact number" custom="3"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="date_of_birth">DOB:</label>
                    <div class="col-lg-4 col-md-4 col-xs-4">
                        <input id = "date_of_birth" type="text" class="form-control dp search_DOB" name="date_of_birth" placeholder="DOB" custom="4"/>
                    </div>
                </div>
            </form>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-actions">
                    <div class="col-lg-4 col-md-4 col-xs-4">&nbsp;</div>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <button type="button" class="btn btn-primary addnew" data-first_name="<?php echo $name_parent;?>">Add new <?php echo ucfirst(str_replace('add', ' ', $type));?> of <?php echo $name_parent;?></button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <table id="all_users" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php echo $this->Html->script(array('Family/search_people')); ?>
<script type="text/javascript">
 $(function () {
        $("#date_of_birth").datepicker({
            format: "yyyy-mm-dd",
        });
        $('.dp').on('change', function () {
            $('.datepicker').hide();
        });
       
    });
    var actiontype = '<?php echo $type;?>';
    var user_id = '<?php echo $fid;?>';
    var group_id = '<?php echo $gid;?>';
    
    $('.addnew').click(function(){
   
   var id = user_id;
   var gid = group_id;
 var first_name = $(this).data('first_name');
   doFormPost(baseUrl+"/family/index?type=" + actiontype ,'{ "type":"'+ actiontype+'","fid":"'+ id +'","gid":"'+ gid +'","name_parent":"'+ first_name +'"}');
});
</script>
<!--<script type="text/javascript">
$(document).ready(function() {

var table = $('#all_users').DataTable();
$('#all_users').removeClass( 'display' ).addClass('table table-striped table-bordered');

} );

$(document).ready(function() {
$(".search, .search_username").bind("keyup", function(){
var table = $('#all_users').DataTable();
        table
.column( $(this).attr('custom') )
.search( this.value )
.draw();


});
});
</script>-->