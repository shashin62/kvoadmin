<?php if ($this->Session->read('User.role_id') == 2) {?>
<div class="container-fluid">
    <div class="row">
        <a href="javascript:void(0);" class="btn btn-primary btn-primary pull-right addfamily"><span class="glyphicon glyphicon-edit"></span>Add Family Group</a>
    </div>
<?php } ?>    
</div>
<div class="container-fluid">   
<h3 class="heading">Family Groups</h3>
<table id="getFamilyGroup" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>DOB</th>
        <th>Mobile</th>
        <th>Created On</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
    </div>
<?php echo $this->Html->script(array('Family/view_groups')); ?>