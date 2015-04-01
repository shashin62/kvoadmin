<?php
echo $this->Html->charset('utf-8');
$ansNo = 5;
?>
<div class="container-fluid">
    <a href="javascript:void(0);" class="btn btn-primary btn-primary pull-right addPoll"><span class="glyphicon glyphicon-edit"></span>Add Poll</a>
</div>
<div class="container-fluid addPollForm" style="display: none;">
    <?php echo $this->Form->create('Poll', array('class' => 'form-horizontal PollForm', 'id' => 'addPolls', 'name' => 'poll')); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="name">Poll Question:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('name', array('id' => 'name', 'placeholder' => 'Enter Poll Question' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control bname')); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="control_type">Control Type</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
                    <div class="btn-group control_types" data-toggle="buttons">
                        <label  class="btn btn-default">
                            <input type="radio" name="control_type" id="control_type_1" value="radio">Radio
                        </label>
                        <label  class="btn btn-default">
                            <input type="radio" name="control_type" id="control_type_2" value="checkbox">CheckBox
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label">Answers:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                        <button type="button" class="btn btn-primary addnew" id="btnAddAnswer">Add New Answer</button>
                </div>
            </div>
            <div id="answers">
            <?php
            for ($i = 1; $i<=$ansNo; $i++) {
            ?>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="answer_<?php echo $i;?>"></label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('answer_'.$i, array('id' => 'answer_'.$i, 'placeholder' => 'Enter Answer '.$i ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control bname')); ?>
                </div>
            </div>
            <?php } ?>
            </div>
            <?php echo $this->Form->input('ans_no', array('type' => 'hidden',  'id' => 'ans_no', 'value' => $ansNo, 'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden',  'id' => 'id' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control pollid')); ?>
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
    <h3 class="heading">Polls</h3>
    <table id="getPoll" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<?php echo $this->Html->script(array('Master/polls')); ?>
