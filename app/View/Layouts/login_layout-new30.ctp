<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Metronic | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <?php 
        echo $this->Html->css('../plugins/bootstrap/css/bootstrap.min'); 
        echo $this->Html->css('../plugins/bootstrap/css/bootstrap-responsive.min'); 
        echo $this->Html->css('../plugins/font-awesome/css/font-awesome.min'); 
        echo $this->Html->css('style-metro'); 
        echo $this->Html->css('style'); 
        echo $this->Html->css('style-responsive'); 
        echo $this->Html->css('themes/default'); 
        echo $this->Html->css('../plugins/uniform/css/uniform.default'); 
    ?>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo $this->Html->css('pages/login'); ?>
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <?php echo $this->Html->image('logo-big.png'); ?> 
    <!-- END LOGO -->
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <?php
        echo $this->Html->script('../plugins/jquery-1.10.1.min');       
        echo $this->Html->script('../plugins/jquery-migrate-1.2.1.min');
    ?>
    <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <?php
        echo $this->Html->script('../plugins/jquery-ui/jquery-ui-1.10.1.custom.min');
        echo $this->Html->script('../plugins/bootstrap/js/bootstrap.min');
    ?>
    <!--[if lt IE 9]>
    <script src="assets/plugins/excanvas.min.js"></script>
    <script src="assets/plugins/respond.min.js"></script>  
    <![endif]-->   
    <?php
        echo $this->Html->script('../plugins/jquery-slimscroll/jquery.slimscroll.min');
        echo $this->Html->script('../plugins/jquery.blockui.min');
        echo $this->Html->script('../plugins/jquery.cookie.min');
        echo $this->Html->script('../plugins/uniform/jquery.uniform.min');
    ?>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php
        echo $this->Html->script('../plugins/jquery-validation/dist/jquery.validate.min');
    ?>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <?php
        echo $this->Html->script('scripts/app');
        echo $this->Html->script('scripts/login'); 
    ?>
    <!-- END PAGE LEVEL SCRIPTS --> 
    <script>
        jQuery(document).ready(function() {     
          App.init();
          Login.init();
        });
    </script>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>