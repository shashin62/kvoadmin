<style type="text/css">
.date_of_birth_from,.date_of_birth_to {
width: 90px !important;
}
</style>
<div class="container-fluid">   
      <h3 class="heading">Records</h3>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="fromdate">Person Status</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php
$personstatus = array(0 => 'Alive',1 => 'Late');
				echo $this->Form->input('is_late', array('id' => 'example-single',
				'label' => false,
				'div' => false,
				'legend' => false,
				'multiple' 		 => 'multiple',	
				'class' => 'islate',
				'style' => '',				
				'options' => $personstatus

				));
				?>
                </div>
            </div>
           
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="sect">Sect</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php
                    $sects = array('deravasi' => 'Deravasi','sthanakvasi' => 'Sthanakvasi','other' => 'Other');
				echo $this->Form->input('sect', array('id' => 'example-checkboxName',
				'label' => false,
				'div' => false,
				'legend' => false,				
				'class' => 'sects',
				'style' => '',	
                                'multiple' => 'multiple',		
				'options' => $sects

				));
				?>
                </div>
            </div>
        </div>

    </div>
    <br />
<div class="row">

<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="businessname">Business type</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('sect', array('id' => 'example-checkboxNames',
				'label' => false,
				'div' => false,
				'legend' => false,				
				'class' => 'businestypesname',
				'style' => '',	
                                'multiple'  => 'multiple',				
				'options' => $businesstypename

				));
				?>
                </div>
            </div>
        </div>
		<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="nature_of_business">Nature of Business</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('sect', array('id' => 'natureofbusiness',
				'label' => false,
				'div' => false,
				'legend' => false,
                                'multiple'  => 'multiple',				
				'class' => 'nature_of_business',
				'style' => '',				
				'options' => $nature_of_business
				));
				?>
                </div>
            </div>
        </div>
		</div>
		 <br />
		 <div class="row">
			<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="martial_status">Martial Status</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php
                                $martial_status = array('single' => 'Single','married' => 'Married','other' => 'Other','Widow' => 'Widow','Separated'=> 'Separated');
				echo $this->Form->input('sect', array('id' => 'martial_status',
				'label' => false,
				'div' => false,
				'legend' => false,
                                'multiple'  => 'multiple',				
				'class' => 'martial_status',
				'style' => '',				
				'options' => $martial_status
				));
				?>
                </div>
            </div>
        </div>
		<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="specialty_business_service">Speciality Business Service</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('sect', array('id' => 'specialty_business_service',
				'label' => false,
				'div' => false,
				'legend' => false,
                                'multiple'  => 'multiple',				
				'class' => 'specialty_business_service',
				'style' => '',				
				'options' => $specialty_business_service

				));
				?>
                </div>
            </div>
        </div>
		
		</div>
		 <br />
		 <div class="row">
			<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="occupation">Occupation</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('sect', array('id' => 'occupation',
				'label' => false,
				'div' => false,
				'legend' => false,
                                 'multiple'  => 'multiple',				
				'class' => 'occupation',
				'style' => '',				
				'options' => $occupation

				));
				?>
                </div>
            </div>
        </div>
		<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="gender">Gender</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php
                            $gender = array('male' => 'Male','female' => 'Female');
				echo $this->Form->input('sect', array('id' => 'gender',
				'label' => false,
				'div' => false,
				'legend' => false,
                                'multiple'  => 'multiple',
				
				'class' => 'gender',
				'style' => '',				
				'options' => $gender

				));
				?>
                </div>
            </div>
        </div>
		</div>
		 <br />
		 <div class="row">
<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="village">Village</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('sect', array('id' => 'village',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
 'multiple'  => 'multiple',
				'class' => 'village',
				'style' => '',				
				'options' => $villages

				));
				?>
                </div>
            </div>
        </div>
		<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-2 col-md-2 col-xs-2 control-label" for="date_of_birth">Age</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php
				echo $this->Form->input('sect', array('id' => 'date_of_birth',
				'label' => 'From',
				'div' => false,
				'legend' => false,
				'empty' => '',
				'class' => 'selectpicker date_of_birth_from',

				'style' => '',				
				'options' => array_combine(range(18,70), range(18,70))

				));
				?>
