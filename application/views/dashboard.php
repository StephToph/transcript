 <!-- START: Breadcrumbs-->
 <div>
    <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Dashboard</h4></div>

            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
</div>
<!-- END: Breadcrumbs-->

<!-- START: Card Data-->
<?php if (!empty($this->session->userdata('tr_user_id'))) { ?>
    <div class="row">
        <div class="col-12 col-lg-12  mt-3">
            <div class="card overflow-hidden">
                <div class="card-content">
                    <div class="card-body p-0">
                        <div class="row">

                            <div class="col-12 col-lg-3 d-block d-md-flex d-lg-block">
                                <div class="card bg-primary rounded-0 col-12 col-md-4 col-lg-12">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <i class="ti-shortcode card-liner-icon mt-2 text-white"></i>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title text-white"><?php echo str_replace('_', '/', $this->Crud->read_field('current', '1', 'session', 'session')); ?></h2>
                                                <h6 class="card-liner-subtitle text-white">Current Session</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-primary  rounded-0 col-12 col-md-4 col-lg-12">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-3 align-self-center'>
                                            <i class="fas fa-user-plus  card-liner-icon mt-2 text-white"></i>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title text-white"><?php $session =$this->Crud->read_field('current', '1', 'session', 'session');  if(!empty($this->Crud->read2('level', 'ND', 'admission_session', $session, 'student'))){echo  count($this->Crud->read2('level', 'ND', 'admission_session', $session, 'student'));}else { echo 0;} ?></h2>
                                                <h6 class="card-liner-subtitle text-white">New ND Students</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-primary  rounded-0 col-12 col-md-4 col-lg-12">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <i class="fas fa-user-tie  card-liner-icon mt-2 text-white"></i>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title text-white"><?php $session =$this->Crud->read_field('current', '1', 'session', 'session');  if(!empty($this->Crud->read2('level', 'HND', 'admission_session', $session, 'student'))){echo count( $this->Crud->read2('level', 'HND', 'admission_session', $session, 'student'));}else { echo 0;} ?></h2>
                                                <h6 class="card-liner-subtitle text-white">New HND Students</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-9 mt-3">
                                <div class="col-12 col-lg-12 mt-1">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="card-title">Transcript Request History</h6>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body p-0 table-responsive">
                                                <table id="dtable" class="display table dataTable table-striped" >
                                                    <thead>
                                                        <tr>
                                                            <th>Student ID</th>
                                                            <th>Request Date</th>
                                                            <th>Request Type</th>
                                                            <th>Request Status</th>
                                                            <th width="200px">Action</th>
                                                        </tr>
                                                    </thead>
                                                   <tbody></tbody>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
       
    </div>
<?php } else { ?>
    <div class="row">
       <div class="col-12 col-lg-9 mt-3">
                                <div class="col-12 col-lg-12 mt-1">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="card-title">Transcript Request History</h6>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body p-0 table-responsive">
                                                <table id="dtable" class="display table dataTable table-striped" >
                                                    <thead>
                                                        <tr>
                                                            <th>Student ID</th>
                                                            <th>Request Date</th>
                                                            <th>Request Type</th>
                                                            <th>Request Status</th>
                                                            <th width="200px">Action</th>
                                                        </tr>
                                                    </thead>
                                                   <tbody></tbody>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

       
    </div>


<?php } ?>
<br> <br> <br> <br> <br> <br> <br> <br><!-- END: Card DATA-->
