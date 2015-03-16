<style>
    ul.ui-menu {
        z-index:9999 ; /* The default is 100. !important overrides the default. */
    }
    .ui-dialog{
        z-index: 0 !important
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6"><h3>Family details (<?php echo $data[0]['People']['first_name'] . ' ' . $data[0]['People']['last_name'];?>)</h3></div>
        <div class="col-md-6 pull-right">
            <a href="<?php echo $this->base;?>/family/viewNote?gid=<?php echo $groupId;?>" target="_blank"class="btn btn-sm btn-link viewnote">View notes</a>
            <button type="button"  class="btn btn-sm btn-primary addnote">Add Note</button>
            <button type="button" class="btn btn-sm btn-primary english">Show Names: English</button>
            <button type="button" class="btn btn-sm btn-primary hindi">Show Names: Hindi</button>
            <button type="button" class="btn btn-sm btn-primary guju">Show Names: Gujarati</button>
        </div>
    </div>
    <div class="container-fluid addNoteForm" style="display: none;">
    <?php echo $this->Form->create('Note', array('class' => 'form-horizontal noteForm', 'id' => 'addNote', 'name' => 'bloodgroup')); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="note">Note</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('comment', array('id' => 'comment','type' => 'textarea', 'placeholder' => 'Enter Comment' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control comment')); ?>
                    </div>
                </div>
            <?php echo $this->Form->input('id', array('type' => 'hidden',  'id' => 'id', 'placeholder' => 'Enter Blood group name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control noteid')); ?>
            </div>
            <div class="col-lg-2 col-md-1 col-xs-2">
                <div class="form-actions">
                    <div class="col-lg-2 col-md-1 col-xs-1">
                        <button type="button" data-gid="<?php echo $groupId;?>" class="btn btn-primary noteSave">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <br>

        <br>
                        <?php

                       App::import('Model', 'People');
                        $People = new People();
                        $hofId ;
                  ?>

			<?php foreach( $data as $key => $value ) {
                            if( $value['Group']['tree_level'] == '') {
                                $hofId = $value['People']['id'];
$hofAddressId = $value['People']['address_id'];
                            }
                            $missingData = array();?>
                    <?php if( $groupId == $value['People']['group_id']) { 
	switch( $type) {
	case 'english':
	$firstName = $value['People']['first_name'];
	$lastName = $value['People']['last_name'];
	break;
	case 'gujurathi':
	$firstName = $value['t1']['gujurathi_text'] ? $value['t1']['gujurathi_text'] : $value['People']['first_name'];
	$lastName = $value['t']['gujurathi_text'] ? $value['t']['gujurathi_text'] : $value['People']['last_name'];
	break;
case 'hindi':
	$firstName = $value['t1']['hindi_text'] ? $value['t1']['hindi_text'] :$value['People']['first_name'];
	$lastName = $value['t']['hindi_text'] ? $value['t']['hindi_text'] :  $value['People']['last_name'];
	break;
	default :
$firstName = $value['People']['first_name'];
	$lastName = $value['People']['last_name'];
	break;
}

?>
    <div class="row">
        <div class="col-md-1" <?php echo $value['People']['is_late'] == '1' ? "style='color:red';" : ''?> ><?php echo $firstName . ' ' . $lastName;?> (<?php echo $value['People']['id'];?>)</div>
        <div class="col-md-1">
            <a class="self" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);">Edit Detail</a><br>
                                    <?php if(strtolower($value['People']['martial_status']) == 'married' && empty($value['People']['partner_id'])) { ?>
            <a class="addspouse" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Spouse</a><br>
                                    <?php } else  { ?> 
            <div>Spouse: <a title="edit" class="self" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['partner_id'];?>" href="javascript:void(0);"><?php echo $value['parent3']['partner_name'];?></a> (<?php echo $value['People']['partner_id'];?>)
 <?php if( $value['People']['gender'] == 'male') { ?>
                <a style="display:block;" class="addexspouse" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Ex-Spouse</a>
<?php } ?>
            </div>
                                    <?php } ?>

        </div>
        <div class="col-md-2">
            <?php if ($value['People']['is_late'] != '1') {?>
            <a class="editaddress" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-aid="<?php echo $value['People']['address_id'];?>" href="javascript:void(0);">
                                <?php echo $value['People']['address_id'] ? 'Edit Home Address' : 'Add Home Address';?></a><br>
                    <?php } ?>
                                    <?php if( empty($value['People']['f_id'])) { ?>
            <a class="addfather" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Father</a>
                                    <?php }  else { ?>
            <div>Father: <a title="edit"  class="self" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['f_id'];?>" href="javascript:void(0);"><?php echo $value['parent1']['father'];?></a> (<?php echo $value['People']['f_id'];?>)
<a href="javascript:void(0);" title="Remove Association" title="edit"  data-type="father" class="removeassco" data-gid="<?php echo $value['People']['group_id'];?>" data-fid="<?php echo $value['People']['f_id'];?>" data-id="<?php echo $value['People']['id'];?>">Remove</a>
</div>
                                    <?php } ?>
        </div>
        <div class="col-md-2">
             <?php if ($value['People']['is_late'] != '1') {?>
            <a class="editbusiness" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-aid="<?php echo $value['People']['business_address_id'];?>" href="#">
                            <?php echo $value['People']['business_address_id'] || $value['People']['occupation'] != '' ? 'Edit Business Details' : 'Add Business Details';?></a><br>
             <?php } ?>
                                    <?php if( empty($value['People']['m_id'])) { ?>
            <a class="addmother" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Mother</a>
                                    <?php } else { ?>
            <div>Mother:  <a title="edit"  class="self" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['m_id'];?>" href="javascript:void(0);"><?php echo $value['parent2']['mother'];?></a> (<?php echo $value['People']['m_id'];?>)
            <a href="javascript:void(0);" title="Remove Association" data-type="mother" title="edit"  class="removeassco" data-gid="<?php echo $value['People']['group_id'];?>" data-mid="<?php echo $value['People']['m_id'];?>" data-id="<?php echo $value['People']['id'];?>">Remove</a>
            </div>
                                    <?php } ?>
        </div>
        <div class="col-md-2">
                                 <?php if( !empty($value['People']['partner_id']) && strtolower($value['People']['gender']) == 'male') { ?>
            <a class="addchild" href="javascript:void(0);" data-gid="<?php echo $value['People']['group_id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" data-id="<?php echo $value['People']['id'];?>" >Add Children</a><br>
                                    <?php $children = $People->getChildren($value['People']['id'],'male');
                                    $childs = array();
                                    foreach ( $children as $k => $v ) {
                                        $childs[] = $v[0]['childname']. ' (' . $v['People']['id'] . ')';
                                    }
                                    
                                    ?>
            <div>Children: <?php echo implode(', ',$childs); ?></div>
                                <?php } ?>
                                    <?php if( ($roleId == 1 || $this->Session->read('User.user_id') == $value['People']['created_by'] ) && $value['Group']['tree_level'] != '') { ?>
            <a class="deletemember" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);" style="color: red">Delete</a>
                                     <?php } ?>
        </div>                                 
                                <?php if($value['Group']['tree_level'] != '') { ?>
        <div class="col-md-1">
            <?php if( $hofId != $value['People']['partner_id']) { ?>
            <a data-id="<?php echo $value['People']['id'];?>" class="transfer-family" href="javascript:void(0);">Transfer of Family</a>
            <?php } ?>
<?php if($value['People']['first_name'] != '' && $value['People']['last_name'] != '' && $value['People']['mobile_number'] != '' && $value['People']['village'] != '' && $value['People']['is_late'] == 0 && $value['Group']['tree_level'] != '') { ?>
            <a data-gid="<?php echo $value['People']['group_id'];?>" data-hofid="<?php echo $hofId;?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);" class="make_hof">Make HOF</a>
<?php } ?>
        </div>
                                <?php } else { ?>
        <div class="col-md-1"><a target="_blank" href="<?php echo $this->base.'/app/webroot/tree?gid='. $groupId;?>">View Tree</a></div>                
                                <?php } ?>

                                <?php 
                                if ( $value['People']['non_kvo'] == 0) {
                                   if (empty($value['People']['f_id'])) {
                            $missingData[] = 'Father';
                    }
                        }
        if ( $value['People']['non_kvo'] == 0) {
        if (empty($value['People']['m_id'])) {
            $missingData[] = 'Mother';
        }
        }
        if (empty($value['People']['gender'])) {
            $missingData[] = 'Gender';
        }
        if (empty($value['People']['address_id'])) {
            $missingData[] = 'Address';
        }
        if ( $value['People']['tree_level'] == '' && empty($value['People']['mobile_number'])) {
            $missingData[] = 'Mobile';
        } 
        if (empty($value['People']['date_of_birth'])) {
            $missingData[] = 'DOB';
        }
        if (empty($value['People']['village'])) {
            $missingData[] = 'Village';
        }
         if ( $value['People']['non_kvo'] == 0) {
        if (empty($value[0]['grandfather'])) {
            $missingData[] = 'Grandfather';
        }
        }
        if ( $value['People']['non_kvo'] == 0) {
         if (empty($value[0]['grandfather_mother'])) {
            $missingData[] = 'Grandfather-Mother';
        }
	  }                           ?>
        <div class="col-md-3"> 
        <?php if ( $value['People']['is_late'] == 0 )  { ?>
                                    <?php echo "Missing: <span class=\"text-danger bg-danger\">" . implode(', ',$missingData) . "</span>";?>                                    
<?php } ?>
        </div>
    </div><br>
                        <?php } ?>
                        <?php } ?>
    <u><h4>Secondary Family</h4></u>
<?php foreach( $data as $key => $value ) { 
$missingData = array();?>
<?php if( $groupId != $value['People']['group_id']) { ?>
    <div class="row">
        <div class="col-md-1" <?php echo $value['People']['is_late'] == '1' ? "style='color:red';" : ''?>><?php echo $value['People']['first_name'] . ' ' . $value['People']['last_name'];?> (<?php echo $value['People']['id'];?>)</div>

        <div class="col-md-1">
            <a class="self" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);">Edit Detail</a><br>
                                    <?php if(strtolower($value['People']['martial_status']) == 'married' && empty($value['People']['partner_id'])) { ?>
            <a class="addspouse" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Spouse</a><br>
                                    <?php } else  { ?> 
            <div>Spouse: <?php echo $value['People']['partner_name'];?> (<?php echo $value['People']['partner_id'];?>)</div>
                                    <?php } ?>

        </div>
        <div class="col-md-2">
            <?php if ($value['People']['is_late'] != '1') {?>
            <a class="editaddress" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-aid="<?php echo $value['People']['address_id'];?>" href="javascript:void(0);">
                                <?php echo $value['People']['address_id'] ? 'Edit Home Address' : 'Add Home Address';?></a><br>
                    <?php } ?>
                                    <?php if( empty($value['People']['f_id'])) { ?>
            <a class="addfather" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Father</a>
                                    <?php }  else { ?>
            <div>Father: <?php echo $value['People']['father'];?> (<?php echo $value['People']['f_id'];?>)</div>
                                    <?php } ?>
        </div>
        <div class="col-md-2">
             <?php if ($value['People']['is_late'] != '1') {?>
            <a class="editbusiness" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-aid="<?php echo $value['People']['business_address_id'];?>" href="#">
                            <?php echo $value['People']['business_address_id'] || $value['People']['occupation'] != '' ? 'Edit Business Details' : 'Add Business Details';?></a><br>
             <?php } ?>
                                    <?php if( empty($value['People']['m_id'])) { ?>
            <a class="addmother" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Mother</a>
                                    <?php } else { ?>
            <div>Mother: <?php echo $value['People']['mother'];?> (<?php echo $value['People']['m_id'];?>)</div>
                                    <?php } ?>
        </div>
        <div class="col-md-2">
                                 <?php if( !empty($value['People']['partner_id']) && strtolower($value['People']['gender']) == 'male') { ?>
            <a class="addchild" href="javascript:void(0);" data-gid="<?php echo $value['People']['group_id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" data-id="<?php echo $value['People']['id'];?>" >Add Children</a><br>
                                    <?php $children = $People->getChildren($value['People']['id'],'male');
                                    $childs = array();
                                    foreach ( $children as $k => $v ) {
                                        $childs[] = $v[0]['childname'] . ' (' . $v['People']['id'] . ')';
                                    }
                                    
                                    ?>
            <div>Children: <?php echo implode(', ',$childs); ?></div>
                                <?php } ?>
                                    <?php if( $roleId == 1 && $value['Group']['tree_level'] != '') { ?>
            <a class="deletemember" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="#" style="color: red">Delete</a>
                                     <?php } ?>
        </div>       
<?php 
 if ( $value['People']['non_kvo'] == 0) {
                                   if (empty($value['People']['f_id'])) {
            $missingData[] = 'Father';
        }
}
        if ( $value['People']['non_kvo'] == 0) {
        if (empty($value['People']['m_id'])) {
            $missingData[] = 'Mother';
        }
        }
        if (empty($value['People']['gender'])) {
            $missingData[] = 'Gender';
        }
        if (empty($value['People']['address_id'])) {
            $missingData[] = 'Address';
        }
        if ( $value['People']['tree_level'] == '' && empty($value['People']['mobile_number'])) {
            $missingData[] = 'Mobile';
        }
        if (empty($value['People']['date_of_birth'])) {
            $missingData[] = 'DOB';
        }
        if (empty($value['People']['village'])) {
            $missingData[] = 'Village';
        }
         if ( $value['People']['non_kvo'] == 0) {
        if (empty($value[0]['grandfather'])) {
            $missingData[] = 'Grandfather';
        }
        }
        if ( $value['People']['non_kvo'] == 0) {
        if (empty($value[0]['grandfather_mother'])) {
            $missingData[] = 'Grandfather-Mother';
        } 
        }


                                    ?>
        <div class="col-md-3">
<?php if ( $value['People']['is_late'] == 0) { ?>
                                   <?php echo "Missing: <span class=\"text-danger bg-danger\">" . implode(', ',$missingData) . "</span>";?>  
<?php } ?>
        </div>
    </div>


<?php } ?>
<?php } ?>
</div>
<div id="dialog-form" title="Transfer of family">
    <div class="container-fluid">
        <div class="row">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="owner">Transfer to</label>   
                <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
                         
                         echo '<select class="owner combobox">';
foreach($owners as $key => $value){
if( $groupId != $value['group_id']) {
    echo "<option data-peopleid='{$value['id']}' value='{$value['group_id']}'>{$value['name']} ({$value['group_id']})</option>";
}
}
echo '</select>';
            ?>
                </div>

            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script(array('Family/details')); ?>
<script type="text/javascript">
    var groupid = '<?php echo $groupId;?>';
</script>
