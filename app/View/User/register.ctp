<div class="container-fluid">
    <?php echo $this->Form->create('User', array('class' => 'form-horizontal registerForm', 'id' => 'registerUser', 'name' => 'register')); ?>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">First name:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('first_name', array('id' => 'first_name', 'placeholder' => 'Enter First Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="last_name">Last name:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('last_name', array('id' => 'last_name', 'placeholder' => 'Enter Last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">	
                 <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="phone_number">Phone:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('phone_number', array('id' => 'phone_number', 'placeholder' => 'Contact number' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="website">Website:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('website', array('id' => 'website', 'placeholder' => 'Enter website' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="email">Email id:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('email', array('id' => 'email', 'placeholder' => 'Enter email' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="password">Password:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                       <?php echo $this->Form->input('password', array('id' => 'password', 'placeholder' => 'Enter password' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="confirm_password">Confirm Password:</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('confirm_password', array('id' => 'confirm_password', 'type'=> 'password','placeholder' => 'Enter Password Again' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>

<!--            <div class="col-lg-6 col-md-6 col-xs-12">
                
            </div>-->
            <div class="col-lg-6 col-md-6 col-xs-12">
                 
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="gender">Gender</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
                         $genderOptions = array(
                    'male' => 'Male',
                    'female' => 'Female'
                    
                );
            echo $this->Form->input('gender', array('id' => 'gender',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 't',
                'style' => '',
                'options' => $genderOptions
            ));
            ?>
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
<?php echo $this->Html->script(array('User/register')); ?>