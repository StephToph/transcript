<div class="row ">
    <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Check Result</h4></div>

            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Result</li>
                <li class="breadcrumb-item active"><a href="#">Result Checker</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END: Breadcrumbs-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <?php echo form_open_multipart('result/checker', array('id'=>'bb_ajax_form', 'class'=>'form-horiontal')); ?>


                <div class="form-row" style="width: auto;">
                    <marquee><span class="text-info">Please Select all Fields</span></marquee>
                    <div class="col-3 mb-3">
                        <label for="username">Level</label>
                        <select class="form-control" name="level" id="level" required>
                            <option value="">--Select Level--</option>
                            <option value="ND1" <?php if(!empty($e_level)){if($e_level == 'ND1'){echo 'selected';}} ?>>ND1</option>
                            <option value="ND2" <?php if(!empty($e_level)){if($e_level == 'ND2'){echo 'selected';}} ?>>ND2</option>
                            <option value="ND3" <?php if(!empty($e_level)){if($e_level == 'ND3'){echo 'selected';}} ?>>ND3</option>
                            <option value="HND1" <?php if(!empty($e_level)){if($e_level == 'HND1'){echo 'selected';}} ?>>HND1</option>
                            <option value="HND2" <?php if(!empty($e_level)){if($e_level == 'HND2'){echo 'selected';}} ?>>HND2</option>
                            <option value="HND3" <?php if(!empty($e_level)){if($e_level == 'HND3'){echo 'selected';}} ?>>HND3</option>
                        </select>

                    </div>

                    <div class="col-3 mb-3">
                        <label for="username">Semester</label>
                        <select class="form-control" name="semester" id="semester" required>
                            <option value="">--Select Semester--</option>
                            <option value="First" <?php if(!empty($e_semester)){if($e_semester == 'First'){echo 'selected';}} ?>>First</option>
                            <option value="Second" <?php if(!empty($e_semester)){if($e_semester == 'Second'){echo 'selected';}} ?>>Second</option>
                        </select>

                    </div>

                    <div class="col-3 mb-3">
                        <label for="username">Session</label>
                        <select class="form-control" name="session" id="session" required>
                            <option value="">--Select Session--</option>
                            <?php $ses = $this->Crud->read('session');
                                foreach ($ses as $key) {?>
                                <option value="<?php echo $key->session; ?>" <?php if(!empty($e_semester)){if($e_semester == 'First'){echo 'selected';}} ?>><?php echo str_replace('_', '/', $key->session); ?></option>
                            <?php } ?>
                        </select>

                    </div>

                    <?php if ($this->session->userdata('tr_student_id')) {?>
                        <div class="col-3 mb-3">
                             <input type="hidden" class="form-control" id="student_id" name="student_id" value="<?php echo $this->session->userdata('tr_student_id'); ?>">
                        </div>
                    <?php } else {?>
                        <div class="col-3 mb-3">
                            <label for="username">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" required>
                        </div>
                    <?php } ?>


                    

                    <div class="col-12 mb-3">
                       <button type="submit" class="btn btn-primary btn-block mb-2" id="btn-view" >VIEW</button>

                   </div>
                </div>
                    <?php echo form_close(); ?>


            </div>
        </div> 
        <br>
        <div id="bb_ajax_msg"></div>

    </div>                  
</div>
    
</div><br><br><br><br><br><br></div>