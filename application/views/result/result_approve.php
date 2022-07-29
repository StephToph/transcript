<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h4 class="card-title">Student Scores || <?php echo strtoupper($level.' '.$programme_type.' Time '.$semester.' semester  for '.$session.' Session.') ?></h4>
                <h4 class="card-title" style="float: ight;"><?php $cuse = str_replace(' ', '_', $course); echo strtoupper($course.' - '.$this->Crud->read_field('code', $course, 'course', 'name')); ?></h4>
                <div>
                    <a href="javascript:;" class="btn btn-primary pop rounded-btnt" style="float: right;" pageTitle="Approve Result" pageName="<?php echo base_url('result/app_result/'.$cuse); ?>" pageSize="modal-sm">Approve Result </a> 
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dtable" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>Matric No</th>
                                <th>Full Name</th>
                                <th width="200px">Continuous Assessment</th>
                                <th width="200px">Examimation</th>
                                <th width="150px">Total Score</th>
                                <th width="200px">Remark</th>
                            </tr>
                        </thead>
                       <tbody><form class="Autosave" method="post" action="result/autosave">
                           <input type="hidden" name="course_code" id="course_code" value="<?php echo $course; ?>">
                           <?php 
                           $session = $session;
                           $student = $this->Crud->read2('course_code', $course, 'session', $session, 'result'); 
                            if (empty($student)) {
                               echo '<tr><td colspan="6">'.$this->Crud->msg('danger', 'No Record of Student Found!!').'</td></tr>';
                            } else {
                               

                            foreach ($student as $stud) { ?>


                                <tr>
                                   <td><?php echo strtoupper($stud->student_id); ?></td>
                                   <td><?php echo strtoupper($this->Crud->read_field('student_id', $stud->student_id, 'student', 'surname').' '.$this->Crud->read_field('student_id', $stud->student_id, 'student', 'firstname')); ?></td>
                                   <td><?php if(!empty($this->Crud->read_field2('course_code', $course, 'student_id', $stud->student_id, 'result', 'ca'))){echo $this->Crud->read_field2('course_code', $course, 'student_id', $stud->student_id, 'result', 'ca');}else{echo 0;} ?>
                                    </td>
                                   <td><?php if(!empty($this->Crud->read_field2('course_code', $course, 'student_id', $stud->student_id, 'result', 'exam'))){echo $this->Crud->read_field2('course_code', $course, 'student_id', $stud->student_id, 'result', 'exam');}else{echo 0;} ?></td>
                                   <td><?php if(!empty($this->Crud->read_field2('course_code', $course, 'student_id', $stud->student_id, 'result', 'total'))){echo $this->Crud->read_field2('course_code', $course, 'student_id', $stud->student_id, 'result', 'total');}else{echo 0;} ?></td>
                                   <td><span id="remark"><?php if($stud->approve_status == 0){echo $this->Crud->msg('danger', 'Not Approved');} else {echo $this->Crud->msg('success', 'Approved');} ?></span></td>

                                </tr>
                            <?php }} ?>
                       </form></tbody>
                        
                    </table>
                </div>
            </div>
        </div> 

    </div>                  
</div>
<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
