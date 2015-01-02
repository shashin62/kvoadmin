<div class="container-fluid">
    <h2>View Notes for <?php echo $familyName;?></h2><br>
    <div class="row">
        
        
        <?php foreach ( $data as $k => $v) {?>
        <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name"><?php echo $v['Note']['user_name'];?>
                        <span>(<?php echo $v['Note']['created'];?>)</span>
                    </label>
                    <div class="col-lg-8 col-md-8 col-xs-8">
                        <?php echo $v['Note']['comment'];?>
                    </div>
        </div><br>
        <?php } ?>
        
    </div>
</div>