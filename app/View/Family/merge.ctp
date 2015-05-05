<div class="container-fluid">
    <div class="row-fluid">
        <div class="container-fluid">
            <h3 class="heading">Merge Records</h3>

				<?php echo $this->Form->create('People', array('class' => 'form-horizontal peopleForm', 'id' => 'createFamily', 'name' => 'register')); ?>

            <div class="addresscontainer">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="first_name">Enter First ID</label>
                            <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-lg-7 col-md-7 col-xs-7">
                                <input name="data[][]" id="" tabindex="1" value="" placeholder="Enter ID" title="" class="form-control" type="text"/></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="first_name">Enter First ID</label>
                            <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-lg-7 col-md-7 col-xs-7">
                                <input name="data[][]" id="" tabindex="2" value="" placeholder="Enter ID" title="" class="form-control" type="text"/></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-xs-3">&nbsp;</div>
                        <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-lg-7 col-md-7 col-xs-7">
                            <button type="button" class="btn btn-primary addressButton">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-xs-3">&nbsp;</div>
                        <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-lg-7 col-md-7 col-xs-7">
                            <button type="button" class="btn btn-primary addressButton">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="addresscontainer" style="display:block">
                <div class="row">
                    <div class="col-lg-6 col-md-6 first_box">
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="wing">First Name</label>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="first_name_radio">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                                <input name="first_name" id="wing" tabindex="2" value="" placeholder="" title="" class="form-control" maxlength="255" type="text"/>
                            </div>
                        </div>
                        
                        <div class="form-group required">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">Gender</label>  
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="gender_radio">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                                <div class="btn-group genders" data-toggle="buttons">
                                    <label class="btn btn-default <?php echo $gender == 'male' ? 'active' : '';?>">
                                        <input type="radio" name="gender" class="gender" <?php echo $gender == 'male' ? 'checked=checked' : '';?> value="male">Male
                                    </label>
                                    <label class="btn btn-default <?php echo $gender == 'female' ? 'active' : '';?>">
                                        <input type="radio" name="gender" class="gender" <?php echo $gender == 'female' ? 'checked=checked' : '';?> value="female">Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="last_name">Used Surname</label>
                                 <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="last_name_radio">
                            </div>
				  <div class="col-lg-7 col-md-7 col-xs-7">
				<?php echo $this->Form->input('last_name', array('id' => 'last_name', 'value'=> $last_name,'placeholder' => 'Enter Last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
				</div>
			</div>

			<div class="form-group required main_surnamediv">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label"  for="main_surname">Main Surname</label>
				<div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="main_surname_radio">
                            </div>  
                                <div class="col-lg-7 col-md-7 col-xs-7">

				<?php

				echo $this->Form->input('main_surname', array('id' => 'main_surname',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'main_surname combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => $main_surnames,
				'value' => $main_surname

				));
				?>
				</div>
			</div>

			<div class="form-group villagediv">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="village">Village</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=village_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">

				<?php

				echo $this->Form->input('village', array('id' => 'village',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'village combobox',
				'style' => '',
				'disabled' => $readonly,
				'options' => $villages,
				'value' => $village
				));
				?>
				</div>
			</div>
                        <div class="form-group">
				<label  class="col-lg-3 col-md-3 col-xs-3 control-label" for="email">Email ID</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=email_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('email', array('id' => 'email', 'value'=> $email,'placeholder' => 'Enter Email ID' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">DOB</label>   
                                 <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=date_of_birth_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('date_of_birth', 
						array('id' => 'date_of_birth', 'value'=> $date_of_birth,'type' => 'text','title' => '','placeholder' => 'enter in dd/mm/yyyy format' ,'div' => false, 'label' => false, 'class' => 'dp form-control')); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="mobile_number">Mobile Number</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=mobile_number_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('mobile_number', array('id' => 'mobile_number', 'value'=> $mobile_number,'placeholder' => 'Enter Mobile Number' ,'title' => '','div' => false, 'label' => false, 'class' => 'phone_number form-control')); ?>
				</div>
			</div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 second_box">
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="wing">First Name</label>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="first_name_radio">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                                <input name="data[][]" id="wing" tabindex="2" value="" placeholder="" title="" class="form-control" maxlength="255" type="text"/>
                            </div>
                        </div>
                         <div class="form-group required">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">Gender</label>  
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="gender_radio">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                                <div class="btn-group genders" data-toggle="buttons">
                                    <label class="btn btn-default <?php echo $gender == 'male' ? 'active' : '';?>">
                                        <input type="radio" name="gender" class="gender" <?php echo $gender == 'male' ? 'checked=checked' : '';?> value="male">Male
                                    </label>
                                    <label class="btn btn-default <?php echo $gender == 'female' ? 'active' : '';?>">
                                        <input type="radio" name="gender" class="gender" <?php echo $gender == 'female' ? 'checked=checked' : '';?> value="female">Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="last_name">Used Surname</label>
                                 <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="last_name_radio">
                            </div>
				  <div class="col-lg-7 col-md-7 col-xs-7">
				<?php echo $this->Form->input('last_name', array('id' => 'last_name', 'value'=> $last_name,'placeholder' => 'Enter Last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
				</div>
			</div>

			<div class="form-group required main_surnamediv">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label"  for="main_surname">Main Surname</label>
				<div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="main_surname_radio">
                            </div>  
                                <div class="col-lg-7 col-md-7 col-xs-7">

				<?php

				echo $this->Form->input('main_surname', array('id' => 'main_surname',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'main_surname combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => $main_surnames,
				'value' => $main_surname

				));
				?>
				</div>
			</div>

			<div class="form-group villagediv">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="village">Village</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=village_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">

				<?php

				echo $this->Form->input('village', array('id' => 'village',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'village combobox',
				'style' => '',
				'disabled' => $readonly,
				'options' => $villages,
				'value' => $village
				));
				?>
				</div>
			</div>
                        <div class="form-group">
				<label  class="col-lg-3 col-md-3 col-xs-3 control-label" for="email">Email ID</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=email_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('email', array('id' => 'email', 'value'=> $email,'placeholder' => 'Enter Email ID' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">DOB</label>   
                                 <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=date_of_birth_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('date_of_birth', 
						array('id' => 'date_of_birth', 'value'=> $date_of_birth,'type' => 'text','title' => '','placeholder' => 'enter in dd/mm/yyyy format' ,'div' => false, 'label' => false, 'class' => 'dp form-control')); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="mobile_number">Mobile Number</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=mobile_number_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('mobile_number', array('id' => 'mobile_number', 'value'=> $mobile_number,'placeholder' => 'Enter Mobile Number' ,'title' => '','div' => false, 'label' => false, 'class' => 'phone_number form-control')); ?>
				</div>
			</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-xs-3">&nbsp;</div>
                        <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-lg-7 col-md-7 col-xs-7">
                            <button type="button" class="btn btn-primary addressButton">Merge</button>
                            <button type="button" style="color: red" class="btn btn-link cancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            </form>
        </div>

    </div>
</div>
<?php echo $this->Html->script(array('Family/merge')); ?>