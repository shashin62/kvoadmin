<?php
echo $this->Html->charset('utf-8');?>
<div class="container-fluid">
    <a href="javascript:void(0);" class="btn btn-primary btn-primary pull-right addZipCode"><span class="glyphicon glyphicon-edit"></span>Add Zip Codes</a>
</div>
<div class="container-fluid addZipcodeForm" style="display: none;">
    <?php echo $this->Form->create('ZipCode', array('class' => 'form-horizontal ZipCodeForm', 'id' => 'addZipCodes', 'name' => 'zipcode')); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="zip_code">Zip code:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('zip_code', array('id' => 'zip_code', 'placeholder' => 'Enter zip code' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control bname')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="suburb">suburb:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('suburb', array('id' => 'suburb', 'placeholder' => 'Enter suburb' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control suburb')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="zone">zone:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('zone', array('id' => 'zone', 'placeholder' => 'Enter zone' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control zone')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="city">city:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('city', array('id' => 'city', 'placeholder' => 'Enter city' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control city')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="state">state:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('state', array('id' => 'state', 'placeholder' => 'Enter state' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control state')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="std">std:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('std', array('id' => 'std', 'placeholder' => 'Enter std' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control std')); ?>
                </div>
            </div>
            <?php echo $this->Form->input('id', array('type' => 'hidden',  'id' => 'id', 'placeholder' => 'Enter Education name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control zipcodeid')); ?>
        </div>
    </div>

    <div class="row">
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
    <h3 class="heading">Zip Codes</h3>
    <table id="getZipcode" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Zip Code</th>
                <th>suburb</th>
                <th>zone</th>
                <th>city</th>
                <th>state</th>
                <th>std</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<?php echo $this->Html->script(array('Master/zips')); ?>