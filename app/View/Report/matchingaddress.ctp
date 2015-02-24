<div class="container-fluid">   
<h3 class="heading">Missing Address Data</h3>

<table id="getMissingData" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Group ID</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zip Code</th>
        <th>Matching IDs</th>
	<th>Action</th>
    </tr>
    </thead>
</table>
    </div>
<?php echo $this->Html->script(array('Reports/matching_address')); ?>
