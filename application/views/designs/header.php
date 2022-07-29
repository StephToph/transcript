<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/flags-icon/css/flag-icon.min.css">
        <!-- END Template CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/themify-icons/themify-icons.css">    
        
        <!-- START: Page CSS-->
        <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/dist/vendors/chartjs/Chart.min.css">
        <!-- END: Page CSS-->
        <style type="text/css">
            #digital-clock {
                color: white;
                 margin: auto;
                 padding-top: 5px;
                 padding-bottom: 5px;
                 font-size: 30px;
                 text-align: center;
                }
        </style>
        <!-- START: Page CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/morris/morris.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/chartjs/Chart.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/starrr/starrr.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
        <!-- END: Page CSS-->
        <script src="<?php echo base_url(''); ?>assets/adapter.min.js"></script>
        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/main.css">
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">

        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <div class="loader"></div>
        </div>
        <!-- END: Pre Loader-->

        <!-- START: Header-->
        <div id="header-fix" class="header fixed-top">
            <div class="site-width">
                <nav class="navbar navbar-expand-lg  p-0">
                    <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                        <a href="<?php echo base_url(); ?>" class="horizontal-logo text-left">
                            <g transform="matrix(.1 0 0 -.1 0 512)" fill="#1e3d73">
                            <path d="m1450 4481-1105-638v-1283-1283l1106-638c1033-597 1139-654 1139-619 0 4-385 674-855 1489-470 814-855 1484-855 1488 0 8 1303 763 1418 822 175 89 413 166 585 190 114 16 299 13 408-5 100-17 231-60 314-102 310-156 569-509 651-887 23-105 23-331 0-432-53-240-177-460-366-651-174-175-277-247-738-512-177-102-322-189-322-193s104-188 231-407l231-400 46 28c26 15 360 207 742 428l695 402v1282 1282l-1105 639c-608 351-1107 638-1110 638s-502-287-1110-638z"/><path d="m2833 3300c-82-12-190-48-282-95-73-36-637-358-648-369-3-3 580-1022 592-1034 5-5 596 338 673 391 100 69 220 197 260 280 82 167 76 324-19 507-95 184-233 291-411 320-70 11-89 11-165 0z"/>
                            </g>
                            </svg> <span class="h4 font-weight-bold align-self-center mb-0 ml-auto"><?php echo 'NACOSS'; ?></span>
                        </a>
                    </div>
                    <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                        <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                    </div>

                    <div class="navbar-right ml-auto h-100">
                        <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                            <li class="dropdown user-profile align-self-center d-inline-block">
                                <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                                    <div class="media">
                                        <img src="<?php echo base_url(); ?>assets/avatar.png" alt="" class="d-flex img-fluid rounded-circle" width="29">
                                    </div>
                                </a>

                                <div class="dropdown-menu border dropdown-menu-right p-0">
                                    <div class="dropdown-divider"></div>
                                    <?php if ($this->session->userdata('tr_user_id')) { ?>
                                    <a href="<?php echo base_url('logout'); ?>" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                        <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                                    <?php } else {?>
                                        <a href="<?php echo base_url('stud_logout'); ?>" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                        <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                                    <?php } ?>
                                </div>

                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- END: Header-->

        <!-- START: Main Menu-->
        <div class="sidebar">
            <div class="site-width">

                <!-- START: Menu-->
                <ul id="side-menu" class="sidebar-menu">
                    <li class="dropdown <?php if($page_active == 'dashboard'){echo 'active';} ?>"><a href="#"><i class="icon-home mr-1"></i> HOME</a>
                        <?php if ($this->session->userdata('tr_user_id')) { ?>
                            <ul>
                                <li class="<?php if($page_active == 'dashboard'){echo 'active';} ?>"><a href="<?php echo base_url('dashboard'); ?>"><i class="icon-rocket"></i> Dashboard</a></li>
                            </ul>
                        <?php } else { ?>
                            <ul>
                                <li class="<?php if($page_active == 'dashboard'){echo 'active';} ?>"><a href="<?php echo base_url('stud_dash'); ?>"><i class="icon-rocket"></i> Dashboard</a></li>
                            </ul>
                        <?php } ?>
                        
                    </li>
                    <?php 
                        $role = $this->Crud->read_field('id', $this->session->userdata('tr_user_id'), 'user', 'user_role');
                    if ($this->session->userdata('tr_user_id') and $role == 'Superadmin') {?>
                        <li class="dropdown <?php if($page_active == 'students' or $page_active == 'session'or $page_active == 'staff'or $page_active == 'course_allocate'or $page_active == 'course'){echo 'active';} ?>"><a href="#"><i class="fas fa-street-view  mr-1"></i> STUDENTS</a>
                            <ul>
                                <li class="<?php if($page_active == 'students'){echo 'active';} ?>"><a href="<?php echo base_url('students'); ?>"><i class="icon-people"></i> Manage Students</a></li>
                                <li class="<?php if($page_active == 'staff'){echo 'active';} ?>"><a href="<?php echo base_url('staff'); ?>"><i class="ti-user"></i> Manage Staffs</a></li>
                                <li class="<?php if($page_active == 'course'){echo 'active';} ?>"><a href="<?php echo base_url('course'); ?>"><i class="ti-book"></i> Manage Courses</a></li>
                                <li class="<?php if($page_active == 'course_allocate'){echo 'active';} ?>"><a href="<?php echo base_url('course_allocate'); ?>"><i class="fas fa-clipboard-list "></i> Courses Allocation</a></li>
                                <li class="<?php if($page_active == 'session'){echo 'active';} ?>"><a href="<?php echo base_url('session'); ?>"><i class="ti-settings"></i> Manage Session</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li class="dropdown <?php if($page_active == 'result_in' or $page_active == 'result_approve'or $page_active == 'check_result'){echo 'active';} ?>"><a href="#"><i class="fas fa-laptop-medical mr-1"></i> RESULTS</a>
                        <ul>
                            <?php if ($this->session->userdata('tr_user_id')) {?>
                                <li class="<?php if($page_active == 'result_in'){echo 'active';} ?>"><a href="<?php echo base_url('result_in'); ?>"><i class="ti-pencil-alt"></i> Input Result</a></li>
                                <?php  if ($this->session->userdata('tr_user_id') and $role == 'Superadmin') {?>
                                <li class="<?php if($page_active == 'result_approve'){echo 'active';} ?>"><a href="<?php echo base_url('result_approve'); ?>"><i class="ti-check-box"></i> Approve Result</a></li><?php } ?>
                            <?php } ?>
                            <li class="<?php if($page_active == 'check_result'){echo 'active';} ?>"><a href="<?php echo base_url('check_result'); ?>"><i class="ti-notepad"></i> Check Result</a></li>
                            
                        </ul>
                    </li>
                    <?php  if ($this->session->userdata('tr_user_id') and $role == 'Superadmin') {?>
                    <li class="dropdown <?php if($page_active == 'request' or $page_active == 'transcript' or $page_active == 'transcript_history'){echo 'active';} ?>"><a href="#"><i class="ti-write mr-1"></i> TRANSCRIPT</a>
                        <ul>
                           
                            <li class="<?php if($page_active == 'transcript'){echo 'active';} ?>"><a href="<?php echo base_url('transcript'); ?>"><i class="ti-archive"></i> Manage Transcript</a></li>
                            
                        </ul>
                    </li>
                     <?php } else {?><?php if ($this->session->userdata('tr_student_id')) {?>
                        <li class="dropdown <?php if($page_active == 'request' or $page_active == 'transcript' or $page_active == 'transcript_history'){echo 'active';} ?>"><a href="#"><i class="ti-write mr-1"></i> TRANSCRIPT</a>
                        <ul>
                            
                                <li class="<?php if($page_active == 'request'){echo 'active';} ?>"><a href="<?php echo base_url('request'); ?>"><i class="ti-clipboard"></i> Request Transcript</a></li>
                                <li class="<?php if($page_active == 'transcript_history'){echo 'active';} ?>"><a href="<?php echo base_url('transcript_history'); ?>"><i class="fas fa-history "></i> Transcript History</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                     <?php } ?>
                </ul>
               
            </div>
        </div>
        <!-- END: Main Menu-->

        <!-- START: Main Content-->
        <main>
            <div class="container-fluid site-width">
