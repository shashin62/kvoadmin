<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html>
    <head>
	<?php echo $this->Html->charset(); ?>
        <title>
            KVO Admin
        </title>
    <?php echo $this->Html->css(array('common', 'bootstrap.min','/font-awesome-4.1.0/css/font-awesome.min',
                                    'dataTables.bootstrap',
                                    'bootstrapValidator.min',
                                    'datepicker.min',
                                    'bootstrap-select.min','jquery-ui.min','jquery-ui.theme.min','bootstrap-multiselect')); ?>
<?php
  echo $this->Html->script(array('jquery','common','bootstrap.min','jquery.validate','jquery-ui.min','combobox','autotab','prettify','bootstrap-multiselect'));      
?>
        <script type="text/javascript" language="javascript" src="<?php echo $this->base; ?>/js/datatables/js/jquery.dataTables.min.js"></script>
        
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
       <!-- 
        <script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
       
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
        -->
        <script src="<?php echo $this->base; ?>/js/bootstrap-select.min.js"></script>
       
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
		</div>
            <?php if ($this->Session->read('Auth.User')) {?>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo $this->base.'/user/welcome';?>">KVO</a></li>
                        <?php 
                        
                        if ($this->Session->read('User.role_id') == 1 ) {?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Masters <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/user/getUsers">Users</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/BloodGroup/index">Blood Groups</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/education/index">Educations</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/state/index">States</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/country/index">Countries</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/village/index">Villages</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/translation/index">Translations</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/suburb/index">Suburbs</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/surname/index">Surname</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/zip/index">Pincodes</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/BusinessNature/index">Business Natures</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/business_type/index">Business Types</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Content <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/poll/index">Polls</a></li>
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/article/index">Articles</a></li>
                            </ul>
                        </li>
                        <?php } else   {?> 
                         <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Masters <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/education/index">Educations</a></li>
                                 <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/zip/index">Zip codes</a></li>
                            </ul>
                        </li>
                        <?php } ?> 
                        <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/family/familiyGroups">Family Groups</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="<?php echo FULL_BASE_URL . $this->base; ?>/report/reports">Reports <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/report/reports">Missing translations</a></li>
                                <li><a style="display: block" href="<?php echo FULL_BASE_URL . $this->base; ?>/report/records">Missing records</a></li>
                                <li><a style="display: block" href="<?php echo FULL_BASE_URL . $this->base; ?>/report/completedrecords">Completed records</a></li>
                                <li><a style="display: block" href="<?php echo FULL_BASE_URL . $this->base; ?>/report/missingfathers">Missing Fathers</a></li>
                                <li><a style="display: block" href="<?php echo FULL_BASE_URL . $this->base; ?>/report/missingmothers">Missing Mothers</a></li>
                                <li><a style="display: block" href="<?php echo FULL_BASE_URL . $this->base; ?>/report/matchingaddress">Matching Address</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/people/search">People Search</a></li>
                    </ul>
              <?php } ?>
              <?php if (!$this->Session->read('Auth.User')) {?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/user/register">Register<span class="sr-only">(current)</span></a></li>
                        <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/user/login">Sign In<span class="sr-only">(current)</span></a></li>
                    </ul>
              <?php } else { ?>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="javascript:void(0);">Welcome <?php echo $this->Session->read('User.first_name');?></a></li>
                        <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/user/logout"><img width="50%" height="50%" title="logout" src="<?php echo $this->base.'/img/logout.png';?>"><span class="sr-only">(current)</span></a></li>
                    </ul>
             <?php } ?>
                </div><!--/.nav-collapse -->

            </div>
        </nav>
        <div class="container-fluid">
            <div id="customFlash" class="jssuccessMessage top_success" style="display: none"></div>
            <div class="row-fluid">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
            </div>
        </div>
        
        <script type="text/javascript">
            var baseUrl = '<?php echo FULL_BASE_URL . $this->base; ?>';
        </script>

        <!-- jQuery DataTables JavaScript -->

        <div class="modal hide" id="README">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>README</h3>
            </div>

        </div>
    </body>
</html>
