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
    <div class="row">
        <div class="col-12 col-lg-12  mt-3">
            <div class="card overflow-hidden">
                <div class="card-content">
                    <div class="card-body p-0">
                        <div class="row">

                            <div class="contacts list">
                                    <div class="contact family-contact"> 
                                        <div class="contact-content">
                                            <div class="contact-profile">                                                   
                                               <div class="contact-email">
                                                    <p class="contact-name mb-0 font-weight-bold"><marquee><h4>WELCOME <?php echo $student_id =$this->session->userdata('tr_student_id'); ?></h4></marquee></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contact friend-contact"> 
                                        <div class="contact-content">
                                            <div class="contact-profile">                                                   
                                               <div class="contact-info">
                                                    <p class="contact-name mb-0"><?php echo strtoupper($this->Crud->read_field('student_id', $student_id, 'student', 'surname').' '.$this->Crud->read_field('student_id', $student_id, 'student', 'firstname')); ?></p>
                                                    <p class="contact-position mb-0 small font-weight-bold text-muted">Full Name</p>
                                                </div>
                                            </div>
                                            <div class="contact-email">
                                                <p class="mb-0 small">Degree Type: </p>
                                                <p class="user-email"><?php echo  $this->Crud->read_field('student_id', $student_id, 'student', 'level')?></p>
                                            </div>
                                            <div class="contact-location">
                                                <p class="mb-0 small">Admission Year: </p>
                                                <p class="user-location"><?php echo str_replace('_', '/', $this->Crud->read_field('student_id', $student_id, 'student', 'admission_session')) ?></p>
                                            </div>
                                            <div class="contact-phone">
                                                <p class="mb-0 small">Graduation Year: </p>
                                                <p class="user-phone"><?php $ses = substr($this->Crud->read_field('student_id', $student_id, 'student', 'admission_session'), 0, 4);$ses2 = substr($this->Crud->read_field('student_id', $student_id, 'student', 'admission_session'), 5, 8);
                                                     $sess = $ses + 1;$prev_ses = $sess.'/'; echo $prev_ses;  
                                                     $sess2 = $ses2 + 1;$prev_ses2 = $sess2; echo $prev_ses2;  


                                                     ?></p>
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

<br> <br> <br> <br> <br> <br> <br> <br><!-- END: Card DATA-->
