<div class="container-fluid">   
    <h3 class="heading">Completed records</h3>
    <table id="getCompletedData" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>        
        <th>First Name</th>
        <th>Last Name</th>
        <th>Mother</th>
	<th>Father</th>
        <th>Mobile</th>
        <th>Date of Birth</th>
        <th>Grand Father</th>
    </tr>
    </thead>
</table>
</div>
<?php echo $this->Html->script(array('Reports/completed_data')); ?>
