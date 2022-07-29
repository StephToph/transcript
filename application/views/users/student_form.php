<?php echo form_open_multipart($form_url, array('id'=>'bb_ajax_form', 'class'=>'form-horiontal')); ?>

    <div id="bb_ajax_msg"></div>
    
    <?php if($param2 == 'delete') { // delete view ?>
        <div class="col-12 text-center">
            <h3><b>Are You Sure?</b></h3>
            <input type="hidden" name="d_id" value="<?php if(!empty($d_id)){echo $d_id;} ?>" />
        </div>
        <div class="form-group text-center m-t-40">
            <div class="col-xs-12">
                <button class="btn btn-danger text-uppercase" type="submit">
                    <span class="btn-label"><i class="fa fa-trash-o"></i></span> Yes - Delete
                </button>
            </div>
        </div>
    <?php } elseif ($param2 == 'view') { ?>
        <div class="form-row">
            <div class="col-3 mb-3">
                <label for="username">Profile Picture</label>
                 <?php 
                    if (!empty($e_img_id)) {
                        $image = $e_img_id;
                    } else {
                        $image = 'assets/avatar.png';
                    }

                ?>   
                <img src="<?php echo base_url($image); ?>" class="d-flex img-fluid" height="600px" width="300px" id="output">
                
            </div>

            <div class="col-9 mb-3">
                <div class="table-responsive">
                    <table class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                       <tbody>
                           <tr>
                                <th>STUDENT ID</th>
                                <th><?php echo $e_student_id; ?></th>
                            </tr>
                            <tr>
                                <th>NAME</th>
                                <th><?php echo strtoupper($e_surname.' '.$e_firstname); ?></th>
                            </tr>
                            <tr>
                                <th>GENDER</th>
                                <th><?php echo $e_gender; ?></th>
                            </tr>
                            <tr>
                                <th>ADDRESS</th>
                                <th><?php echo $e_address; ?></th>
                            </tr>
                            <tr>
                                <th>LEVEL</th>
                                <th><?php echo $e_level; ?></th>
                            </tr>
                            <tr>
                                <th>PROGRAMME TYPE</th>
                                <th><?php echo $e_programme_type; ?></th>
                            </tr>
                            <tr>
                                <th>ADMISSION SESSION</th>
                                <th><?php echo str_replace('_', '/', $e_admission_session); ?></th>
                            </tr>
                            <tr>
                                <th>REGISTRATION DATE</th>
                                <th><?php echo date('d-F-Y h:i:s a', strtotime($e_reg_date)); ?></th>
                            </tr>
                       </tbody>
                        
                    </table>
                </div>  
            </div>
        </div>
    <?php } else { // insert/edit view ?>
        <input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
        
            <div class="col-12 mb-0">
                <div class="form-row">
                    <div class="col-4 mb-3">
                        <label for="username">Profile Picture</label>
                        <?php 
                            if (!empty($e_img_id)) {
                                $image = $e_img_id;
                            } else {
                                $image = 'assets/avatar.png';
                            }

                        ?>   
                        <img src="<?php echo base_url($image); ?>" class="d-flex img-fluid" height="100px" width="100px" id="output">
                        <input type="file" class="form-control" name="pics" id="pics" onchange="loadFile(event)">
                        <span class="help-block"> Enter your Image. </span> 
                    </div>
                    
                    <div class="col-8 mb-0">
                        <div class="form-row">
                            <div class="col-6 mb-3">
                                <label for="username">Student ID</label>
                                <input type="text" name="student_id" id="student_id" class="form-control" required value="<?php if(!empty($e_student_id)){echo $e_student_id;} ?>" oninput="check_id();">
                                <div id="id_response"></div>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="username">Surname</label>
                                <input type="text" name="surname" id="surname" class="form-control" required value="<?php if(!empty($e_surname)){echo $e_surname;} ?>">
                            </div>

                             <div class="col-6 mb-3">
                                <label for="username">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" required value="<?php if(!empty($e_firstname)){echo $e_firstname;} ?>">
                            </div>

                            <div class="col-6 mb-3">
                                <label for="username">Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">--Select--</option>
                                    <option value="Male" <?php if(!empty($e_gender)){if($e_gender == 'Male'){echo 'selected';}} ?>>Male</option>
                                    <option value="Female" <?php if(!empty($e_gender)){if($e_gender == 'Female'){echo 'selected';}} ?>>Female</option>
                                </select>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="username">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">--Select--</option>
                                    <option value="ND" <?php if(!empty($e_level)){if($e_level == 'ND'){echo 'selected';}} ?>>ND</option>
                                    <option value="HND" <?php if(!empty($e_level)){if($e_level == 'HND'){echo 'selected';}} ?>>HND</option>
                                </select>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="username">Programme Type</label>
                                <select name="programme_type" id="programme_type" class="form-control" required>
                                    <option value="">--Select--</option>
                                    <option value="Full-Time" <?php if(!empty($e_programme_type)){if($e_programme_type == 'Full-Time'){echo 'selected';}} ?>>Full-Time</option>
                                    <option value="Part-Time" <?php if(!empty($e_programme_type)){if($e_programme_type == 'Part-Time'){echo 'selected';}} ?>>Part-Time</option>
                                </select>
                            </div>

                             <div class="col-12 mb-3">
                                <label for="username">Address</label>
                                <input type="text" name="address" id="address" class="form-control" required value="<?php if(!empty($e_address)){echo $e_address;} ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <center>
                        <button type="submit" class="btn btn-primary btn-block" style="float: center;">Save</button> 
                    </center>
                </div>
            </div>
    <?php } ?>
</div>


<?php echo form_close(); ?>
<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
  <script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
          URL.revokeObjectURL(output.src) // free memory
        }
    };


    function check_id() {
        var student_id = $('#student_id').val();
        $.ajax({
            url: '<?php echo base_url('users/check_id'); ?>/'+ student_id,
            success: function(data) {
                $('#id_response').html(data);
            }
        });


    }
       
    </script>
