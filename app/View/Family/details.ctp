<div class="container-fluid">
			
			<div class="row">
				<div class="col-md-8"><h2>Add/Edit User Detail</h2></div>
				<div class="col-md-4">
					<button type="button" class="btn btn-sm btn-primary">Update Names</button>
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
    
                        ?>
			<?php foreach( $data as $key => $value ) { ?>
<?php if( $groupId == $value['People']['group_id']) { ?>
                        <div class="row">
				<div class="col-md-2"><?php echo $value['People']['first_name'] . ' ' . $value['People']['last_name'];?></div>
				<div class="col-md-2">
                                    <a class="self" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);">Edit Detail</a><br>
                                    <?php if(strtolower($value['People']['martial_status']) == 'married' && empty($value['People']['partner_id'])) { ?>
                                    <a class="addspouse" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Spouse</a><br>
                                    <?php } else  { ?> 
                                        <div>Spouse: <?php echo $value['People']['partner_name'];?></div>
                                    <?php } ?>
                                        
                                </div>
				<div class="col-md-2">
                                    <a class="editaddress" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-aid="<?php echo $value['People']['address_id'];?>" href="javascript:void(0);">
                                <?php echo $value['People']['address_id'] ? 'Edit Home Address' : 'Add Home Address';?></a><br>
                                    <?php if( empty($value['People']['f_id'])) { ?>
                                    <a class="addfather" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-first_name="<?php echo $value['People']['first_name'];?>" href="javascript:void(0);">Add Father</a>
                                    <?php }  else { ?>
                                    <div>Father : <?php echo $value['People']['father'];?></div>
                                    <?php } ?>
                                </div>
				<div class="col-md-2">
                                    <a class="editbusiness" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" data-aid="<?php echo $value['People']['business_address_id'];?>" href="#">
                            <?php echo $value['People']['business_address_id'] ? 'Edit Eduction Details' : 'Add Eduction Details';?></a><br>
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
                                    <div>Children: <?php echo implode(',',$childs); ?></div>
                                <?php } ?>
                                    <?php if($value['People']['user_id'] == "") { ?>
                                    <a data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="#" style="color: red">Delete</a>
                                     <?php } ?>
                                    </div>                                 
                                <?php if($value['People']['tree_level'] != '') { ?>
                                  <div class="col-md-2"><a href="#">Transfer of Family</a></div>
                                <?php } else { ?>
                                             <div class="col-md-1"><a target="_blank" href="<?php echo $this->base.'/app/webroot/tree?gid='. $groupId;?>">View Tree</a></div>                
                                <?php } ?>
                        </div><br>
                        <?php } ?>
                        <?php } ?>
			<u><h3>Secondary Family</h3></u>
<?php foreach( $data as $key => $value ) { ?>
<?php if( $groupId != $value['People']['group_id']) { ?>
<div class="row">
<div class="col-md-2"><?php echo $value['People']['first_name'] . ' ' . $value['People']['last_name'];?></div>
<div class="col-md-2"><a href="#">View Detail</a><br></div></div>
</div>
<?php } ?>
<?php } ?>
		</div>
<?php echo $this->Html->script(array('Family/details')); ?>