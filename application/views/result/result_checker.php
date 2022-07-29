<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h4 class="card-title"><b><?php echo strtoupper($student_id); ?></b> RESULT || <?php echo strtoupper($level.' '.$semester.' semester  for '.$session.' Session.') ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dtable" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th >Course Unit</th>
                                <th>Score</th>
                                <th>Grade Point</th>
                                <th>Score Point</th>
                                <th>Letter Grade</th>
                            </tr>
                        </thead>
                       <tbody><?php 
                           $session = $session;
                           $course = $this->Crud->read_order3('semester', $semester, 'level', $level, 'programme_type', 'Full', 'course_allocate', 'course_code', 'asc'); 
                            if (empty($course)) {
                               echo '<tr><td colspan="6">'.$this->Crud->msg('danger', 'No Record Found!!').'</td></tr>';
                            } else {
                              $t_course = 0;
                              $t_unit = 0;

                            foreach ($course as $stud) { ?>


                                <tr>
                                   <td><?php echo strtoupper($stud->course_code); ?></td>
                                   <td><?php echo strtoupper($this->Crud->read_field('code', $stud->course_code, 'course', 'name')); ?></td>
                                   <td><?php echo strtoupper($this->Crud->read_field('code', $stud->course_code, 'course', 'unit')); ?></td>
                                   <td><?php if(!empty($this->Crud->read_field3('course_code', $stud->course_code, 'student_id', $student_id, 'approve_status', '1', 'result', 'total'))){echo $this->Crud->read_field3('course_code', $stud->course_code, 'student_id', $student_id, 'approve_status', '1', 'result', 'total');}else{echo '0';} ?></td>
                                   <?php
                                    $score = $this->Crud->read_field3('course_code', $stud->course_code, 'student_id', $student_id, 'approve_status', '1', 'result', 'total');
                                    $unit = $this->Crud->read_field('code', $stud->course_code, 'course', 'unit');
                                    if($score >= 75){
                                      $gp = 4.00;
                                      $lg = 'AA';
                                    } elseif ($score >=70 && $score <= 74) {
                                      $gp = 3.50;
                                      $lg = 'A';
                                    } elseif ($score >=65 && $score <= 69) {
                                      $gp = 3.25;
                                      $lg = 'AB';
                                    } elseif ($score >=60 && $score <= 64) {
                                      $gp = 3.00;
                                      $lg = 'B';
                                    } elseif ($score >=55 && $score <= 59) {
                                      $gp = 2.75;
                                      $lg = 'BC';
                                    } elseif ($score >=50 && $score <= 54) {
                                      $gp = 2.50;
                                      $lg = 'C';
                                    } elseif ($score >=45 && $score <= 49) {
                                      $gp = 2.25;
                                      $lg = 'CD';
                                    } elseif ($score >=40 && $score <= 44) {
                                      $gp = 2.00;
                                      $lg = 'D';
                                    } elseif ($score >=35 && $score <= 39) {
                                      $gp = 1.75;
                                      $lg = 'DD';
                                    } elseif ($score >=30 && $score <= 34) {
                                      $gp = 1.50;
                                      $lg = 'DE';
                                    } elseif ($score >=25 && $score <= 29) {
                                      $gp = 1.25;
                                      $lg = 'E';
                                    } elseif ($score >=20 && $score <= 24) {
                                      $gp = 1.00;
                                      $lg = 'EE';
                                    } elseif ($score >=0 && $score <= 19) {
                                      $gp = 0.00;
                                      $lg = 'F';
                                    } else {
                                      $gp = 0.00;
                                      $lg = 'F';
                                    }

                                    ?>
                                    <td><?php echo $gp; ?></td>
                                    <td><?php $total = floatval($unit) * floatval($gp); $t_course +=$total; $t_unit += $unit; echo $total; ?></td>
                                    <td><?php echo $lg; ?></td>
                                </tr>
                            <?php }} ?>
                                <tr>
                                  <td colspan="2">Weight Grade Point = <?php echo $t_course; ?></td>
                                  <td>Total Course Unit = <?php echo $t_unit; ?></td>
                                  <td colspan="2"><b>G.P.A = <?php echo $dop = round($t_course/$t_unit, 2); ?></b></td>
                                  <?php 
                                  $sessions = str_replace('_', '/', $this->Crud->read_field('student_id', $student_id, 'student',  'admission_session'));
                                  if (($sessions == $session) and $semester == 'First') {?>
                                    <td colspan="2"><b>C.P.G.A =  <?php echo round($t_course/$t_unit, 2); ?></b></td>
                                  <?php } elseif (($sessions == $session) and $semester == 'Second') { ?>
                                    <td colspan="2"><b>C.G.P.A = 
                                      <?php $i = 0;
                                        $ses = $this->Crud->read2('student_id', $student_id, 'session', $sessions, 'result_grade');
                                        foreach ($ses as $keys) {
                                         $i += $keys->gpa;
                                        }
                                        echo $dop = round($i/count($ses), 2);
                                       ?>
                                    </b></td>
                                  <?php } elseif (($sessions != $session) and $semester == 'First') { ?>
                                    <td colspan="2"><b>C.G.P.A = 
                                      <?php $i = 0; $count = 0;
                                        $ses = $this->Crud->read_single('student_id', $student_id, 'result_grade');
                                          foreach ($ses as $keys) { $i += $keys->gpa;
                                             if ($count == 2) {
                                                 $a = $i;
                                               }  
                                            $count++;   
                                          }
                                       echo $dop = round($a/3, 2);
                                       ?>
                                    </b></td>
                                  <?php } else {?>
                                     <td colspan="2"><b>C.G.P.A = 
                                      <?php $i = 0;
                                        $ses = $this->Crud->read_single('student_id', $student_id, 'result_grade');
                                        foreach ($ses as $keys) {
                                         $i += $keys->gpa;
                                        }
                                        echo $dop = round($i/4, 2);
                                       ?>
                                    </b></td>
                                  <?php } ?>
                                </tr>
                                <?php
                                 // $dop = round($t_course/$t_unit, 2);
                                  if ($dop > 3.50) {
                                     $dp = 'DISTINCTION';
                                  } elseif ($dop >= 3.00 and $dop <= 3.49) {
                                      $dp = 'UPPER CREDIT';
                                  }elseif ($dop >= 2.50 and $dop <=2.99) {
                                      $dp = 'LOWER CREDIT';
                                  }elseif ($dop >= 2.00 and $dop <= 2.49) {
                                      $dp = 'PASS';
                                  }elseif ($dop <=2.00) {
                                      $dp = 'FAIL';
                                  }
                                 ?>
                                <tr><td colspan="7" style="font-size: 20px;"><center><b>Class of Diploma: <?php echo $dp; ?></b></center></td></tr>
                       </form></tbody>
                        
                    </table>
                </div>
            </div>
        </div> 

    </div>                  
</div>