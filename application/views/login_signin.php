<!DOCTYPE html>
<html lang="en">
    <head>
        <title>GP Comp - IT Solution</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main-responsive.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/skins/all.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme_light.css" type="text/css" id="skin_color">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/print.css" type="text/css" media="print"/>
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="login example2">
        <div class="main-login col-sm-4 col-sm-offset-4">
            <div class="logo">GP COMP
            </div>
            <!-- start: LOGIN BOX -->
            <div class="box-login">
                <h3>Sign in to your account</h3>
                <p>
                    Please enter your name and password to log in.
                </p>
                <form class="form-login" action="<?php echo base_url(); ?>login/user_login" method="POST">
                    <?php
                    if (!empty($this->session->flashdata('msg'))) {
                        ?>
                        <?php echo $this->session->flashdata('msg'); ?>

                    <?php }
                    ?>
                    <fieldset>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="text" class="form-control" name="username" placeholder="Username" autofocus="">
                                <i class="icon-user"></i> </span>
                            <span class="text-danger"><?php echo form_error('username'); ?></span>
                        </div>
                        <div class="form-group form-actions">
                            <span class="input-icon">
                                <input type="password" class="form-control password" name="password" placeholder="Password">
                                <i class="icon-lock"></i>
                                <span class="text-danger"><?php echo form_error('password'); ?></span>
                            </span>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="btn_login" class="btn btn-bricky pull-right">
                                Login <i class="icon-circle-arrow-right"></i>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <!-- end: LOGIN BOX -->

            <!-- start: COPYRIGHT -->
            <div class="copyright">
                2017 &copy; GP Comp All rights reserved.
            </div>
            <!-- end: COPYRIGHT -->
        </div>
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/iCheck/jquery.icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/login.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script>
            jQuery(document).ready(function () {
                Main.init();
                Login.init();
            });
        </script>
    </body>
    <!-- end: BODY -->
</html>