<div class="container-fluid">
    <h3 class="heading">Add/Edit Address</h3>
    <?php echo $this->Form->create('Address', array('class' => 'form-horizontal addressForm', 'id' => 'addressForm', 'name' => 'address')); ?>
    <?php if ( $aid == '') { ?>
    <div class="row-fuild">
        <?php echo $this->Form->input("is_same", array('type' => "checkbox",'class' => 'same_as', 'div' => false, "label" => array('class' => 'checkboxLabel', 'text' => __('Same as ' . $name)))); ?>
    </div>
    <?php } ?>
    <br>
    <div class="addresscontainer">
        
    
<div class="row-fuild">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default">
                <input type="radio" name="ownership_type" value="1">Ownership
            </label>
            <label class="btn btn-default">
                <input type="radio" name="ownership_type" value="2">Leave & License
            </label>
            <label class="btn btn-default">
                <input type="radio" name="ownership_type" value="3">Pagadi
            </label>
            <label class="btn btn-default">
                <input type="radio" name="ownership_type" value="4">Other
            </label>
        </div>
    </div>
    <br>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">No of Rooms:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('rooms', array('id' => 'rooms','value'=> $rooms,'type' => 'text','placeholder' => 'Enter First Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="last_name">Wing:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('wing', array('id' => 'wing', 'value'=> $wing,'placeholder' => 'Enter Last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>                
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">	
                 <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="room_number">Apartment No.:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('room_number', array('id' => 'room_number','value'=> $room_number,'type' => 'text','placeholder' => 'Contact number' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="website">Building/Complex Name:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('building_name', array('id' => 'building_name','value'=> $building_name,'type' => 'text', 'placeholder' => 'Enter website' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="email">Plot No.:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('plot_number', array('id' => 'plot_number', 'value'=> $plot_number,'type' => 'text','placeholder' => 'Enter plot no' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="password">Road:</label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                       <?php echo $this->Form->input('road', array('id' => 'road', 'value'=> $road,'type' => 'text','placeholder' => 'Enter raod name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="landmark">Landmark:</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('landmark', array('id' => 'landmark','value'=> $landmark, 'placeholder' => 'Enter landmark' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="city">City:</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('city', array('id' => 'city','value'=> $city, 'placeholder' => 'Enter City' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="district">District:</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('district', array('id' => 'district', 'value'=> $district,'placeholder' => 'Enter district' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
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
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="zip_code">Zip Code:</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('zip_code', array('id' => 'zip_code', 'value'=> $zip_code,'type' => 'text','placeholder' => 'Enter zip code' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="zip_code">Home Phone</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('phone1', array('id' => 'phone1', 'value'=> $phone1,'type' => 'text','placeholder' => 'Enter home phone' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="zip_code">Other Phone</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('phone2', array('id' => 'phone2', 'value'=> $phone2,'type' => 'text','placeholder' => 'Enter home phone' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="suburb">Suburb</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $this->Form->input('suburb', array('id' => 'suburb','value'=> $suburb, 'placeholder' => 'Enter suburb' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control')); ?>
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
                    </div>
                </div>
            </div>
        </div>
    
    <?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
   
    var aid = '<?php echo $addressid; ?>';   
     var pid = '<?php echo $peopleid; ?>';
</script>
<?php echo $this->Html->script(array('Family/add_address')); ?>