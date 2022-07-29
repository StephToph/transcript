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
                <label for="username">Staff ID</label>
                <input type="text" name="staff_id" id="staff_id" required class="form-control" oninput="check_name();" value="<?php if(!empty($e_staff_id)){echo $e_staff_id;} ?>"><div id="user_response"></div>
            </div>

            <div class="col-12 mb-3">
                <label for="username">Full Name</label>
                <input type="text" name="name" id="name" required class="form-control" value="<?php if(!empty($e_name)){echo $e_name;} ?>">
            </div>

            <div class="col-12 mb-3">
                <label for="username">User Role</label>
                <select class="form-control" name="role" id="role" required>
                    <option value="">--Select Role--</option>
                    <option value="Admin" <?php if(!empty($e_user_role)){if($e_user_role == 'Admin'){echo 'selected';}} ?>>Admin</option>
                    <option value="Superadmin" <?php if(!empty($e_user_role)){if($e_user_role == 'Superadmin'){echo 'selected';}} ?>>Superadmin</option>
                </select>
            </div>


            <?php if($param2 == 'edit'){?>
                <div class="col-12 mb-3">
                    <label for="username">Active Status</label>
                    <select class="form-control" name="active_stat" id="active_stat" required>
                        <option value="">--Select Status--</option>
                        <option value="0" <?php if(empty($e_active_stat)){if($e_active_stat == '0'){echo 'selected';}} ?>>Deactivate Account</option>
                        <option value="1" <?php if(!empty($e_active_stat)){if($e_active_stat == '1'){echo 'selected';}} ?>>Activate Account</option>
                    </select>
                </div>
            
            <?php } else {?>
                <div class="col-12 mb-3">
                    <label for="username">Password</label>
                    <input type="password" name="password" id="password" required class="form-control" minlength="5">
                </div>

                <div class="col-12 mb-3">
                    <label for="username">Confirm Password</label>
                    <input type="password" name="confirm" id="confirm" required class="form-control" minlength="5" oninput="check_password();">
                    <div id="password_response"></div>
                </div>
            <?php } ?>

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
    function check_name() {
        var name = $('#staff_id').val();
        $.ajax({
            url: '<?php echo base_url('users/check_username'); ?>/'+ name,
            success: function(data) {
                $('#user_response').html(data);
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
