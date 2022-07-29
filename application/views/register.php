<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/dist/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/flags-icon/css/flag-icon.min.css"> 
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css2.css"> 
       
        <!-- END Template CSS-->     

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/social-button/bootstrap-social.css"/>   
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/main.css">
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">
        <!-- START: Main Content-->
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                    
                            
                    <?php echo form_open_multipart('users', array('id'=>'bb_ajax_form', 'clear'=>false, 'class'=>'row row-eq-height lockscreen  mt-5 mb-5')); ?>
                        <div class="lock-image col-12 col-sm-5"></div>
                        <div class="login-form col-12 col-sm-7"><div id="bb_ajax_msg"></div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="username" id="username" required placeholder="Username" oninput="check_username();">
                                <div id="user_response"></div>
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="email" id="email" required placeholder="E-mail"  oninput="check_email();">
                                <div id="email_response"></div>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" class="form-control" placeholder="password" name="password" id="password" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" placeholder="Confirm password" name="confirm" id="confirm" oninput="check_password();">
                                <div id="password_response"></div>
                            </div>

                            <div class="form-group mb-0">
                                <button class="btn btn-primary" type="submit"> Register </button>
                            </div>
                            
                            <div class="mt-2">Already have an account? <a href="<?php echo base_url('login'); ?>">Sign In</a></div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- END: Content-->

        <!-- START: Template JS-->
        <script src="<?php echo base_url(); ?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/moment/moment.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?php echo base_url(); ?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/jsform.js"></script>


        <script>
            function check_username() {
                var username = $('#username').val();
                $.ajax({
                    url: '<?php echo base_url('users/check_username'); ?>/'+ username,
                    success: function(data) {
                        $('#user_response').html(data);
                    }
                });


            }

            function check_email() {
                var email = $('#email').val();
                $.ajax({
                    url: '<?php echo base_url('users/check_email/?email='); ?>'+ email,
                    success: function(data) {
                        $('#email_response').html(data);
                    }
                });
            }

            function check_password() {
                var password = $('#password').val();
                var confirm = $('#confirm').val();
                $.ajax({
                    url: '<?php echo base_url('users/check_password'); ?>/'+ password + '/' + confirm,
                    success: function(data) {
                        $('#password_response').html(data);
                    }
                });
            }
        </script>
        <!-- END: Template JS-->  
    </body>
    <!-- END: Body-->
</html>
