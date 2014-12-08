<div class="container-fluid">
    <h3 class="heading">Search People</h3>
    <?php echo $this->Form->create('People', array('class' => 'form-horizontal searchForm', 'id' => 'search', 'name' => 'register')); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">First name:</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('first_name', array('id' => 'first_name', 'placeholder' => 'Enter First Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="last_name">Father:</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('father', array('id' => 'father', 'placeholder' => 'Enter fathers Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">	
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="surname_now">Surname:</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('surname_now', array('id' => 'surname_now', 'placeholder' => 'Enter surname' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="website">Mother:</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('mother', array('id' => 'mother', 'placeholder' => 'Enter mother name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="email">GrandFather:</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('grand_father', array('id' => 'grand_father', 'placeholder' => 'Enter Grand father name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="village">Village:</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                       <?php
                        
            echo $this->Form->input('village', array('id' => 'village',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 't',
                'style' => '',
                'options' => $villages
            ));
            ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="email">Email:</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('email', array('id' => 'email', 'type' => 'email','placeholder' => 'Enter Email' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="email">Search Type:</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
                    <input type="radio" name="search_type" value="exact">Exact
                    <input type="radio" name="search_type" value="like">Like
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="date_of_birth">DOB</label>   
                <div class="col-lg-4 col-md-4 col-xs-4">
                         <?php echo $this->Form->input('date_of_birth', 
                       array('id' => 'date_of_birth', 'type' => 'text','title' => '','div' => false, 'label' => false, 'class' => 'dp form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="phone_number">Phone:</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('phone_number', array('id' => 'phone_number','placeholder' => 'Contact number' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-actions">
                <div class="col-lg-4 col-md-4 col-xs-4">&nbsp;</div>
                <div class="col-lg-8 col-md-8 col-xs-8">
                    <button type="button" class="btn btn-primary registerButton">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>
<script>
    $(function () {
        $("#date_of_birth").datepicker({
            format: "yyyy-mm-dd",
        });
        $('.dp').on('change', function () {
            $('.datepicker').hide();
        });

    });
</script>
<?php echo $this->Html->script(array('Family/search')); ?>