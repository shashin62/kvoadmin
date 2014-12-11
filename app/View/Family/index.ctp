<div class="container-fluid">
    <h3 class="heading"><?php echo $pageTitle;?></h3>
    <?php echo $this->Form->create('People', array('class' => 'form-horizontal peopleForm', 'id' => 'createFamily', 'name' => 'register')); ?>
    <div class="row-fuild">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default <?php echo $title == 'deravasi' ? 'active' : '';?>">
                <input type="radio" name="title" <?php echo $title == 'deravasi' ? 'checked=checked' : '';?> value="deravasi">Deravasi
            </label>
            <label class="btn btn-default <?php echo $title == 'sthanakvasi' ? 'active' : '';?>">
                <input type="radio" name="title" <?php echo $title == 'sthanakvasi' ? 'checked=checked' : '';?> value="sthanakvasi">Sthanakvasi
            </label>
            <label class="btn btn-default <?php echo $title == 'other' ? 'active' : '';?>">
                <input type="radio" name="title" <?php echo $title == 'other' ? 'checked=checked' : '';?> value="other">Other
            </label>
        </div>
    </div>
    <br>
    <div class="row-fuild">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default <?php echo $gender == 'male' ? 'active' : '';?>">
                <input type="radio" name="gender" <?php echo $gender == 'male' ? 'checked=checked' : '';?> value="male">Male
            </label>
            <label class="btn btn-default <?php echo $gender == 'female' ? 'active' : '';?>">
                <input type="radio" name="gender" <?php echo $gender == 'female' ? 'checked=checked' : '';?> value="female">Female
            </label>
        </div>
    </div>
    <br>
    <div class="row-fuild">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default <?php echo $martial_status == 'Unmarried' ? 'active' : '';?>">
                <input type="radio" name="martial_status" <?php echo $martial_status == 'Unmarried' ? 'checked=checked' : '';?> value="unmarried">Unmarried
            </label>
            <label class="btn btn-default <?php echo $martial_status == 'Married' ? 'active' : '';?>">
                <input type="radio" name="martial_status" <?php echo $martial_status == 'Married' ? 'checked=checked' : '';?> value="Married">Married
            </label>
            <label class="btn btn-default <?php echo $martial_status == 'Divorced' ? 'active' : '';?>">
                <input type="radio" name="martial_status" <?php echo $martial_status == 'Divorced' ? 'checked=checked' : '';?> value="Divorced">Divorced
            </label>
            <label class="btn btn-default <?php echo $martial_status == 'Separated' ? 'active' : '';?>">
                <input type="radio" name="martial_status" <?php echo $martial_status == 'Separated' ? 'checked=checked' : '';?> value="Separated">Separated
            </label>
            <label class="btn btn-default <?php echo $martial_status == 'Widow' ? 'active' : '';?>">
                <input type="radio" name="martial_status" <?php echo $martial_status == 'Widow' ? 'checked=checked' : '';?> value="Widow">Widow
            </label>
            <label class="btn btn-default <?php echo $martial_status == 'Single' ? 'active' : '';?>">
                <input type="radio" name="status" <?php echo $martial_status == 'Single' ? 'checked=checked' : '';?> value="single">Single
            </label>
        </div>
    </div>
    <br>
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
                        <?php echo $this->Form->input('last_name', array('id' => 'last_name', 'readonly' => $readonly,'value'=> $last_name,'placeholder' => 'Enter Last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group"><label class="col-lg-4 col-md-4 col-xs-4 control-label" for="gender">DOB</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
               <?php echo $this->Form->input('date_of_birth', 
                       array('id' => 'date_of_birth', 'value'=> $date_of_birth,'type' => 'text','title' => '','div' => false, 'label' => false, 'class' => 'dp form-control')); ?>
                </div>
            </div>            
            <div class="form-group"><label class="col-lg-4 col-md-4 col-xs-4 control-label" for="gender">Marraige Date</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
               <?php echo $this->Form->input('date_of_marriage', 
                       array('id' => 'date_of_marriage', 'type' => 'text','value'=> $date_of_marriage,'title' => '','div' => false, 'label' => false, 'class' => 'dp form-control')); ?>
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
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="website">Surname at birth:</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('surname_dob', array('id' => 'surname_dob','value'=> $surname_dob, 'placeholder' => 'Enter dob surname' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="mahajan_membership_number">Mahajan #</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
               <?php echo $this->Form->input('mahajan_membership_number', 
                       array('id' => 'mahajan_membership_number', 'value'=> $mahajan_membership_number,'type' => 'text','title' => '','div' => false, 'label' => false, 'class' => 'dp form-control')); ?>
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
                'class' => 'selectpicker',
                'style' => '',
                'disabled' => $readonly,
                'options' => $villages,
                'value' => $village
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
                'class' => 'selectpicker',
                'style' => '',
                'options' => $educations,
                'value' => $education
            ));
            ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="blood_group">Blood Group</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
                        
            echo $this->Form->input('blood_group', array('id' => 'blood_group',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 'selectpicker',
                'style' => '',
                'options' => $bloodgroups,
                'value' => $blood_group
            ));
            ?>
                </div>
            </div>
            <div class="form-group">
							<div class="col-lg-4 col-md-4 col-xs-4 control-label"></div>
							<div class="checkbox col-lg-8 col-md-8 col-xs-8">
								<label>
                                                                    <?php echo $this->Form->input("is_late", array('type' => "checkbox", 'div' => false, "label" => array('class' => 'checkboxLabel', 'text' => __('Late')))); ?>
								</label>
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

<script type="text/javascript">
    var pid = '<?php echo $pid; ?>';
    var userType = '<?php echo $userType; ?>';
</script>
<script>
    $(function () {
        $("#date_of_birth").datepicker({
            format: "yyyy-mm-dd",
        });
        $('.dp').on('change', function () {
            $('.datepicker').hide();
        });
        $("#date_of_marriage").datepicker({
            format: "yyyy-mm-dd"
        });
    });
</script>
<?php echo $this->Html->script(array('Family/family_self_edit')); ?>