<div class="container-fluid">   
    <h3 class="heading">Completed records count</h3>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="fromdate">From date</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php echo $this->Form->input('created', 
						array('id' => 'createdfrom', 'type' => 'text','title' => '','value' => $fromdate,'placeholder' => 'dd/mm/yyyy format' ,'div' => false, 'label' => false, 'class' => 'fromdate form-control')); ?>
                </div>
            </div>
           
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="todate">To date</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php echo $this->Form->input('created', 
						array('id' => 'createdto', 'type' => 'text','value' => $todate,'title' => '','placeholder' => 'dd/mm/yyyy format' ,'div' => false, 'label' => false, 'class' => 'todate form-control')); ?>
                </div>
            </div>
        </div>

    </div>
    <br />
<div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-actions">
                <div class="col-lg-4 col-md-4 col-xs-4">&nbsp;</div>
                <div class="col-lg-8 col-md-8 col-xs-8">
                    <button type="button" class="btn btn-primary search">Search</button>
                    <button type="button" style="color: red" class="btn btn-link clear">clear</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            Total completed records - <span><b><?php echo $count;?></b></span>
        </div>
    </div>
</div>
<?php echo $this->Html->script(array('Reports/completed_data')); ?>