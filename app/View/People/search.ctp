<div class="container-fluid">
    <h3 class="heading">Search People</h3>
    <?php echo $this->Form->create('People', array('class' => 'form-horizontal searchForm', 'id' => 'search', 'name' => 'register')); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">First Name</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('first_name', array('id' => 'first_name', 'placeholder' => 'Enter First Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control search_username','custom'=>"1")); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="mobile_number">Mobile number</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('mobile_number', array('id' => 'mobile_number', 'placeholder' => 'Enter Mobile' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control search_username','custom'=>"3")); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="last_name">Last Name</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('last_name', array('id' => 'last_name', 'placeholder' => 'Enter last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control search_username','custom'=>"2")); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="village">Village</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('village', array('id' => 'village', 'type' => 'text','placeholder' => 'Enter village' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control search_username','custom'=>"5")); ?>
                </div>
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            
       
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="date_of_birth">DOB</label>   
                <div class="col-lg-4 col-md-4 col-xs-4">
                         <?php echo $this->Form->input('date_of_birth', 
                       array('id' => 'date_of_birth', 'type' => 'text','title' => '','div' => false, 'label' => false, 'class' => 'dp form-control search_DOB','custom'=>"4")); ?>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-actions">
                <div class="col-lg-4 col-md-4 col-xs-4">&nbsp;</div>
                <div class="col-lg-8 col-md-8 col-xs-8">
<!--                    <button type="button" class="btn btn-primary registerButton">Submit</button>-->
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>
<div class="container-fluid">   
<h3 class="heading">Search Result</h3>
<table id="all_users" class="display" cellspacing="0" width="100%">
    <thead>
   <tr>
                        <th></th>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Village</th>
                        <th>Phone</th>
                        <th>DOB</th>
                    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
    </div>
<script>
    $(function () {
        $("#date_of_birth").datepicker({
            format: "dd/mm/yyyy",
        });
        $('.dp').on('change', function () {
            $('.datepicker').hide();
        });

    });
</script>
<?php echo $this->Html->script(array('Family/search')); ?>