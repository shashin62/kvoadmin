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
		Kvo Admin
	</title>
    <?php echo $this->Html->css(array('/font-awesome-4.1.0/css/font-awesome.min.css',
                                    '/js/datatables/css/jquery.dataTables.css',
                                    'bootstrap.min.css',
                                    'bootstrap-responsive.min.css','dataTables.bootstrap.css',
                                    'bootstrapValidator.min.css','datepicker.min.css','bootstrap-select.min.css')); ?>
<?php
  echo $this->Html->script(array('jquery','bootstrap.min','/datatables/js/jquery.dataTables.min'));      
?>
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
<!--			<a class="navbar-brand" href="#">Admin</a>-->
		</div>
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             <ul class="nav navbar-nav">
                 <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Masters <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="new_form.php">Users</a></li>
                                                <li><a href="new_form.php">Villages</a></li>
                                                <li><a href="new_form.php">Educations</a></li>
					</ul>
				</li>
             </ul>
             <ul class="nav navbar-nav navbar-right">
                 <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/user/register">Register<span class="sr-only">(current)</span></a></li>
                 <li><a href="<?php echo FULL_BASE_URL . $this->base; ?>/user/login">Sign In<span class="sr-only">(current)</span></a></li>
             </ul>
          </div><!--/.nav-collapse -->
        </div>
    </nav>
	<div class="container-fluid">
        <div class="row-fluid" style="margin-top:100px">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
        </div>
<!--        <p><strong>Your are using CakePHP Version <?=Configure::version()?></strong></p>-->
	</div>
    
    <script type="text/javascript">
    var baseUrl = '<?php echo FULL_BASE_URL . $this->base; ?>';
    </script>
    
    <!-- jQuery DataTables JavaScript -->

<!-- Bootstrap validation JavaScript -->
<script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>

<!-- Bootstrap Datepicker JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap Select JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
    <div class="modal hide" id="README">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>README</h3>
      </div>
      
    </div>
</body>
</html>