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
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/fontawesome/css/all.min.css">   
        
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
                    
                            
                    <?php echo form_open_multipart('users/login', array('id'=>'bb_ajax_form', 'clear'=>false, 'class'=>'row row-eq-height lockscreen  mt-5 mb-5')); ?>
                        <div class="lock-image col-12 col-sm-2"></div>
                        <div class="login-form col-12 col-sm-10"><div id="bb_ajax_msg"></div>
                            <div class="form-group mb-3">
                                <label for="emailaddress">Login Type</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="">Select</option>
                                    <option value="Student">Student Login</option>
                                    <option value="Staff">Staff Login</option>
                                </select>
                            </div>

                             <div class="form-group mb-3">
                                <label for="emailaddress">User ID</label>
                                <input class="form-control" type="text" id="staff_id" name="staff_id" required placeholder="Enter your Staff ID">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" required name="password" id="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group mb-0">
                                <button class="btn btn-primary" type="submit"> Log In </button>
                            </div>
                           
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

        <!-- END: Template JS-->  
    </body>
    <!-- END: Body-->
</html>
