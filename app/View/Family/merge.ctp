<div class="container-fluid">
    <div class="row-fluid">
        <div class="container-fluid">
            <h3 class="heading">Merge Records</h3>

				<?php echo $this->Form->create('People', array('class' => 'form-horizontal peopleForm', 'id' => 'createFamily', 'name' => 'register')); ?>

            <div class="addresscontainer">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="first_id">Enter First ID</label>
                            <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-lg-7 col-md-7 col-xs-7">
                                <input name="firstId" id="" tabindex="1" value="" placeholder="Enter ID" title="" class="form-control firstId" type="text"/></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="first_name">Enter Second ID</label>
                            <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-lg-7 col-md-7 col-xs-7">
                                <input name="secondId" id="" tabindex="2" value="" placeholder="Enter ID" title="" class="form-control secondId" type="text"/></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-xs-3">&nbsp;</div>
                        <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-lg-7 col-md-7 col-xs-7">
                            <button type="button" class="btn btn-primary submitButton1">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-xs-3">&nbsp;</div>
                        <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-lg-7 col-md-7 col-xs-7">
                            <button type="button" class="btn btn-primary submitButton2">Submit</button>
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
                                <input name="data[People][first_name]" id="wing" tabindex="2" value="" placeholder="" title="" class="form-control first_name_first" maxlength="255" type="text"/>
                            </div>
                        </div>
                        
                        <div class="form-group required genderdiv_first">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">Gender</label>  
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="gender_radio" data-d="gender_first">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                               
				<?php

				echo $this->Form->input('gender', array('id' => 'gender',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'gender_first combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => array('male' => 'Male','female' => 'Female')

				));
				?>
				</div>
                        </div>
                        
                        
                         <div class="form-group required martial_statusdiv_first">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">Martial Status</label>  
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="martial_status_radio" data-d="martial_status_first">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                               
				<?php

				echo $this->Form->input('martial_status', array('id' => 'martial_status',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'martial_status_first combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => array('Married' => 'Married','Divorced' => 'Divorced','Sepereated'=> 'Seperated','Widow'=> 'Widow','Single' => 'Single')

				));
				?>
				</div>
                        </div>
                        
                        
                        <div class="form-group required sectdiv_first">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">Sect</label>  
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="sect_radio" data-d="sect_first">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                               
				<?php
                                $sectOptions = array('deravasi','sthanakvasi','other');
				echo $this->Form->input('sect', array('id' => 'sect',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'sect_first combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => $sectOptions

				));
				?>
				</div>
                            
                           
                        </div>
                        
                        
                        <div class="form-group required">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="last_name">Used Surname</label>
                                 <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="last_name_radio">
                            </div>
				  <div class="col-lg-7 col-md-7 col-xs-7">
				<?php echo $this->Form->input('last_name', array('id' => 'last_name', 'value'=> $last_name,'placeholder' => 'Enter Last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control last_name_first')); ?>
				</div>
			</div>

			<div class="form-group required main_surnamediv_first">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label"  for="main_surname">Main Surname</label>
				<div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="main_surname_radio" data-d="main_surname_first">
                            </div>  
                                <div class="col-lg-7 col-md-7 col-xs-7">

				<?php

				echo $this->Form->input('main_surname', array('id' => 'main_surname',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'main_surname_first combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => $main_surnames,
				'value' => $main_surname

				));
				?>
				</div>
			</div>

			<div class="form-group villagediv_first">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="village">Village</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=village_radio data-d="village_first">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">

				<?php

				echo $this->Form->input('village', array('id' => 'village',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'village_first combobox',
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
                                <input type="radio" name=email_radio>
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('email', array('id' => 'email', 'value'=> $email,'placeholder' => 'Enter Email ID' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control email_first')); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">DOB</label>   
                                 <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=date_of_birth_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('date_of_birth', 
						array('id' => 'date_of_birth', 'value'=> $date_of_birth,'type' => 'text','title' => '','placeholder' => 'enter in dd/mm/yyyy format' ,'div' => false, 'label' => false, 'class' => 'dp form-control date_of_birth_first')); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="mobile_number">Mobile Number</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=mobile_number_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('mobile_numbert', array('id' => 'mobile_number', 'value'=> $mobile_number,'placeholder' => 'Enter Mobile Number' ,'title' => '','div' => false, 'label' => false, 'class' => 'phone_number form-control mobile_number_first')); ?>
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
                                <input name="data[People][first_name]" id="wing" tabindex="2" value="" placeholder="" title="" class="form-control first_name_second" maxlength="255" type="text"/>
                            </div>
                        </div>
                         <div class="form-group required genderdiv_second">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">Gender</label>  
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="gender_radio" data-d="gender_second">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                               
				<?php

				echo $this->Form->input('gender', array('id' => 'gender',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'gender_second combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => array('male' => 'Male','female' => 'Female')

				));
				?>
				</div>
                        </div>
                        
                        <div class="form-group required martial_statusdiv_second">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="martial_status">Martial Status</label>  
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="martial_status_radio" data-d="martial_status_second">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                               
				<?php

				echo $this->Form->input('martial_status', array('id' => 'martial_status',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'martial_status_second combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => array('Married' => 'Married','Divorced' => 'Divorced','Sepereated'=> 'Seperated','Widow'=> 'Widow','Single' => 'Single')

				));
				?>
				</div>
                        </div>
                        
                        <div class="form-group required sectdiv_second">
                            <label class="col-lg-3 col-md-3 col-xs-3 control-label" for="sect">Sect</label>  
                            <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="sect_radio" data-d="sect_second">
                            </div>
                            <div class="col-lg-7 col-md-7 col-xs-7">
                               
				<?php
                                $sectOptions = array('deravasi','sthanakvasi','other');
				echo $this->Form->input('sect', array('id' => 'sect',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'sect_second combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => $sectOptions

				));
				?>
				</div>
                        
                        </div>
                        <div class="form-group required">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="last_name">Used Surname</label>
                                 <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="last_name_radio">
                            </div>
				  <div class="col-lg-7 col-md-7 col-xs-7">
				<?php echo $this->Form->input('last_name', array('id' => 'last_name', 'value'=> $last_name,'placeholder' => 'Enter Last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control last_name_second')); ?>
				</div>
			</div>

			<div class="form-group required main_surnamediv_second">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label"  for="main_surname">Main Surname</label>
				<div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name="main_surname_radio" data-d="main_surname_second">
                            </div>  
                                <div class="col-lg-7 col-md-7 col-xs-7">

				<?php

				echo $this->Form->input('main_surname', array('id' => 'main_surname',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'main_surname_second combobox',
				'style' => '',
				//'disabled' => $readonly,
				'options' => $main_surnames,
				'value' => $main_surname

				));
				?>
				</div>
			</div>

			<div class="form-group villagediv_second">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="village">Village</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=village_radio data-d="village_second">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">

				<?php

				echo $this->Form->input('village', array('id' => 'village',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
				'class' => 'village_second combobox',
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
                                <input type="radio" name=email_radio>
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('email', array('id' => 'email', 'value'=> $email,'placeholder' => 'Enter Email ID' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control email_second')); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="gender">DOB</label>   
                                 <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=date_of_birth_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('date_of_birth', 
						array('id' => 'date_of_birth', 'value'=> $date_of_birth,'type' => 'text','title' => '','placeholder' => 'enter in dd/mm/yyyy format' ,'div' => false, 'label' => false, 'class' => 'dp form-control date_of_birth_second')); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 col-md-3 col-xs-3 control-label" for="mobile_number">Mobile Number</label>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                <input type="radio" name=mobile_number_radio">
                            </div>  
				<div class="col-lg-7 col-md-7 col-xs-7">
					<?php echo $this->Form->input('mobile_number', array('id' => 'mobile_number', 'value'=> $mobile_number,'placeholder' => 'Enter Mobile Number' ,'title' => '','div' => false, 'label' => false, 'class' => 'phone_number form-control mobile_number_second')); ?>
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
                            <button type="button" class="btn btn-primary mergeButton">Merge</button>
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