<?php 
echo $this->Html->charset('utf-8');?>
<div class="container-fluid">
    <a href="javascript:void(0);" class="btn btn-primary btn-primary pull-right addtranslation"><span class="glyphicon glyphicon-edit"></span>Add Translation</a>
</div>
<div class="container-fluid addTranslationForm" style="display: none;">
    <?php echo $this->Form->create('Translation', array('class' => 'form-horizontal translationForm', 'id' => 'addTranslations', 'name' => 'education')); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">Name:</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('name', array('id' => 'name', 'placeholder' => 'Enter translation name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control bname')); ?>
                    </div>
                </div>
<div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">Gujurathi:</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('gujurathi_text', array('id' => 'gujurathi_text', 'placeholder' => 'Enter translation name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control gujurathiname')); ?>
                    </div>
                </div>
<div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">Hindi:</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('hindi_text', array('id' => 'hindi_text', 'placeholder' => 'Enter translation name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control hindiname')); ?>
                    </div>
                </div>
            <?php echo $this->Form->input('id', array('type' => 'hidden',  'id' => 'id', 'placeholder' => 'Enter Education name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control translationid')); ?>
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
<h3 class="heading">Translations</h3>
<table id="getTranslation" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Gujurathi</th>
        <th>Hindi</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
    </div>
<?php echo $this->Html->script(array('Master/translations')); ?>