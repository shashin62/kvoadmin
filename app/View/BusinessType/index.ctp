<div class="container-fluid">
    <a href="javascript:void(0);" class="btn btn-primary btn-primary pull-right addbusinesstype"><span class="glyphicon glyphicon-edit"></span>Add Business Type</a>
</div>
<div class="container-fluid addBusinessTypeForm" style="display: none;">
    <?php echo $this->Form->create('BusinessType', array('class' => 'form-horizontal businesstypeForm', 'id' => 'addBusinessType', 'name' => 'business_type')); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">Name:</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('name', array('id' => 'name', 'placeholder' => 'Enter Business Type name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control bname')); ?>
                    </div>
                </div>
            <?php echo $this->Form->input('id', array('type' => 'hidden',  'id' => 'id', 'placeholder' => 'Enter Business Type name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control businesstypeid')); ?>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">Business Nature:</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('business_nature_id', array('id' => 'business_nature_id',
                'label' => false,
                'div' => false,
                'legend' => false,
                'empty' => __d('label', '--Select--'),
                'class' => 'business_nature form-control',
                'tabindex'=> '10',
                'style' => '',
                'options' => $businessNatures,
                'value' => $businessNature
            )); ?>
                    </div>
                </div>
            <?php echo $this->Form->input('id', array('type' => 'hidden',  'id' => 'id', 'placeholder' => 'Enter Business Type name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control businesstypeid')); ?>
        </div>
    
            <div class="col-lg-2 col-md-1 col-xs-2">
                <div class="form-actions">
                    <div class="col-lg-2 col-md-1 col-xs-1">
                        <button type="button" class="btn btn-primary bgButton">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
</div>
<div class="container-fluid">   
<h3 class="heading">Business Types</h3>
<table id="getBusinessType" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Business Nature</th>
        <th>Status</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
    </div>
<?php echo $this->Html->script(array('Master/business_type_lists')); ?>