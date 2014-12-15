<style>
    tfoot {
    display: table-header-group;
}
</style>
<?php
$roles = array(1,2,3);
if (in_array($this->Session->read('User.role_id'),$roles)) {?>
<div class="container-fluid">
    <div class="row">
        <a href="javascript:void(0);" class="btn btn-primary btn-primary pull-right addfamily"><span class="glyphicon glyphicon-edit"></span>New Family</a>
    </div>
<?php } ?>
</div>
<div class="container-fluid">   
    <h3 class="heading">Families</h3>
    <table id="getFamilyGroup" class="display" cellspacing="0" width="100%">
        <tfoot>
            <tr>
                <th></th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Mobile</th>
                <th></th>
            </tr>
        </tfoot>
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
    </table>
</div>
<?php echo $this->Html->script(array('Family/view_groups')); ?>