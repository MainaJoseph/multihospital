<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Rizvi">
        <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
        <link rel="shortcut icon" href="uploads/favicon.png">

        <title>Reset Password - 
            <?php
            $this->db->where('hospital_id', 'superadmin');
            echo $this->db->get('settings')->row()->system_vendor;
            ?>
        </title>

        <!-- Bootstrap core CSS -->
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="common/css/style.css" rel="stylesheet">
        <link href="common/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">

        <div class="container">




            <form class="form-signin" method="post" action="auth/reset_password/<?php echo $code; ?>">

                <h2 class="form-signin-heading">RESET PASSWORD</h2>

                <div class="login-wrap">
                    <div id="infoMessage"><p><?php if (!empty($message)) {
                echo 'Does Not Match !!!';
            } ?></p></div>

                    <p>
                        <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?></label> <br />
<?php echo form_input($new_password); ?>
                    </p>

                    <p>
<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?> <br />
                    <?php echo form_input($new_password_confirm); ?>
                    </p>

<?php echo form_input($user_id); ?>
<?php echo form_hidden($csrf); ?>

                    <p><?php echo form_submit('submit', lang('reset_password_submit_btn')); ?></p>


                </div>



            </form>

        </div>









        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="auth/forgot_password">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>

                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <input class="btn btn-success" type="submit" name="submit" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="common/js/jquery.js"></script>
        <script src="common/js/bootstrap.min.js"></script>


    </body>
</html>
