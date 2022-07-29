<div class="row">
  <div class="col-12 mt-3">
    <div class="card">
      <div class="card-header  justify-content-between align-items-center">                               
        <h4 class="card-title">Student List || <?php echo strtoupper($level.' '.$programme_type.' Time '.$semester.' semester ') ?></h4>
        <h4 class="card-title" style="float: right;"><?php $cuse = str_replace('%20', ' ', $course); echo strtoupper($cuse.' - '.$this->Crud->read_field('code', $cuse, 'course', 'name')); ?></h4>
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
              <input type="hidden" name="course_code" id="course_code" value="<?php echo $cuse; ?>">
              <input type="hidden" name="programme_type" id="programme_type" value="<?php echo $programme_type; ?>">
              <input type="hidden" name="level" id="level" value="<?php echo $level; ?>">
              <input type="hidden" name="semester" id="semester" value="<?php echo $semester; ?>">
              <?php 
              $session =  $this->Crud->read_field('current', '1', 'session', 'session');
              if ($level == 'ND1') {
                $student = $this->Crud->read_order3('programme_type', $programme_type, 'level', 'ND', 'admission_session', $session, 'student', 'student_id', 'asc'); 
              } elseif ($level == 'ND2') {
                $ses = substr($session, 0, 4);
                $sess = $ses - 1;
                $prev_ses = $sess.'_'.$ses;
                //echo $prev_ses;

                $student = $this->Crud->read_order3('programme_type', $programme_type, 'level', 'ND', 'admission_session', $prev_ses, 'student', 'student_id', 'asc'); 
              } elseif ($level == 'HND1') {
                $student = $this->Crud->read_order3('programme_type', $programme_type, 'level', 'HND', 'admission_session', $session, 'student', 'student_id', 'asc'); 
              } elseif ($level == 'HND2') {
                $ses = substr($session, 0, 4);
                $sess = $ses - 1;
                $prev_ses = $sess.'_'.$ses;
                //echo $prev_ses;

                $student = $this->Crud->read_order3('programme_type', $programme_type, 'level', 'HND', 'admission_session', $prev_ses, 'student', 'student_id', 'asc'); 
              } else {
                
              }

               
                if (empty($student)) {
                   echo '<tr><td colspan="6">'.$this->Crud->msg('danger', 'No Record of Student Found!!').'</td></tr>';
                } else {
                    $count = 1;

                foreach ($student as $stud) { ?>


                    <tr>
                       <td><input type="hidden" name="student_id" id="student_id<?php echo $count; ?>" value="<?php echo $stud->student_id; ?>"><?php echo strtoupper($stud->student_id); ?></td>
                       <td><?php echo strtoupper($stud->surname.' '.$stud->firstname); ?></td>
                       <td>
                            <input type="text" name="ca" id="ca<?php echo $count; ?>" required class="form-control" onkeyup="validates(event)" max="40" value="<?php if(!empty($this->Crud->read_field2('course_code', $cuse, 'student_id', $stud->student_id, 'result', 'ca'))){echo $this->Crud->read_field2('course_code', $cuse, 'student_id', $stud->student_id, 'result', 'ca');}else{echo 0;} ?>" <?php if($this->Crud->check3('course_code', $cuse, 'student_id', $stud->student_id, 'approve_status', '1', 'result') > 0){ echo "disabled";} ?>>
                        </td>
                       <td><input type="text" name="exam" id="exam<?php echo $count; ?>" required onkeyup="validates(event)" class="form-control" max="60"  value="<?php if(!empty($this->Crud->read_field2('course_code', $cuse, 'student_id', $stud->student_id, 'result', 'exam'))){echo $this->Crud->read_field2('course_code', $cuse, 'student_id', $stud->student_id, 'result', 'exam');}else{echo 0;} ?>" <?php if($this->Crud->check3('course_code', $cuse, 'student_id', $stud->student_id, 'approve_status', '1', 'result' )> 0){ echo "disabled";} ?>></td>
                       <td><input type="text" max="100" name="total" id="total<?php echo $count; ?>" required disabled class="form-control" value="<?php if(!empty($this->Crud->read_field2('course_code', $cuse, 'student_id', $stud->student_id, 'result', 'total'))){echo $this->Crud->read_field2('course_code', $cuse, 'student_id', $stud->student_id, 'result', 'total');}else{echo 0;} ?>"></td>
                       <td><span id="remark<?php echo $count; ?>"><?php if($this->Crud->check3('course_code', $cuse, 'student_id', $stud->student_id, 'approve_status', '1', 'result') > 0){ echo $this->Crud->msg('info', 'Approved!!');} ?></span></td>

                    </tr>
                <?php $count++; }} ?> 
                <input type="hidden" id="length" value="<?php if(empty($student)){echo 0;} else{echo count($student);} ?>">
           </form></tbody>
              
          </table>
        </div>
      </div>
    </div> 

  </div>                  
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //validates(evt);
        var timer;
        var timeout = 5000; // Timout duration
        var length = document.getElementById('length').value;
        //alert(length);
        for (let i = 0; i <= length; i++) {
            $('#ca' + i + ', #exam' + i + '').keyup(function(){
                var ca_i = document.getElementById('ca'+i).value;
                var exam_i = document.getElementById('exam'+[i]).value;
                var result_i = parseInt(ca_i) + parseInt(exam_i);
                //alert(ca_i);alert(exam_i);alert(result_i);
                
                if (!isNaN(result_i)) {
                    document.getElementById('total'+[i]).value = result_i;
                }

               if(timer) {
                    clearTimeout(timer);
                }
                timer = setTimeout(saveData(i), timeout); 
                //alert('jhjh');
            }); 
        } 
     
        $('#submit').click(function(){
            saveData(i);
        });
    });

    // Save data
    function saveData(i){
        //alert(i);
        var ca = $('#ca'+i).val();
        var student_id = $('#student_id'+i).val();
        var course_code = $('#course_code').val();
        var exam = $('#exam'+i).val().trim();
        var total = $('#total'+i).val().trim();
        var programme_type = $('#programme_type').val();
        var level = $('#level').val().trim();
        var semester = $('#semester').val().trim();
        //alert(i);

        if(ca != '' || exam != ''){
            // AJAX request
            $.ajax({
                url: '<?php echo base_url('result/autosave'); ?>',
                type: 'post',
                data: {ca:ca,exam:exam,total:total,student_id:student_id,course_code:course_code,level:level,programme_type:programme_type,semester:semester},
                success: function(response){
                    $('#remark'+i).html(response);
                } 
            });
        } 
    }

    function validates(evt) {
          var theEvent = evt || window.event;

          // Handle paste
          if (theEvent.type === 'paste') {
              key = event.clipboardData.getData('text/plain');
          } else {
          // Handle key press
              var key = theEvent.keyCode || theEvent.which;
              key = String.fromCharCode(key);
          }
          var regex = /[0-9]|\./;
          if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
          }
    }
</script>