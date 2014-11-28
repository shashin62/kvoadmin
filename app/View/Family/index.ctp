<div class="container-fluid">
    <h3 class="heading">Create your family - edit your Details</h3>
    <?php echo $this->Form->create('People', array('class' => 'form-horizontal peopleForm', 'id' => 'createFamily', 'name' => 'register')); ?>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">First name:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('first_name', array('id' => 'first_name', 'value'=> $first_name,'placeholder' => 'Enter First Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="last_name">Last name:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('last_name', array('id' => 'last_name', 'value'=> $last_name,'placeholder' => 'Enter Last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="gender">Martial Status</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
                         $martialStatusOptions = array(
                    'Unmarried' => 'Unmarried',
                    'Married' => 'Married',
                    'Divorced' => 'Divorced',
                    'Separated' => 'Separated',         
                    'Single' => 'Single',
                );
            echo $this->Form->input('martial_status', array('id' => 'martial_status',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 't',
                'style' => '',
                'options' => $martialStatusOptions,
                'value' => $martial_status
            ));
            ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">	
                 <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="phone_number">Phone:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('phone_number', array('id' => 'phone_number', 'value'=> $phone_number,'placeholder' => 'Contact number' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="website">Surname now:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('surname_now', array('id' => 'surname_now','value'=> $surname_now, 'placeholder' => 'Enter present surname' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="website">Surname at birth:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('surname_dob', array('id' => 'surname_dob','value'=> $surname_dob, 'placeholder' => 'Enter dob surname' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="village">Village</label>   
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
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="email">Email id:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('email', array('id' => 'email', 'value'=> $email,'placeholder' => 'Enter email' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="education">Education</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
                        
            echo $this->Form->input('education', array('id' => 'education',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 't',
                'style' => '',
                'options' => $educations
            ));
            ?>
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
                'options' => $genderOptions,
                'value' => $gender
            ));
            ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="education">State</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
                        
            echo $this->Form->input('state', array('id' => 'state',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 't',
                'style' => '',
                'options' => $states,
                'value' => $state
            ));
            ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="blood_group">Blood Group</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
                        
            echo $this->Form->input('blood_group', array('id' => 'blood_group',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 't',
                'style' => '',
                'options' => $bloodgroups,
                'value' => $blood_group
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
                        <button type="button" class="btn btn-primary editOwnButton">Save and Continue</button>
                    </div>
                </div>
            </div>
        </div>

    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Html->script(array('Family/family_self_edit')); ?>