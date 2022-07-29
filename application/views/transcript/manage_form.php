<?php echo form_open_multipart($form_url, array('id'=>'bb_ajax_form', 'class'=>'form-horiontal')); ?>

    <div id="bb_ajax_msg"></div>
    
    <?php if($param2 == 'view') { // delete view ?>
        
        <div class="col-12 mb-3">
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
                            <th><?php echo strtoupper($this->Crud->read_field('student_id', $e_student_id, 'student', 'surname').' '.$this->Crud->read_field('student_id', $e_student_id, 'student', 'firstname')); ?></th>
                        </tr>
                        <tr>
                            <th>SESSION</th>
                            <th><?php $start =  substr( $this->Crud->read_field('student_id', $e_student_id, 'student', 'admission_session'), 0, 4);$end =  substr( $this->Crud->read_field('student_id', $e_student_id, 'student', 'admission_session'), 5, 8); echo $start.'/'.$end; $starts= $start+=1;$ends = $end+=1; echo ' - '.$starts.'/'.$ends; ?></th>
                        </tr>
                        <tr>
                            <th>REQUEST TYPE</th>
                            <th><?php echo $e_request_type; ?></th>
                        </tr>
                        <?php if ($e_request_type =='Official') {?>
                            <tr>
                                <th>RECEIVER EMAIL</th>
                                <th><?php echo $e_receiver_email; ?></th>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th>REQUEST STATUS</th>
                            <th><?php if ($e_status == 0) {
                                echo '<span class="text-warning">Request Pending</span>';
                            } elseif ($e_status == 2) {
                                echo '<span class="text-danger">Request Denied</span>';
                            } else {
                                echo '<span class="text-success">Request Approved</span>';
                            } ?></th>
                        </tr>
                        <?php if ($e_status > 0) { ?>
                            <tr>
                                <th>APPROVED/DENIED BY</th>
                                <th><?php echo $this->Crud->read_field('id', $e_request_approve, 'user', 'name'); ?></th>
                            </tr>
                            <tr>
                                <th>APPROVED/DENIED DATE</th>
                                <th><?php echo date('d-F-Y h:i:s a', strtotime($e_date_approved)); ?></th>
                            </tr>
                        <?php } ?>
                   </tbody>
                    
                </table>
            </div>  
        </div>
    <?php } elseif ($param2 =='approve') {?>
         <input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
        
         <div class="form-row">
            <div class="col-12 mb-3">
                <label for="username">Request Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">--Select--</option>
                    <option value="1" <?php if(!empty($e_status)){if($e_status == 1){echo "selected";}} ?>>Approve Request</option>
                    <option value="2" <?php if(!empty($e_status)){if($e_status == 2){echo "selected";}} ?>>Deny Request</option>
                </select>
            </div>
          
            <div class="col-12">
                <center>
                    <button type="submit" class="btn btn-primary btn-block" style="float: center;">Save</button> 
                </center>
            </div>
        </div>


    <?php } else { // insert/edit view ?>
        
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
