<div class="container-fluid">
    <a href="<?php echo $this->base;?>" class="btn btn-primary btn-primary pull-right"><span class="glyphicon glyphicon-edit"></span>Add State</a>
</div>
<div class="container-fluid">   
<h2>States</h2>
<table id="getStates" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>        
		<th>Country</th>
		<th>Status</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
    </div>
<?php echo $this->Html->script(array('Master/states')); ?>