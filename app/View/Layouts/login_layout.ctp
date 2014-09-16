<?php

/**
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
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Admin Panel</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
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
    <body class="login">
        <div class="logo">
        <?php echo $this->Html->image('logo-big.png'); ?> 
        </div>
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
    <?php
        echo $this->Html->script('../plugins/jquery-1.10.1.min');       
        echo $this->Html->script('../plugins/jquery-migrate-1.2.1.min');
        echo $this->Html->script('../plugins/jquery-ui/jquery-ui-1.10.1.custom.min');
        echo $this->Html->script('../plugins/bootstrap/js/bootstrap.min');
        echo $this->Html->script('../plugins/excanvas.min');
        echo $this->Html->script('../plugins/respond.min');
        echo $this->Html->script('../plugins/jquery-slimscroll/jquery.slimscroll.min');
        echo $this->Html->script('../plugins/jquery.blockui.min');
        echo $this->Html->script('../plugins/jquery.cookie.min');
        echo $this->Html->script('../plugins/uniform/jquery.uniform.min');
        echo $this->Html->script('../plugins/jquery-validation/dist/jquery.validate.min');
        echo $this->Html->script('../plugins/backstretch/jquery.backstretch.min');
        echo $this->Html->script('scripts/app');
        echo $this->Html->script('scripts/login');
    ?>
        <script>
            jQuery(document).ready(function() {
                App.init();
                // Login.init();
            });
        </script>
    </body>
</html>