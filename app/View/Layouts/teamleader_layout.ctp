<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Cambist Admin Panel</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<?php 
		echo $this->Html->css('../assets/plugins/bootstrap/css/bootstrap.min');
		echo $this->Html->css('../assets/plugins/bootstrap/css/bootstrap-responsive.min');
		echo $this->Html->css('../assets/plugins/font-awesome/css/font-awesome.min');
		echo $this->Html->css('../assets/css/style-metro');
		echo $this->Html->css('../assets/css/style');
		echo $this->Html->css('../assets/css/style-responsive');
		echo $this->Html->css('../assets/css/themes/default');
		echo $this->Html->css('../assets/plugins/uniform/css/uniform.default');
		echo $this->Html->css('../assets/plugins/dropzone/css/dropzone');
		echo $this->Html->css('../assets/plugins/bootstrap-daterangepicker/daterangepicker');
		
	?>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="index.html">
				<!-- <img src="assets/img/logo.png" alt="logo"/> -->
				<?php echo $this->Html->image('../assets/img/logo.png')?>
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->            
				<!-- BEGIN TOP NAVIGATION MENU -->              
				<ul class="nav pull-right">
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php echo $this->Html->image('../assets/img/avatar1_small.jpg')?>
						<span class="username"><?php print_r(ucfirst($logged_in_user['username']));?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link("<i class='icon-key'></i>Log Out",array('controller' => 'users' , 'action' => 'logout'),array('escape' => false)); ?>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        
			<ul class="page-sidebar-menu">
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li>
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search">
						<div class="input-box">
							<a href="javascript:;" class="remove"></a>
							<input type="text" placeholder="Search..." />
							<input type="button" class="submit" value=" " />
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start active ">
					<?php echo $this->Html->link('<i class="icon-home"></i>  TeamLeader' , array('controller' => 'teamleaders' , 'action' => 'index') , array('class' => 'selected' , 'escape' => false)) ; ?>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class=" "></i> 
					<span class="title">Tele Caller</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<?php echo $this->Html->link('View All' , array('controller' => 'telecallers' , 'action' => 'index')) ; ?>
						</li>
						<li >
							<?php echo $this->Html->link('Add New' , array('controller' => 'telecallers' , 'action' => 'add')) ; ?>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="icon-bar-chart"></i> 
					<span class="title">Upload Excel</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<?php echo $this->Html->link('Master Allocation' , array('controller' => 'teamleaders' , 'action' => 'upload_master_allocation')) ; ?>
						</li>
						<li >
							<?php echo $this->Html->link('Open Invoice' , array('controller' => 'teamleaders' , 'action' => 'upload_open_invoice')) ; ?>
						</li>
						<li >
							<?php echo $this->Html->link('A&O' , array('controller' => 'teamleaders' , 'action' => 'upload_ao')) ; ?>
						</li>
						<li >
							<?php echo $this->Html->link('BD' , array('controller' => 'teamleaders' , 'action' => 'upload_bd')) ; ?>
						</li>
					</ul>
				</li>
				<!-- <li class="last ">
					<?php echo $this->Html->link('<i class="icon-bar-chart"></i>  Upload Excel' , array( 'controller'=>'teamleaders','action' => 'upload_excel') , array( 'escape' => false )) ; ?>
				</li> -->

			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					Widget settings form goes here
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<?php echo $this->Session->flash(); ?>

				<?php echo $this->fetch('content'); ?>
			</div>
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			2014 &copy; Cambist.
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<?php
		echo $this->Html->script('../assets/plugins/jquery-1.10.1.min');
		echo $this->Html->script('../assets/plugins/jquery-migrate-1.2.1.min');
	?>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<?php
		echo $this->Html->script('../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min');
		echo $this->Html->script('../assets/plugins/bootstrap/js/bootstrap.min');
	?>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<?php
		echo $this->Html->script('../assets/plugins/jquery-slimscroll/jquery.slimscroll.min');
		echo $this->Html->script('../assets/plugins/jquery.blockui.min');
		echo $this->Html->script('../assets/plugins/jquery.cookie.min');
		echo $this->Html->script('../assets/plugins/uniform/jquery.uniform.min');
	?>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<?php
		echo $this->Html->script('../assets/plugins/dropzone/dropzone');
	?>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<?php
		echo $this->Html->script('../assets/scripts/app');
		echo $this->Html->script('../assets/scripts/index');
	?>
	<!-- END PAGE LEVEL SCRIPTS -->  
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		   Index.init();
		   // Index.initDashboardDaterange();
		   // Index.initIntro();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>