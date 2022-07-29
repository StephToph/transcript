<div class="row ">
    <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Request Transcript</h4></div>

            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active"><a href="#">Transcript</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END: Breadcrumbs-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <?php echo form_open_multipart('transcript/send', array('id'=>'bb_ajax_form', 'class'=>'form-horiontal')); ?>


                <div class="form-row" style="width: auto;">
                    <marquee><span class="text-info">Please Select all Fields</span></marquee>
                    <div class="col-4 mb-3">
                        <label for="username">Request Type</label>
                        <select class="form-control" name="request_type" id="request_type" required onchange="sty()">
                            <option value="">--Select Type--</option>
                            <option value="Official">Official</option>
                            <option value="Unofficial">Unofficial</option>
                        </select>

                    </div>

                    <div class="col-4 mb-3"id="styl" style="display: none;" >
                        <label for="username">Recipient Email</label>
                        <input type="email" name="rec_email" id="rec_email"  class="form-control">

                    </div>

                     
                    <div class="col-4 mb-3"><label>.</label>
                       <button type="submit" class="btn btn-primary btn-block mb-2" id="btn-view" >SEND REQUEST</button>

                   </div>
                </div>
                    <?php echo form_close(); ?>


            </div>
        </div> 
        <br>
        <div id="bb_ajax_msg"></div>

    </div>                  
</div>
</div><br><br><br><br><br><br></div><br><br><br>
<script type="text/javascript">
    function sty() {
        var request_type = $('#request_type').val();
                
        var styl = document.getElementById('styl');
        //alert(request_type);
        if (request_type === "Official") {
            styl.style.display = "block";
        } else {
            styl.style.display = "none";
        }
    }
</script>