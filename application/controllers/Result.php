<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

	public function input() {
		if(empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('login'), 'refresh');
		}
		$user_id = $this->session->userdata('truser_id');
				
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;
		
		$data['title'] = 'Manage Result | '.app_name;
		$data['page_active'] = 'result_in';
		$this->load->view('designs/header', $data);
		$this->load->view('result/result_input', $data);
		$this->load->view('designs/footer', $data);
		
		
	}

	public function check() {
		if(empty($this->session->userdata('tr_user_id')) and empty($this->session->userdata('tr_student_id'))) {
			redirect(base_url('login'), 'refresh');
		}
		$user_id = $this->session->userdata('truser_id');
				
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;
		
		$data['title'] = 'Check Result | '.app_name;
		$data['page_active'] = 'check_result';
		$this->load->view('designs/header', $data);
		$this->load->view('result/check_result', $data);
		$this->load->view('designs/footer', $data);
		
		
	}

	public function checker(){
		if ($_POST) {
			$level = $this->input->post('level');
			$semester = $this->input->post('semester');
			$session = $this->input->post('session');
			$student_id = $this->input->post('student_id');

			if ($level=='' || $semester==''|| $session=="" || $student_id=='') {
				echo $this->Crud->msg('warning', 'Please Fill all Fields');
			} else {

				if (empty($this->Crud->check('student_id', $student_id, 'student'))) {
					echo $this->Crud->msg('danger', 'Invalid Student Id!!');
				} elseif (empty($this->Crud->check4('level', $level, 'semester', $semester, 'session', str_replace('_', '/', $session), 'student_id', $student_id, 'result'))) {
					echo $this->Crud->msg('danger', 'No Record for This Student!!');
				} else {
					// pass parameters to view
					$data['session'] = str_replace('_', '/', $session);
					$data['semester'] = $semester;
					$data['level'] = $level;
					$data['student_id'] = $student_id;
					
					$this->load->view('result/result_checker', $data);
				}
				
			}
		}
	}

	public function type_result($param1='', $param2='', $param3='') {
		if (empty($param1) or empty($param2) or empty($param3)) {
			echo $this->Crud->msg('warning', 'Please Select all Fields!!');

		} else {
			$cous = $this->Crud->read3('programme_type', $param1, 'semester', $param2, 'level', $param3, 'course_allocate');
			echo '
				<div class="col-12 mb-3">
                    <label for="username">Course Taken</label>
                    <select class="form-control" name="course_code" id="course_code" required onchange="bute();">
                        <option value="">--Select Course--</option>';
                        foreach ($cous as $key) {
                        	echo '<option value="'.$key->course_code.'">'.$this->Crud->read_field('code', $key->course_code, 'course', 'name').'</option>';
                        }
                    echo '</select>

                </div>
                
			';
		}
	}

	public function stud_result($param1='', $param2='', $param3='',$param4='')	{
		if (empty($param1) or empty($param2) or empty($param3) or $param3=="undefined" or empty($param4)) {
			echo $this->Crud->msg('warning', 'Please Select all Fields!!');

		} else {
			// pass parameters to view
			$data['programme_type'] = $param1;
			$data['semester'] = $param2;
			$data['course'] = $param3;
			$data['level'] = $param4;
			
			$this->load->view('result/result_in', $data);
		}
	}

	public function autosave(){
		if (isset($_POST)) {
			$exam = $_POST['exam'];
			$ca = $_POST['ca'];
			$total = $this->input->post('total');
			$level = $this->input->post('level');
			$semester = $this->input->post('semester');
			$programme_type = $this->input->post('programme_type');
			$course_code = $this->input->post('course_code');
			$student_id = $this->input->post('student_id');
			$session = str_replace('_', '/', $this->Crud->read_field('current', '1', 'session', 'session'));


			$unit = $this->Crud->read2('level', $level, 'semester', $semester, 'course_allocate');
			$t_unit = 0;

			foreach ($unit as $key) {
				$un = $this->Crud->read_field('code', $key->course_code, 'course', 'unit');
				$t_unit = $t_unit+=$un;
			}
			
			if ($exam=='' || $ca=='') {
				echo $this->Crud->msg('warning', 'Please input all Fields!');
			} else {
				if ($this->Crud->check2('course_code', $course_code, 'student_id', $student_id, 'result') > 0) {
					$up_data['ca'] = $ca;
					$up_data['exam'] = $exam;
					$up_data['total'] = $total;

					$upd_rec = $this->Crud->update2('course_code', $course_code, 'student_id', $student_id, 'result', $up_data);
					if($upd_rec > 0) {
						$all = $this->Crud->read3('student_id', $student_id, 'semester', $semester, 'level', $level, 'result');
						$scores = 0;
						foreach ($all as $key) {
							$total = $key->total;
							////////////////////////////////////////////Grade Point///////////////////////
								if($total >= 75){
					              $gp = 4.00;
					              $lg = 'AA';
					            } elseif ($total >=70 && $total <= 74) {
					              $gp = 3.50;
					              $lg = 'A';
					            } elseif ($total >=65 && $total <= 69) {
					              $gp = 3.25;
					              $lg = 'AB';
					            } elseif ($total >=60 && $total <= 64) {
					              $gp = 3.00;
					              $lg = 'B';
					            } elseif ($total >=55 && $total <= 59) {
					              $gp = 2.75;
					              $lg = 'BC';
					            } elseif ($total >=50 && $total <= 54) {
					              $gp = 2.50;
					              $lg = 'C';
					            } elseif ($total >=45 && $total <= 49) {
					              $gp = 2.25;
					              $lg = 'CD';
					            } elseif ($total >=40 && $total <= 44) {
					              $gp = 2.00;
					              $lg = 'D';
					            } elseif ($total >=35 && $total <= 39) {
					              $gp = 1.75;
					              $lg = 'DD';
					            } elseif ($total >=30 && $total <= 34) {
					              $gp = 1.50;
					              $lg = 'DE';
					            } elseif ($total >=25 && $total <= 29) {
					              $gp = 1.25;
					              $lg = 'E';
					            } elseif ($total >=20 && $total <= 24) {
					              $gp = 1.00;
					              $lg = 'EE';
					            } elseif ($total >=0 && $total <= 19) {
					              $gp = 0.00;
					              $lg = 'F';
					            } else {
					              $gp = 0.00;
					              $lg = 'F';
					            }
				            /////////////////////////////////////////////////////
							$c_unit = $this->Crud->read_field('code', $key->course_code, 'course', 'unit');
							$c_score = floatval($gp) * floatval($c_unit);
							$score = round($c_score/$t_unit, 2);
							$scores += $score;
						}
						
						//echo $c_unit.' '.$c_score.' '.$score.' '.$scores.' '.$t_unit;
						$upd_data['gpa'] = $scores;
						if (($semester == 'First' and $level =='ND1') or ($semester == 'First' and $level =='HND1')) {
							$upd_data['cgpa'] = $scores;
						} else {
							
							$upd_data['cgpa'] = $scores;
						}	
						$u_reco = $this->Crud->update3('semester', $semester, 'student_id', $student_id, 'level', $level, 'result_grade', $upd_data);
						if ($u_reco > 0) {
							$cpa = $this->Crud->read_single('student_id', $student_id, 'result_grade');
							$t_cgpa = 0;
							foreach ($cpa as $key) {
								$cgpa = $key->gpa;
								$t_cgpa += $cgpa;
							}
							$tot = round($t_cgpa/count($cpa), 2);
							$upd_dat['cgpa'] = $tot;
							//echo $tot.' '.$u;
							$this->Crud->update3('semester', $semester, 'student_id', $student_id, 'level', $level, 'result_grade', $upd_dat);
						
						}
						echo $this->Crud->msg('success', 'Record Updated');
					} else {
						echo $this->Crud->msg('info', 'No Changes');	
					}
					
				} else {
					$ins_data['student_id'] = $student_id;
					$ins_data['session'] = $session;
					$ins_data['course_code'] = $course_code;
					$ins_data['ca'] = $ca;
					$ins_data['exam'] = $exam;
					$ins_data['level'] = $level;
					$ins_data['semester'] = $semester;
					$ins_data['programme_type'] = $programme_type;
					$ins_data['total'] = $total;
					$ins_data['lecturer'] = $this->Crud->read_field('id', $this->session->userdata('tr_user_id'), 'user', 'staff_id');

						
					
					$ins_rec = $this->Crud->create('result', $ins_data);
					if($ins_rec > 0) {
						if ($this->Crud->check3('student_id', $student_id, 'level', $level, 'semester', $semester, 'result_grade') > 0) {

							$all = $this->Crud->read3('student_id', $student_id, 'semester', $semester, 'level', $level, 'result');
							$scores = 0;
							foreach ($all as $key) {
								$total = $key->total;
								////////////////////////////////////////////Grade Point///////////////////////
									if($total >= 75){
						              $gp = 4.00;
						              $lg = 'AA';
						            } elseif ($total >=70 && $total <= 74) {
						              $gp = 3.50;
						              $lg = 'A';
						            } elseif ($total >=65 && $total <= 69) {
						              $gp = 3.25;
						              $lg = 'AB';
						            } elseif ($total >=60 && $total <= 64) {
						              $gp = 3.00;
						              $lg = 'B';
						            } elseif ($total >=55 && $total <= 59) {
						              $gp = 2.75;
						              $lg = 'BC';
						            } elseif ($total >=50 && $total <= 54) {
						              $gp = 2.50;
						              $lg = 'C';
						            } elseif ($total >=45 && $total <= 49) {
						              $gp = 2.25;
						              $lg = 'CD';
						            } elseif ($total >=40 && $total <= 44) {
						              $gp = 2.00;
						              $lg = 'D';
						            } elseif ($total >=35 && $total <= 39) {
						              $gp = 1.75;
						              $lg = 'DD';
						            } elseif ($total >=30 && $total <= 34) {
						              $gp = 1.50;
						              $lg = 'DE';
						            } elseif ($total >=25 && $total <= 29) {
						              $gp = 1.25;
						              $lg = 'E';
						            } elseif ($total >=20 && $total <= 24) {
						              $gp = 1.00;
						              $lg = 'EE';
						            } elseif ($total >=0 && $total <= 19) {
						              $gp = 0.00;
						              $lg = 'F';
						            } else {
						              $gp = 0.00;
						              $lg = 'F';
						            }
					            /////////////////////////////////////////////////////
								$c_unit = $this->Crud->read_field('code', $key->course_code, 'course', 'unit');
								$c_score = floatval($gp) * floatval($c_unit);
								$score = round($c_score/$t_unit, 2);
								$scores += $score;
							}
							$upd_data['gpa'] = $scores;
							if (($semester == 'First' and $level =='ND1') or ($semester == 'First' and $level =='HND1')) {
								$upd_data['cgpa'] = $scores;
							} else {
								$cpa = $this->Crud->read_single('student_id', $student_id, 'result_grade');
								$t_cgpa = 0;
								foreach ($cpa as $key) {
									$cgpa = $key->gpa;
									$t_cgpa += $cgpa;
								}
								$tot = round($t_cgpa/count($cpa), 2);
								$upd_data['cgpa'] = $tot;
							}	
							$u_reco = $this->Crud->update3('semester', $semester, 'student_id', $student_id, 'level', $level, 'result_grade', $upd_data);
							if ($u_reco > 0) {
								$cpa = $this->Crud->read_single('student_id', $student_id, 'result_grade');
								$t_cgpa = 0;
								foreach ($cpa as $key) {
									$cgpa = $key->gpa;
									$t_cgpa += $cgpa;
								}
								$tot = round($t_cgpa/count($cpa), 2);
								$upd_dat['cgpa'] = $tot;
								$this->Crud->update3('semester', $semester, 'student_id', $student_id, 'level', $level, 'result_grade', $upd_dat);
							
							}
							
						} else {
							////////////////////////////////////////////Grade Point///////////////////////
								if($total >= 75){
					              $gp = 4.00;
					              $lg = 'AA';
					            } elseif ($total >=70 && $total <= 74) {
					              $gp = 3.50;
					              $lg = 'A';
					            } elseif ($total >=65 && $total <= 69) {
					              $gp = 3.25;
					              $lg = 'AB';
					            } elseif ($total >=60 && $total <= 64) {
					              $gp = 3.00;
					              $lg = 'B';
					            } elseif ($total >=55 && $total <= 59) {
					              $gp = 2.75;
					              $lg = 'BC';
					            } elseif ($total >=50 && $total <= 54) {
					              $gp = 2.50;
					              $lg = 'C';
					            } elseif ($total >=45 && $total <= 49) {
					              $gp = 2.25;
					              $lg = 'CD';
					            } elseif ($total >=40 && $total <= 44) {
					              $gp = 2.00;
					              $lg = 'D';
					            } elseif ($total >=35 && $total <= 39) {
					              $gp = 1.75;
					              $lg = 'DD';
					            } elseif ($total >=30 && $total <= 34) {
					              $gp = 1.50;
					              $lg = 'DE';
					            } elseif ($total >=25 && $total <= 29) {
					              $gp = 1.25;
					              $lg = 'E';
					            } elseif ($total >=20 && $total <= 24) {
					              $gp = 1.00;
					              $lg = 'EE';
					            } elseif ($total >=0 && $total <= 19) {
					              $gp = 0.00;
					              $lg = 'F';
					            } else {
					              $gp = 0.00;
					              $lg = 'F';
					            }
				            /////////////////////////////////////////////////////
								
							$code = $this->Crud->read_field('code', $course_code, 'course', 'unit');
							$sc = $gp * $code;

							$wg = round($sc/$t_unit, 2);

							$in_data['student_id'] = $student_id;
							$in_data['semester'] = $semester;
							$in_data['level'] = $level;
							$in_data['gpa'] = $wg;

							if (($semester == 'First' and $level =='ND1') or ($semester == 'First' and $level =='HND1')) {
								$in_data['cgpa'] = $wg;
							} else {
								$cpa = $this->Crud->read_single('student_id', $student_id, 'result_grade');
								$t_cgpa = 0;
								foreach ($cpa as $key) {
									$cgpa = $key->gpa;
									$t_cgpa += $cgpa;
								}
								$tot = round($t_cgpa/count($cpa), 2);
								$in_data['cgpa'] = $tot;
							}

							$in_data['session'] = $session;
							
							$in_rec = $this->Crud->create('result_grade', $in_data);
							if ($in_rec > 0) {
								$cpa = $this->Crud->read_single('student_id', $student_id, 'result_grade');
								$t_cgpa = 0;
								foreach ($cpa as $key) {
									$cgpa = $key->gpa;
									$t_cgpa += $cgpa;
								}
								$tot = round($t_cgpa/count($cpa), 2);
								$i_data['cgpa'] = $tot;
								$this-$this->Crud->update3('semester', $semester, 'student_id', $student_id, 'level', $level, 'result_grade', $i_data);
							}
						}
						echo $this->Crud->msg('success', 'Record Created');
					} else {
						echo $this->Crud->msg('danger', 'Please Try Again later');	
					}	
					
				}
			}
			
		}
	}

	public function approve(){
		$role = $this->Crud->read_field('id', $this->session->userdata('tr_user_id'), 'user', 'user_role');
		if(empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} elseif ($role != 'Superadmin') {
			redirect(base_url('dashboard'), 'refresh');
		}
		$user_id = $this->session->userdata('truser_id');
				
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;
		
		$data['title'] = 'Approve Result | '.app_name;
		$data['page_active'] = 'result_approve';
		$this->load->view('designs/header', $data);
		$this->load->view('result/approve', $data);
		$this->load->view('designs/footer', $data);
	}

	public function approved(){
		if($_POST) {
			$programme_type = $this->input->post('programme_type');
			$level = $this->input->post('level');
			$semester = $this->input->post('semester');
			$session = $this->input->post('session');
			$course_code = $this->input->post('course_code');

			$data['programme_type'] = $programme_type;
			$data['semester'] = $semester;
			$data['session'] = str_replace('_', '/', $session);
			$data['course'] = $course_code;
			$data['level'] = $level;

		}

		$this->load->view('result/result_approve', $data);


	}
	
	public function app_result($param=''){
		$param = str_replace('_', ' ', $param);
		
		if($_POST) {

			$course = str_replace('_', ' ', $this->input->post('course'));
			$session = str_replace('_', '/', $this->Crud->read_field('current', '1', 'session', 'session'));
			
			//echo $course;
			$upd_data['approve_status'] = 1;
			$upd_data['approved_by'] = $this->Crud->read_field('id', $this->session->userdata('tr_user_id'), 'user', 'staff_id');
			
			if ($this->Crud->check3('approve_status', '1', 'course_code', $course, 'session', $session, 'result') > 0) {
				echo $this->Crud->msg('warning', 'This Result has Already been Approved!');	
			} else {
				$upd_rec = $this->Crud->update2('course_code', $course, 'session', $session, 'result', $upd_data);
				if($upd_rec > 0) {
					
					echo $this->Crud->msg('success', 'Result Approved');
					echo '<script>window.location.replace("'.base_url('result_approve').'");</script>';
				} else {
					echo $this->Crud->msg('info', 'No Changes');	
				}
			}
			die;
		}

		$data['course'] = $param;
		$this->load->view('result/app_form', $data);
	}

	
}
