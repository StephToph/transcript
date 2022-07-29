<?php echo form_open_multipart('result/app_result', array('id'=>'bb_ajax_form2', 'class'=>'form-horiontal')); ?>

    <div id="bb_ajax_msg2"></div>
        <div class="col-12 text-center">
            <h3><b>Are You Sure?</b></h3>
            <input type="hidden" name="course" value="<?php if(!empty($course)){echo $course;} ?>" />
        </div>
        <div class="form-group text-center m-t-40">
            <div class="col-xs-12">
                <button class="btn btn-success text-uppercase" type="submit">
                    <span class="btn-label"><i class="fa fa-save-o"></i></span> Yes - Approve Result
                </button>
            </div>
        </div>
   
</div>


<?php echo form_close(); ?>
<script src="<?php echo base_url(); ?>assets/jsform.js"></script>