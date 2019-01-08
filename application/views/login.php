<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Westilian">

        <title><?php echo $this->config->item('company_name'); ?> | Login</title>

        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/waves.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/layout.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/plugins.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/common-styles.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/pages.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/matmix-iconfont.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,500italic" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" type="text/css">

        
        <script type="text/javascript">
          var base_url = '<?php echo base_url(); ?>';
        </script>
        <style type="text/css">
            .validation{
                color: #ff5656;
            }
        </style>
    </head>
    <body class="login-page">
        <div class="page-container">
            <div class="login-branding">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/uploads/images/logo/').$this->config->item('logo'); ?>" alt="logo"></a>
            </div>
            <div class="login-container">
                <img class="login-img-card" src="<?php echo base_url('assets/images/avatar/jaman-01.jpg');?>" alt="login thumb" />
                <?php echo form_open(base_url('login'), 'class="form-signin"'); ?>
                    
                    <input type="email" class="form-control floatlabel" placeholder="Email Address" name="inputEmail" required autofocus>
                    <div class="validation text-left"><?php echo form_error('inputEmail'); ?></div>
                    
                    <input type="password" class="form-control floatlabel" placeholder="Password" name="inputPassword" required>
                    <div class="validation text-left"><?php echo form_error('inputPassword'); ?></div>

                    <button class="btn btn-primary btn-block btn-signin" type="submit">Sign In</button>
                    <p class="validation"><?php echo isset($error) ? $error : ''; ?></p>
                <?php echo form_close(); ?>

                <a class="forgot-password" data-toggle="modal" data-target="#reset_pw_modal" href="#">Forgot the password?</a>
            </div>
            <!-- <div class="create-account">
                <a id="sign_open" href="#">Student Sign Up</a>
            </div> -->

            <div class="login-footer">
                <?php echo $this->config->item('company_name'); ?> &copy; <?php echo date('Y'); ?>
            </div>

        </div>

        <!-- reset password modal -->
        <div class="modal fade" id="reset_pw_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div id="reset_loading" class="laoding"></div>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Reset Password</h4>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('', 'id="reset_pw_form" role="form"') ?>
                            <div class="form-group">
                                <label>Email</label> 
                                <input placeholder="Enter your email address here" class="form-control" type="email" name="reset_email" required="">
                                <span id="email_error" class="form-text m-b-none" style="color:#e67373"></span>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button id="reset_pw" type="button" class="btn btn-primary">Proceed</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/hoverintent.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom/login.js"></script>
    </body>

</html>
