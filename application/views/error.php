<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title>Error Page | <?php echo app_name; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/dist/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/flags-icon/css/flag-icon.min.css"> 

        <!-- END Template CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/main.css">
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->   
    <body id="main-container" class="default bg-primary">
        <!-- START: Main Content-->
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                    <div  class="lockscreen  mt-5 mb-5">
                        <div class="jumbotron mb-0 text-center theme-background rounded">
                            <h1 class="display-3 font-weight-bold"> 404</h1>
                            <h5><i class="ion ion-alert pr-2"></i>Oops! Something went wrong</h5>
                            <p>The page you are looking for is not found, please try after some time or go back to home</p>
                            <a href="<?php echo base_url(); ?>" class="btn btn-primary">Go To Home</a>
                        </div>
                    </div>
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

        <!-- END: Template JS-->  
    </body>
    <!-- END: Body-->
</html>
