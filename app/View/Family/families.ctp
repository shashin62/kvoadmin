<style>
    tfoot {
    display: table-header-group;
}
</style>
<?php
$roles = array(1,2,3);
?>
<div class="container-fluid">
    <div class="row">
		<div class="col-md-6 col-lg-6 col-xs-12">
		    <h3 class="heading">Families</h3>
		</div>
        
		<div class="col-md-6 col-lg-6 col-xs-12">
                    <?php if (in_array($this->Session->read('User.role_id'),$roles)) {?>
                     <?php echo $this->Form->input("showhof", array('type' => "checkbox",'class' => 'showhof', 'checked' => 'checked' ,'div' => false, "label" => 'Show only HOF')); ?>
                    <?php } ?>
                    &nbsp;&nbsp;
                     <?php echo $this->Form->input("showmy", array('type' => "checkbox",'class' => 'showmy','div' => false, "label" => 'Show only my entries')); ?>
			<a href="javascript:void(0);" class="btn btn-primary btn-primary pull-right addfamily"><span class="glyphicon glyphicon-edit"></span>New Family</a>
		</div>
        
        
    </div>
    

   
</div>

<div class="container-fluid">
    <table id="getFamilyGroup" class="display" cellspacing="0" width="100%">
        <tfoot>
            <tr>
                <th></th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Father's Name</th>
                <th>Spouse's Name</th>
                <th>Village</th>
                <th>Mobile</th>               
                <th>DOB</th>  
                <th></th> 
                <th></th>  
                <th></th>
            </tr>
        </tfoot>
        <thead>
            <tr>
                <th>Group ID</th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Father's Name</th>
                <th>Spouse's Name</th>
                <th>Village</th>
                <th>Mobile</th>                  
                <th>DOB</th>
                <th>Created by</th> 
                <th>Created On</th> 
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
<script type="text/javascript">
    var roleid = '<?php echo $this->Session->read('User.role_id'); ?>';
   var userid = '<?php echo $this->Session->read('User.user_id'); ?>';
</script>
<?php echo $this->Html->script(array('Family/view_groups')); ?>