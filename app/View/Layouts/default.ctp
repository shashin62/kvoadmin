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
    <?php echo $this->Html->css(array('/js/datatables/css/jquery.dataTables.css','bootstrap.min.css','bootstrap-responsive.min.css')); ?>
    
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="/">Kvo Admin</a>
          <div class="nav-collapse collapse">
<!--             <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Username</a>
            </p> -->
<!--            <ul class="nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Examples
                    <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                      <li><a href="/cities/index">Basic (Linkable)</a></li>
                      <li><a href="/cities/containable">Containable</a></li>
                      <li><a href="/cities/concat">CONCAT</a></li>
                      <li><a href="/cities/virtualFields">VirtualFields</a></li>
                      <li><a href="/cities/noJsonHandler">No JSON Handler</a></li>
                  </ul>
                </li>
                <li><a href="#README" data-toggle="modal">README</a></li>
            </ul>-->
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<div class="container-fluid">
        <div class="row-fluid" style="margin-top:100px">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
        </div>
<!--        <p><strong>Your are using CakePHP Version <?=Configure::version()?></strong></p>-->
	</div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    var baseUrl = '<?php echo FULL_BASE_URL . $this->base; ?>';
    </script>
    
    <?php
    echo $this->Html->script(array('datatables/js/jquery.dataTables.min.js','examples.js'));
    ?>
    <div class="modal hide" id="README">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>README</h3>
      </div>
      
    </div>
</body>
</html>