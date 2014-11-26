 <div class="container-fluid">
    <a href="<?php echo $this->base;?>" class="btn btn-primary btn-primary pull-right"><span class="glyphicon glyphicon-edit"></span>Add User</a>
</div>
<div class="container-fluid">   
<h2>Users</h2>
<table id="getUsers" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Phone Number</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
   
    </div>
<?php echo $this->Html->script(array('User/user_lists')); ?>