<div class="container-fluid">
    <h3 class="heading">Add/Edit Business</h3>
    <?php echo $this->Form->create('Address', array('class' => 'form-horizontal addressForm', 'id' => 'addressForm', 'name' => 'address')); ?>
	<div class="row-fluid">
		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label class="col-lg-4 col-md-4 col-xs-4 control-label" for="Occupation">Current Occupation</label>
					<div class="col-lg-8 col-md-8 col-xs-8">
						<div class="btn-group occupations" data-toggle="buttons">
						<label class="btn btn-default <?php echo $occupation == 'Business' ? 'active' : '';?>">
						<input type="radio" name="occupation" class="occupation" <?php echo $occupation == 'Business' ? 'checked=checked' : '';?> value="Business">Business
						</label>
						<label class="btn btn-default <?php echo $occupation == 'Service' ? 'active' : '';?>">
						<input type="radio" name="occupation" class="occupation" <?php echo $occupation == 'Service' ? 'checked=checked' : '';?> value="Service">Service
						</label>
						<label class="btn btn-default <?php echo $occupation == 'House Wife' ? 'active' : '';?>">
						<input type="radio" name="occupation" class="occupation" <?php echo $occupation == 'House Wife' ? 'checked=checked' : '';?> value="House Wife">House Wife
						</label>
						<label class="btn btn-default <?php echo $occupation == 'Retired' ? 'active' : '';?>">
						<input type="radio" name="occupation" class="occupation" <?php echo $occupation == 'Retired' ? 'checked=checked' : '';?> value="Retired">Retired
						</label>
						<label class="btn btn-default <?php echo $occupation == 'Studying' ? 'active' : '';?>">
						<input type="radio" name="occupation" class="occupation" <?php echo $occupation == 'Studying' ? 'checked=checked' : '';?> value="Studying">Studying
						</label>
						<label class="btn btn-default <?php echo $occupation == 'Other' ? 'active' : '';?>">
						<input type="radio" name="occupation" class="occupation" <?php echo $occupation == 'Other' ? 'checked=checked' : '';?> value="Other">Other
						</label>
					</div>
				</div>
			</div>
                    <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="business_service_name">Business/Service Name</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('business_service_name', array('id' => 'business_service_name', 'value'=> $business_service_name,'placeholder' => 'Enter business/service name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
		</div>
		<div class="col-lg-6 col-md-6 col-xs-12">&nbsp;</div>
	</div>

    <br>

    <div class="tohidecontainer">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12" >
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">Business/Service</label>
                <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php
                        $busniessOptions = array(
                            'Enginner' => 'Enginner',
                            'Construction' => 'Construction',
                            'Other' => 'Other'
                        );
            echo $this->Form->input('business_name', array('id' => 'business_name',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 'combobox',
                'style' => '',
                'options' => $busniessOptions,
                'value' => $business_name
            ));
            ?>
                </div>
            </div>
        </div>
    </div>
    <div>
        <?php if ( $show ) { ?>
        <div class="row-fuild">
        <?php echo $this->Form->input("is_same", array('type' => "checkbox",'checked' => $parentaddressid == $aid ? 'checked' : '','class' => 'same_as', 'div' => false, "label" => array('class' => 'checkboxLabel', 'text' => __('Same as ' . $name)))); ?>
        </div>
    <?php } ?> 
    </div>
    <div class="addresscontainer">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="last_name">Wing</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('wing', array('id' => 'wing', 'tabindex'=> '2', 'value'=> $wing,'placeholder' => 'Enter Wing' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="room_number">Apartment No.</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('room_number', array('id' => 'room_number','tabindex'=> '3','value'=> $room_number,'type' => 'text','placeholder' => 'Enter Apartment No.' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="website">Building Name</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('building_name', array('id' => 'building_name','tabindex'=> '4','value'=> $building_name,'type' => 'text', 'placeholder' => 'Enter Building Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="complex_name">Complex Name</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('complex_name', array('id' => 'complex_name','tabindex'=> '4','value'=> $complex_name,'type' => 'text', 'placeholder' => 'Enter Complex Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">	
                <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="suburb">Suburb</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
            echo $this->Form->input('suburb', array('id' => 'suburb',
                'label' => false,
                'div' => false,
                'legend' => false,
                'empty' => __d('label', '--Select--'),
                'class' => 'combobox suburb',
                'tabindex'=> '10',
                'style' => '',
                'options' => $suburbs,
                'value' => $suburb
            ));
            ?>
                </div>
            </div>
                 <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="suburb_zone">Suburb Zone</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default <?php echo $suburb_zone == 'east' ? 'active' : '';?>">
                                <input type="radio" name="suburb_zone" <?php echo $suburb == 'east' ? 'checked=checked' : '';?> value="east">East
                            </label>
                            <label class="btn btn-default <?php echo $suburb_zone == 'west' ? 'active' : '';?>">
                                <input type="radio" name="suburb_zone" <?php echo $suburb == 'west' ? 'checked=checked' : '';?> value="west">West
                            </label>
                            <label class="btn btn-default <?php echo $suburb_zone == 'central' ? 'active' : '';?>">
                                <input type="radio" name="suburb_zone" <?php echo $suburb == 'central' ? 'checked=checked' : '';?> value="central">Central
                            </label>
                            <label class="btn btn-default <?php echo $suburb_zone == 'other' ? 'active' : '';?>">
                                <input type="radio" name="suburb_zone" <?php echo $suburb_zone == 'other' ? 'checked=checked' : '';?> value="other">Other
                            </label>
                        </div>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="city">City</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('city', array('id' => 'city','tabindex'=> '8','value'=> $city, 'placeholder' => 'Enter City' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control city')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="district">District</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('district', array('id' => 'district','tabindex'=> '9', 'value'=> $district,'placeholder' => 'Enter District' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
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
                'class' => 'statescombo state',
                'tabindex'=> '10',
                'empty' => __d('label', '--Select--'),
                'style' => '',
                'options' => $states,
                'value' => $state
            ));
            ?>
                </div>
            </div>
            </div>
        </div>
      <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                
                
               <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label">Plot No.</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('plot_number', array('id' => 'plot_number','tabindex'=> '5', 'value'=> $plot_number,'type' => 'text','placeholder' => 'Enter Plot No' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label">Road</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                       <?php echo $this->Form->input('road', array('id' => 'road', 'value'=> $road,'tabindex'=> '6','type' => 'text','placeholder' => 'Enter Road' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control road')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="cross_road">Cross Road</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                       <?php echo $this->Form->input('cross_road', array('id' => 'cross_road','tabindex'=> '7', 'value'=> $cross_road,'type' => 'text','placeholder' => 'Enter Cross Road' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
<!--                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="district">District:</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('district', array('id' => 'district', 'value'=> $district,'placeholder' => 'Enter district' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>-->
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
               
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label">Zip Code</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('zip_code', array('id' => 'zip_code','tabindex'=> '11', 'value'=> $zip_code,'type' => 'text','placeholder' => 'Enter Zip Code' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control zipcode')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label">Home Phone</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('phone1', array('id' => 'phone1','tabindex'=> '12', 'value'=> $phone1,'type' => 'text','placeholder' => 'Enter Home Phone' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label">Other Phone</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('phone2', array('id' => 'phone2', 'tabindex'=> '13','value'=> $phone2,'type' => 'text','placeholder' => 'Enter Other Phone' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="form-actions">
            <div class="col-lg-4 col-md-4 col-xs-4">&nbsp;</div>
            <div class="col-lg-8 col-md-8 col-xs-8">
                <button type="button" class="btn btn-primary addressButton">Submit</button>
                 <button type="button" style="color: red" class="btn btn-link cancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

    <?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
    var pid = '<?php echo $peopleid; ?>';
    var aid = '<?php echo $aid; ?>';
    var prntid = '<?php echo $parentid; ?>';
    var paddressid = '<?php echo $parentaddressid;?>';
    var occupation = '<?php echo $occupation;?>';
    var grpid = '<?php echo $gid; ?>';
 $('.cancel').click(function(){
        
             window.location.href = baseUrl +"/family/details/"+ grpid;
        
       
    });
</script>
<?php echo $this->Html->script(array('Family/add_busniess')); ?>