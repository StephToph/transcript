<div class="row ">
    <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Course Allocation</h4></div>

            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Course</li>
                <li class="breadcrumb-item active"><a href="#">Allocation</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END: Breadcrumbs-->

<!-- START: Card Data-->
<div class="row row-eq-height">
    <div class="col-12 col-lg-2 mt-3 todo-menu-bar flip-menu pr-lg-0">
        <a href="#" class="d-inline-block d-lg-none mt-1 flip-menu-close"><i class="icon-close"></i></a>
        <div class="card border h-100 todo-menu-section">
            <div class="card-header d-flex justify-content-between align-items-center">  
               <a href="javascript:;" class="btn btn-primary pop rounded-btnt" style="float: right;" pageTitle="Add Course" pageName="<?php echo base_url('users/course_allocate/manage'); ?>" pageSize="modal-md"><i class="fa fa-plus-square"></i> Allocate Course</a>
            </div>

            <ul class="nav flex-column todo-menu">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-todotype="important">
                        <i class="icon-list"></i> Manage Allocation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-todotype="starred">
                        <i class="icon-people"></i> View Allocation
                    </a>
                </li>
            </ul>         

        </div>  
    </div>
    <div class="col-12 col-lg-10 mt-3 pl-lg-0">
        <div class="card border h-100 todo-list-section">
           <div class="card-body p-0">

                <div class="scrollerodo">
                    <ul class="todo-list">
                        <li class="todo-item important completed">
                            <div class="table-responsive">
                                <table id="dtable" class="display table dataTable table-striped table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Level</th>
                                            <th>Semester</th>
                                            <th>Programme Type</th>
                                            <th width="150px">Action</th>
                                        </tr>
                                    </thead>
                                   <tbody></tbody>
                                    
                                </table>
                            </div>                                                        
                        </li>
                        <li class="todo-item starred" style="display: none;">
                           <div class="row" >                                           
                                <div class="col-12">
                                    <div class="form-row" style="width: 850px">
                                        <div class="col-4 mb-3">
                                            <label for="username">Programme Type</label>
                                            <select class="form-control" name="programme_type" id="programme_type" required>
                                                <option value="">--Select Programme Type--</option>
                                                <option value="Full" <?php if(!empty($e_programme_type)){if($e_programme_type == 'Full'){echo 'selected';}} ?>>Full Time</option>
                                                <option value="Part" <?php if(!empty($e_programme_type)){if($e_programme_type == 'Part'){echo 'selected';}} ?>>Part Time</option>
                                            </select>

                                        </div>

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

                                         <div class="col-2 mb-3">
                                            <label>.</label>
                                            <button type="button" class="btn btn-primary btn-block mb-2" id="btn-view" onclick="resu();">VIEW</button>

                                        </div>


                                    </div>
                                    <div id="view_result"></div>
                                </div>
                            </div>                                                      
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br>
<script type="text/javascript">
    function resu() {
        // show prograss loading
        $('#view_result').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
        var programme_type = $('#programme_type').val();
        var semester = $('#semester').val();
        var level = $('#level').val();
            
        $.ajax({
            url: '<?php echo base_url('users/view_result/'); ?>'+ programme_type + '/' + semester+ '/' + level,
            success: function(data) {
                $('#view_result').html(data);
            }
        });
        
    }
</script>