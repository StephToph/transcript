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
                <input type="text" name="code" id="code" required class="form-control" value="<?php if(!empty($e_code)){echo $e_code;} ?>"><div id="user_response"></div>
            </div>

            <div class="col-12 mb-3">
                <label for="username">Course Name</label>
                <input type="text" name="name" id="name" required class="form-control" value="<?php if(!empty($e_name)){echo $e_name;} ?>">
            </div>

            <div class="col-12 mb-3">
                <label for="username">Course Unit</label>
                <input type="number" name="unit" id="unit" required class="form-control" value="<?php if(!empty($e_unit)){echo $e_unit;}else{echo 0;} ?>" min="0">
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
