 <div class="container-fluid">
    <a href="javascript:void(0);" class="btn btn-primary btn-primary pull-right adduser"><span class="glyphicon glyphicon-edit"></span>Add User</a>
</div>
<div class="container-fluid addUserForm" style="display: none;">
    <?php echo $this->Form->create('User', array('class' => 'form-horizontal usernForm', 'id' => 'addUser', 'name' => 'user')); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="first_name">First Name:</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('first_name', array('id' => 'first_name', 'placeholder' => 'Enter first name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control first_name')); ?>
                    </div>
                </div>
            <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="last_name">Last name:</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('last_name', array('id' => 'last_name', 'placeholder' => 'Enter Last Name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control last_name')); ?>
                    </div>
                </div>
            <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="gender">Role</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
                         $roleOptions = array(
                    '1' => 'Admin',
                    '2' => 'Content'
                    
                );
            echo $this->Form->input('role_id', array('id' => 'role_id',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 't',
                'style' => '',
                'options' => $roleOptions
            ));
            ?>
                    </div>
                </div>
            <?php echo $this->Form->input('id', array('type' => 'hidden',  'id' => 'id', 'placeholder' => 'Enter Education name' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control userid')); ?>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">	
                 <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="email">Email id:</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <?php echo $this->Form->input('email', array('id' => 'email', 'placeholder' => 'Enter email' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control email')); ?>
                    </div>
                </div>
                <div class="form-group passwordField">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="password">Password:</label>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                       <?php echo $this->Form->input('password', array('id' => 'password', 'placeholder' => 'Enter password' ,'title' => '','div' => false, 'label' => false, 'class' => 'form-control password')); ?>
                    </div>
                </div>
            <div class="form-group">
                    <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="gender">Gender</label>   
                    <div class="col-lg-8 col-md-8 col-xs-8">
                         <?php
                         $genderOptions = array(
                    'male' => 'Male',
                    'female' => 'Female'
                    
                );
            echo $this->Form->input('gender', array('id' => 'gender',
                'label' => false,
                'div' => false,
                'legend' => false,
                'class' => 't gender',
                'style' => '',
                'options' => $genderOptions
            ));
            ?>
                    </div>
                </div>
            </div>
    
            
        </div>
    <div class="row">
        <div class="col-lg-2 col-md-1 col-xs-2">
                <div class="form-actions">
                    <div class="col-lg-2 col-md-1 col-xs-1">
                        <button type="button" class="btn btn-primary bgButton">Submit</button>
                    </div>
                </div>
            </div>
    </div>
        <?php echo $this->Form->end(); ?>
</div>
<div class="container-fluid">   
<h3 class="heading">Users</h3>
<table id="getUsers" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Phone Number</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
   
    </div>
<?php echo $this->Html->script(array('User/user_lists')); ?>