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
    <?php } elseif($param2 == 'current'){?>
        <input type="hidden" id="current" name="current" value="1" />
        
        <div class="col-12 mb-3">
            <label for="name">Current Session</label><br>
            <select class="form-control" id="sesson" name="sesson" required>
                <option value="">--Select Session--</option>
                <?php $ses = $this->Crud->read('session'); foreach ($ses as $key) {?>
                    <option value="<?php echo $key->session; ?>"><?php echo str_replace('_', '/', $key->session); ?></option>
                <?php } ?>
            </select>
        </div>
            
        <div class="col-12">
            <center>
                <button type="submit" class="btn btn-primary btn-block" style="float: center;">Update</button> 
            </center>
        </div>

    <?php } else { // insert/edit view ?>
		<input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
        
        <div class="col-12 mb-3">
			<label for="name">Session</label><br>
			<input class="form-control" type="text" id="session" name="session" value="<?php if(!empty($e_session)){echo str_replace('_', '/', $e_session);} ?>" required>
        </div>
            

        <div class="col-12">
            <center>
                <button type="submit" class="btn btn-primary btn-block" style="float: center;">Save</button> 
            </center>
        </div>
    <?php } ?>
</div>
<?php echo form_close(); ?>

<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
