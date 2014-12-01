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
                       
                        ?>
			<?php foreach( $data as $key => $value ) { ?>
                        <div class="row">
				<div class="col-md-2"><?php echo $value['People']['first_name'] . ' ' . $value['People']['last_name'];?></div>
				<div class="col-md-2">
                                    <a href="#">Edit Detail</a><br>
                                    <?php if(strtolower($value['People']['martial_status']) == 'married' && empty($value['People']['partner_id'])) { ?>
                                    <a class="addspouse" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);">Add Spouse</a><br>
                                    <?php } else  { ?> 
                                        <div>Spouse: <?php echo $value['People']['partner_name'];?></div>
                                    <?php } ?>
                                        
                                </div>
				<div class="col-md-2">
                                    <a href="#">Edit Home Address</a><br>
                                    <?php if( empty($value['People']['f_id'])) { ?>
                                    <a class="addfather" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);">Add Father</a>
                                    <?php }  else { ?>
                                    <div>Father : <?php echo $value['People']['father'];?></div>
                                    <?php } ?>
                                </div>
				<div class="col-md-2">
                                    <a href="#">Add Business / Service</a><br>
                                    <?php if( empty($value['People']['m_id'])) { ?>
                                    <a class="addmother" data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="javascript:void(0);">Add Mother</a>
                                    <?php } else { ?>
                                    <div>Mother : <?php echo $value['People']['mother'];?></div>
                                    <?php } ?>
                                </div>
                                 <?php if( !empty($value['People']['partner_id']) && strtolower($value['People']['gender']) == 'male') { ?>
				<div class="col-md-1">
                                   
                                    <a href="#">Add Children</a><br>
                                    <div>Children: </div>
                                </div>
                                <?php }
                                if($value['People']['user_id'] == "") { ?>
                                <div class="col-md-1"><a data-gid="<?php echo $value['People']['group_id'];?>" data-id="<?php echo $value['People']['id'];?>" href="#" style="color: red">Delete</a></div>
                                    <?php } ?>
                                <div class="col-md-1"></div>
                                <?php if($value['People']['user_id'] == $userId) { ?>
                                <div class="col-md-1"><a href="#">Tree</a></div>
                                <?php } else { ?>
                                <div class="col-md-2"><a href="#">Transfer of Family</a></div>
                                <?php } ?>
                        </div><br>
                        
                        <?php } ?>
			
<!--			<br>
doFormPost(baseUrl+"/success",'{ "type":"'+ type +'","created":"'+ created +'","email":"'+ data.email +'"}');
			<div class="row">
				<div class="col-md-2">Kalpana Sheth</div>
				<div class="col-md-2"><a href="#">Edit Detail</a><br><a href="#">Add Spouse</a></div>
				<div class="col-md-2"><a href="#">Add Home Address</a><br><a href="#">Add Father</a></div>
				<div class="col-md-2"><a href="#">Add Business / Service</a><br><a href="#">Add Mother</a></div>
				<div class="col-md-1"><a href="#" style="color: red">Delete</a></div>
				<div class="col-md-1"></div>
				<div class="col-md-2"><a href="#">Transfer of Family</a></div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-2">Sunil Sheth</div>
				<div class="col-md-2"><a href="#">Edit Detail</a><br><a href="#">Add Spouse</a></div>
				<div class="col-md-2"><a href="#">Edit Home Address</a><br><div>Father: Shashin</div></div>
				<div class="col-md-2"><a href="#">Add Business / Service</a><br><div>Mother: Hemal</div></div>
				<div class="col-md-1"><a href="#" style="color: red">Delete</a></div>
				<div class="col-md-1"></div>
				<div class="col-md-2"><a href="#">Transfer of Family</a></div>
			</div>-->
		</div>
<?php echo $this->Html->script(array('Family/details')); ?>