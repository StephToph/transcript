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
   <?php } else { // insert/edit view ?>
        <input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
        
        
        <div class="form-row">
            <div class="col-12 mb-3">
                <label for="username">Course Code</label>
                <select class="form-control" name="code" id="code" required onchange="course();">
                    <option value="">--Select Course Code--</option>
                    <?php $cod = $this->Crud->read('course');
                        foreach ($cod as $cods) {?>
                        <option value="<?php echo $cods->code; ?>" <?php if(!empty($e_course_code)){if($e_course_code == $cods->code){echo 'selected';}} ?>><?php echo strtoupper($cods->code); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12" id="course_name"></div>

            <div class="col-12 mb-3">
                <label for="username">Semester</label>
                <select class="form-control" name="semester" id="semester" required>
                    <option value="">--Select Semester--</option>
                    <option value="First" <?php if(!empty($e_semester)){if($e_semester == 'First'){echo 'selected';}} ?>>First</option>
                    <option value="Second" <?php if(!empty($e_semester)){if($e_semester == 'Second'){echo 'selected';}} ?>>Second</option>
                </select>
            </div>

            <div class="col-12 mb-3">
                <label for="username">Proagramme Type</label>
                 <select class="form-control" name="programme_type" id="programme_type" required>
                    <option value="">--Select Programme Type--</option>
                    <option value="Full" <?php if(!empty($e_programme_type)){if($e_programme_type == 'Full'){echo 'selected';}} ?>>Full Time</option>
                    <option value="Part" <?php if(!empty($e_programme_type)){if($e_programme_type == 'Part'){echo 'selected';}} ?>>Part Time</option>
                </select>
            </div>

            <div class="col-12 mb-3">
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
    function course() {
        var code = $('#code').val();
        var cod = code.replace(" ", "_")
        $.ajax({
            url: '<?php echo base_url('users/cos'); ?>/'+ cod,
            success: function(data) {
                $('#course_name').html(data);
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