<?php
				echo $this->Form->input('sect', array('id' => 'date_of_birthfrom',
				'label' => 'To',
				'div' => false,
				'legend' => false,
				'empty' => '',
				'class' => 'selectpicker date_of_birth_to',

				'style' => 'width: 20px',				
				'options' => array_combine(range(18,70), range(18,70))

				));
				?>
                </div>
            </div>
        </div>
		</div>
		<br />
		 <div class="row">
                 <div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="home_city">Home City</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('home_city', array('id' => 'homecity',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
                                'multiple'  => 'multiple',
				'class' => 'home_city',
				'style' => '',				
				'options' => $city

				));
				?>
                </div>
            </div>
        </div>
<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="home_state">Home State</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('home_state', array('id' => 'homestate',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
                                'multiple'  => 'multiple',
				'class' => 'home_state',
				'style' => '',				
				'options' => $state

				));
				?>
                </div>
            </div>
        </div>
		 </div>
		 <br />
 <div class="row">
<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="home_suburb">Home Suburb</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('home_suburb', array('id' => 'homesuburb',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
                                'multiple'  => 'multiple',
				'class' => 'home_suburb',
				'style' => '',				
				'options' => $suburb

				));
				?>
                </div>
            </div>
        </div>
 <br />
 <div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="home_city">Busniess City</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('home_city', array('id' => 'businesscity',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
                                'multiple'  => 'multiple',
				'class' => 'business_city',
				'style' => '',				
				'options' => $city

				));
				?>
                </div>
            </div>
        </div>
 <br />
<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="home_state">Business State</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('business_state', array('id' => 'businessstate',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
                                'multiple'  => 'multiple',
				'class' => 'business_state',
				'style' => '',				
				'options' => $state

				));
				?>
                </div>
            </div>
        </div>
 <br />
<div class="col-lg-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="business_suburb">Business Suburb</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
					<?php

				echo $this->Form->input('business_state', array('id' => 'businesssuburb',
				'label' => false,
				'div' => false,
				'legend' => false,
				'empty' => __d('label', '--Select--'),
                                'multiple'  => 'multiple',
				'class' => 'business_suburb',
				'style' => '',				
				'options' => $suburb

				));
				?>
                </div>
            </div>
        </div>
</div>
 <br />
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-actions">
                <div class="col-lg-4 col-md-4 col-xs-4">&nbsp;</div>
                <div class="col-lg-8 col-md-8 col-xs-8">
                    <button type="button" class="btn btn-primary search">Search</button>
                    <button type="button" style="color: red" class="btn btn-link clear">clear</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">   
  
    <table id="getallCompletedData" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>        
        <th>First Name</th>
        <th>Last Name</th>       
        <th>Village</th> 
        <th>Mobile</th>
        <th>Date of Birth</th>
        <th>Sect</th>
        <th>Martial Status</th>
    </tr>
    </thead>
</table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-checkboxName').multiselect({
            checkboxName: 'multiselect[]'
        });
        $('#example-checkboxNames').multiselect({
            checkboxName: 'multiselect[]'
        });
 $('#natureofbusiness').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#nameofbusiness').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#martial_status').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#specialty_business_service').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#gender').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#occupation').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#village').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#homecity').multiselect({
            checkboxName: 'multiselect[]'
        });

$('#homestate').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#businesscity').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#businessstate').multiselect({
            checkboxName: 'multiselect[]'
        });
$('#businesssuburb').multiselect({
            checkboxName: 'multiselect[]'
        });

$('#homesuburb').multiselect({
            checkboxName: 'multiselect[]'
        });

$('#example-single').multiselect({
            checkboxName: 'multiselect[]'
        });
    });
</script>
<?php echo $this->Html->script(array('Reports/all')); ?>