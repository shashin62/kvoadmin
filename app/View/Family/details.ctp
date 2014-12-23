<div class="container-fluid">
    <div class="row">
        <div class="col-md-6"><h3>Add/Edit User Detail</h3></div>
        <div class="col-md-6 pull-right">
            <button type="button" class="btn btn-sm btn-primary">Show Names: English</button>
            <button type="button" class="btn btn-sm btn-primary">Show Names: Hindi</button>
            <button type="button" class="btn btn-sm btn-primary">Show Names: Gujarati</button>
        </div>
    </div>

	<br>

    <u><h3>Primary Family</h3></u>

                        <?php
                       App::import('Model', 'People');
                        $People = new People();
                        $hofId ;
                        ?>
                        
			<?php foreach( $data as $key => $value ) {
                            if( $value['Group']['tree_level'] == '') {
                                $hofId = $value['People']['id'];
                            }
                            $missingData = array();?>
                    <?php if( $groupId == $value['People']['group_id']) { ?>
    <div class="row">
        <div class="col-md-1" <?php echo $value['People']['is_late'] == '1' ? "style='color:red';" : ''?> ><?php echo $value['People']['first_name'] . ' ' . $value['People']['last_name'];?> (<?php echo $value['People']['id'];?>)</div>
        <div class="col-md-1">
            <a class="self" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);">Edit Detail</a><br>
                                    <?php if(strtolower($value['People']['martial_status']) == 'married' && empty($value['People']['partner_id'])) { ?>
            <a class="addspouse" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Spouse</a><br>
                                    <?php } else  { ?> 
            <div>Spouse: <?php echo $value['People']['partner_name'];?></div>
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
            <div>Father : <?php echo $value['People']['father'];?></div>
                                    <?php } ?>
        </div>
        <div class="col-md-2">
             <?php if ($value['People']['is_late'] != '1') {?>
            <a class="editbusiness" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-aid="<?php echo $value['People']['business_address_id'];?>" href="#">
                            <?php echo $value['People']['business_address_id'] ? 'Edit Business Details' : 'Add Business Details';?></a><br>
             <?php } ?>
                                    <?php if( empty($value['People']['m_id'])) { ?>
            <a class="addmother" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Mother</a>
                                    <?php } else { ?>
            <div>Mother : <?php echo $value['People']['mother'];?></div>
                                    <?php } ?>
        </div>
        <div class="col-md-1">
                                 <?php if( !empty($value['People']['partner_id']) && strtolower($value['People']['gender']) == 'male') { ?>
            <a class="addchild" href="javascript:void(0);" data-gid="<?php echo $value['People']['group_id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" data-id="<?php echo $value['People']['id'];?>" >Add Children</a><br>
                                    <?php $children = $People->getChildren($value['People']['id'],'male');
                                    $childs = array();
                                    foreach ( $children as $k => $v ) {
                                        $childs[] = $v[0]['childname'];
                                    }
                                    
                                    ?>
            <div>Children: <?php echo implode(', ',$childs); ?></div>
                                <?php } ?>
                                    <?php if( $roleId == 1 && $value['Group']['tree_level'] != '') { ?>
            <a data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="#" style="color: red">Delete</a>
                                     <?php } ?>
        </div>                                 
                                <?php if($value['Group']['tree_level'] != '') { ?>
        <div class="col-md-1">
            <?php if( $hofId != $value['People']['partner_id']) { ?>
            <a data-id="<?php echo $value['People']['id'];?>" class="transfer-family" href="javascript:void(0);">Transfer of Family</a>
            <?php } ?>
        </div>
                                <?php } else { ?>
        <div class="col-md-1"><a target="_blank" href="<?php echo $this->base.'/app/webroot/tree?gid='. $groupId;?>">View Tree</a></div>                
                                <?php } ?>

                                <?php 
                                   if (empty($value['People']['f_id'])) {
            $missingData[] = '<span style="color:orange">Father</span><br/>';
        }
        if (empty($value['People']['m_id'])) {
            $missingData[] = '<span style="color:orange">Mother</span><br/>';
        }
        if (empty($value['People']['gender'])) {
            $missingData[] = '<span style="color:orange">Gender</span><br/>';
        }
        if (empty($value['People']['address_id'])) {
            $missingData[] = '<span style="color:orange">Address</span><br/>';
        }
        if (empty($value['People']['mobile_number'])) {
            $missingData[] = '<span style="color:orange">Mobile</span><br/>';
        }
        if (empty($value['People']['date_of_birth'])) {
            $missingData[] = '<span style="color:orange">DOB</span><br/>';
        }
        if (empty($value['People']['village'])) {
            $missingData[] = '<span style="color:orange">village</span><br/>';
        }
        if (empty($value[0]['grandfather'])) {
            $missingData[] = '<span style="color:orange">grandfather</span><br/>';
        }

                                    ?>
        <div class="col-md-3"> 
        <?php if ( $value['People']['is_late'] == 0 )  { ?>
                                    <?php echo implode(',',$missingData);?>                                    
<?php } ?>
        </div>
    </div><br>
                        <?php } ?>
                        <?php } ?>
    <u><h3>Secondary Family</h3></u>
<?php foreach( $data as $key => $value ) { 
$missingData = array();?>
<?php if( $groupId != $value['People']['group_id']) { ?>
    <div class="row">
        <div class="col-md-2" <?php echo $value['People']['is_late'] == '1' ? "style='color:red';" : ''?>><?php echo $value['People']['first_name'] . ' ' . $value['People']['last_name'];?> (<?php echo $value['People']['id'];?>)</div>
        <div class="col-md-3">
<a class="self" data-gid="<?php echo $groupId;?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);">Edit Detail</a><br>
</div>
<?php 
                                   if (empty($value['People']['f_id'])) {
            $missingData[] = '<span style="color:orange">Father</span><br/>';
        }
        if (empty($value['People']['m_id'])) {
            $missingData[] = '<span style="color:orange">Mother</span><br/>';
        }
        if (empty($value['People']['gender'])) {
            $missingData[] = '<span style="color:orange">Gender</span><br/>';
        }
        if (empty($value['People']['address_id'])) {
            $missingData[] = '<span style="color:orange">Address</span><br/>';
        }
        if (empty($value['People']['mobile_number'])) {
            $missingData[] = '<span style="color:orange">Mobile</span><br/>';
        }
        if (empty($value['People']['date_of_birth'])) {
            $missingData[] = '<span style="color:orange">DOB</span><br/>';
        }
        if (empty($value['People']['village'])) {
            $missingData[] = '<span style="color:orange">Village</span><br/>';
        }
        if (empty($value[0]['grandfather'])) {
            $missingData[] = '<span style="color:orange">Grandfather</span><br/>';
        }

                                    ?>
        <div class="col-md-1">
<?php if ( $value['People']['is_late'] == 0) { ?>
                                 <?php echo implode(', ',$missingData);?> 
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