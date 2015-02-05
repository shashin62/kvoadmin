<div class="form-group subrb suburbdiv">
					<label class="col-lg-4 col-md-4 col-xs-4 control-label" for="operators">Created By</label>   
					<div class="col-lg-8 col-md-8 col-xs-8">
					
					<?php

					echo $this->Form->input('operators', array('id' => 'operators',
					'label' => false,
					'div' => false,
					'legend' => false,
					'empty' => __d('label', '--Select--'),
					'class' => 'operators',
					'tabindex'=> '8',
					'style' => '',
					'options' => $data
					));
					?>
					</div>
				</div>
<div class="container-fluid">   
<h3 class="heading">Missing People Data</h3>

<table id="getMissingData" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Group ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Missing Data</th>
	<th>Action</th>
    </tr>
    </thead>
</table>
    </div>
<?php echo $this->Html->script(array('Reports/missing_data')); ?>
