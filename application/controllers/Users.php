<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

	public function index() {
		if($_POST) {
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$confirm = $this->input->post('confirm');

			$Error = '';
			if($this->Crud->check('username', $username, 'user') > 0) {$Error = 'Username Taken <br/>';}
			if($this->Crud->check('email', $email, 'user') > 0) {$Error .= 'Email Taken <br/>';}
			if($password != $confirm) {$Error .= 'Password Not Match';}

			if($Error) {
				echo $this->Crud->msg('danger', $Error);
				die;
			}

			
			$ins_data['username'] = $username;
			$ins_data['email'] = $email;
			$ins_data['role'] = 'Doctor';
			$ins_data['password'] = md5($password);
			$ins_data['reg_date'] = date(fdate);

			$ins_id = $this->Crud->create('user', $ins_data);
			if($ins_id > 0) {
				echo $this->Crud->msg('success', 'Record Created<br>');
				echo '<script>location.reload(false);</script>';
			} else {
				echo $this->Crud->msg('danger', 'Please Try Again Later');
			}

			die;
		}

		$data['title'] = 'Sign Up | '.app_name;
		$this->load->view('register', $data);
	}

	public function staff($param1='', $param2='', $param3='') {
		$role = $this->Crud->read_field('id', $this->session->userdata('tr_user_id'), 'user', 'user_role');
		if(empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} elseif ($role != 'Superadmin') {
			redirect(base_url('dashboard'), 'refresh');
		}
		$user_id = $this->session->userdata('tr_user_id');
		
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;

		$table = 'user';
			
			// pass parameters to view
			$data['param1'] = $param1;
			$data['param2'] = $param2;
			$data['param3'] = $param3;
			$form_url = 'users/staff/'.$param1;
			if($param2){$form_url .= '/'.$param2;}
			if($param3){$form_url .= '/'.$param3;}
			$data['form_url'] = $form_url;
			
			// manage record
			if($param1 == 'manage') {
				// prepare for delete
				if($param2 == 'delete') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['d_id'] = $e->id;
							}
						}
						
						if($_POST){
							$del_id = $this->input->post('d_id');
							if($this->Crud->delete('id', $del_id, $table) > 0) {
								echo $this->Crud->msg('success', 'Record Deleted');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please try later');
							}
							exit;	
						}
					}
				} else {
					// prepare for edit
					if($param2 == 'edit') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_name'] = $e->name;
									$data['e_staff_id'] = $e->staff_id;
									$data['e_user_role'] = $e->user_role;
									$data['e_active_stat'] = $e->active_stat;
								}
							}
						}
					}

					
					if($_POST){
						$id = $this->input->post('id');
						$staff_id = $this->input->post('staff_id');
						$name = $this->input->post('name');
						$password = $this->input->post('password');
						$active_stat = $this->input->post('active_stat');
						$role = $this->input->post('role');
						
						// do create or update
						if($id) {
							$upd_data['user_role'] = $role;
							$upd_data['name'] = $name;
							$upd_data['active_stat'] = $active_stat;
							
							$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
							if($upd_rec > 0) {
								echo $this->Crud->msg('success', 'Record Updated');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('info', 'No Changes');	
							}
						} else {
							if($this->Crud->check('staff_id', $staff_id, 'user') > 0) {
								echo $this->Crud->msg('warning', 'Record Already Exist');
							} else {
								$ins_data['name'] = $name;
								$ins_data['user_role'] = $role;
								$ins_data['password'] = $password;
								$ins_data['staff_id'] = $staff_id;
								
								$ins_rec = $this->Crud->create($table, $ins_data);
								if($ins_rec > 0) {
									echo $this->Crud->msg('success', 'Record Created');
									echo '<script>location.reload(false);</script>';
								} else {
									echo $this->Crud->msg('danger', 'Please Try Again later');	
								}	
							}
						}
						die;	
					}
				}
			}

			
			// record listing
			if($param1 == 'list') {
				// DataTable parameters
				$table = 'user';
				$column_order = array('id', 'name', 'staff_id', 'user_role', 'last_log');
				$column_search = array('id', 'name', 'staff_id', 'user_role', 'last_log');
				$order = array('id' => 'desc');
				$where = '';
				
				// load data into table
				$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
				$data = array();
				// $no = $_POST['start'];
				$count = 1;
				foreach ($list as $item) {
					$id = $item->id;
					$staff_id = $item->staff_id;
					$name = $item->name;
					$role = $item->user_role;
					$active_status = $item->active_stat;
					$last_log = $item->last_log;


					if ($active_status == 0) {
						$active = '<span class="text-danger">Account Deactivated</span>';
					} else {
						$active = '<span class="text-success">Account Activated</span>';
					}
					
					
					// add scripts to last record
					if($count == count($list)){
						$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
					} else {$script = '';}
					
					// edit 
					$edit_btn = '
						<a class="text-primary pop" href="javascript:;" pageTitle="Manage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record" pageName="'.base_url('users/staff/manage/edit/'.$id).'" pageSize="modal-sm">
							<i class="fas fa-pencil-alt fa-1x"></i>
						</a>
					';

					
					// delete 
					$del_btn = '
						<a class="text-danger pop" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Record" pageTitle="Delete" pageName="'.base_url('users/staff/manage/delete/'.$id).'" pageSize="modal-sm">
							<i class="fas fa-trash fa-1x"></i>
						</a>
					';
					// add manage buttons
					$all_btn = '
						<div class="text-center">
							'.$del_btn.'&nbsp;
							'.$edit_btn.'&nbsp;
						</div>
						'.$script.'
					';
					
					
					$row = array();
					$row[] = ucwords($staff_id);
					$row[] = strtoupper($name);
					$row[] = $role;
					$row[] = date('d-m-Y', strtotime($last_log));
					$row[] = $active;
					$row[] = $all_btn;
		
					$data[] = $row;
					$count += 1;
				}
		
				$output = array(
					"draw" => intval($_POST['draw']),
					"recordsTotal" => $this->Crud->datatable_count($table, $where),
					"recordsFiltered" => $this->Crud->datatable_filtered($table, $column_order, $column_search, $order, $where),
					"data" => $data,
				);
				
				//output to json format
				echo json_encode($output);
				die;
			}

			if($param1 == 'manage') {
				$this->load->view('users/staff_form', $data);
			} else {
				// for datatable
				$data['table_rec'] = 'users/staff/list'; // ajax table url
				$data['order_sort'] = '0, "asc"'; // default ordering (0, 'asc')
				$data['no_sort'] = '0'; // sort disable columns (1,3,5)
				
				$data['title'] = 'Manage Staff | '.app_name;
				$data['page_active'] = 'staff';
				$this->load->view('designs/header', $data);
				$this->load->view('users/staff', $data);
				$this->load->view('designs/footer', $data);
			}
		
	}

	public function course($param1='', $param2='', $param3='') {
		$role = $this->Crud->read_field('id', $this->session->userdata('tr_user_id'), 'user', 'user_role');
		if(empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} elseif ($role != 'Superadmin') {
			redirect(base_url('dashboard'), 'refresh');
		}
		$user_id = $this->session->userdata('tr_user_id');
		
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;

		$table = 'course';
			
			// pass parameters to view
			$data['param1'] = $param1;
			$data['param2'] = $param2;
			$data['param3'] = $param3;
			$form_url = 'users/course/'.$param1;
			if($param2){$form_url .= '/'.$param2;}
			if($param3){$form_url .= '/'.$param3;}
			$data['form_url'] = $form_url;
			
			// manage record
			if($param1 == 'manage') {
				// prepare for delete
				if($param2 == 'delete') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['d_id'] = $e->id;
							}
						}
						
						if($_POST){
							$del_id = $this->input->post('d_id');
							if($this->Crud->delete('id', $del_id, $table) > 0) {
								echo $this->Crud->msg('success', 'Record Deleted');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please try later');
							}
							exit;	
						}
					}
				} else {
					// prepare for edit
					if($param2 == 'edit') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_name'] = $e->name;
									$data['e_code'] = $e->code;
									$data['e_unit'] = $e->unit;
								}
							}
						}
					}

					
					if($_POST){
						$id = $this->input->post('id');
						$code = $this->input->post('code');
						$name = $this->input->post('name');
						$unit = $this->input->post('unit');
						
						// do create or update
						if($id) {
							$upd_data['code'] = $code;
							$upd_data['name'] = $name;
							$upd_data['unit'] = $unit;
							
							$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
							if($upd_rec > 0) {
								echo $this->Crud->msg('success', 'Record Updated');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('info', 'No Changes');	
							}
						} else {
							if($this->Crud->check2('code', $code, 'name', $name, 'course') > 0) {
								echo $this->Crud->msg('warning', 'Record Already Exist');
							} else {
								$ins_data['name'] = $name;
								$ins_data['code'] = $code;
								$ins_data['unit'] = $unit;
								
								$ins_rec = $this->Crud->create($table, $ins_data);
								if($ins_rec > 0) {
									echo $this->Crud->msg('success', 'Record Created');
									echo '<script>location.reload(false);</script>';
								} else {
									echo $this->Crud->msg('danger', 'Please Try Again later');	
								}	
							}
						}
						die;	
					}
				}
			}

			
			// record listing
			if($param1 == 'list') {
				// DataTable parameters
				$table = 'course';
				$column_order = array('id', 'name', 'code', 'unit');
				$column_search = array('id', 'name', 'code', 'unit');
				$order = array('id' => 'desc');
				$where = '';
				
				// load data into table
				$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
				$data = array();
				// $no = $_POST['start'];
				$count = 1;
				foreach ($list as $item) {
					$id = $item->id;
					$name = $item->name;
					$code = $item->code;
					$unit = $item->unit;

					
					// add scripts to last record
					if($count == count($list)){
						$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
					} else {$script = '';}
					
					// edit 
					$edit_btn = '
						<a class="text-primary pop" href="javascript:;" pageTitle="Manage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record" pageName="'.base_url('users/course/manage/edit/'.$id).'" pageSize="modal-sm">
							<i class="fas fa-pencil-alt fa-1x"></i>
						</a>
					';

					
					// delete 
					$del_btn = '
						<a class="text-danger pop" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Record" pageTitle="Delete" pageName="'.base_url('users/course/manage/delete/'.$id).'" pageSize="modal-sm">
							<i class="fas fa-trash fa-1x"></i>
						</a>
					';
					// add manage buttons
					$all_btn = '
						<div class="text-center">
							'.$del_btn.'&nbsp;
							'.$edit_btn.'&nbsp;
						</div>
						'.$script.'
					';
					
					
					$row = array();
					$row[] = strtoupper($code);
					$row[] = strtoupper($name);
					$row[] = $unit;
					$row[] = $all_btn;
		
					$data[] = $row;
					$count += 1;
				}
		
				$output = array(
					"draw" => intval($_POST['draw']),
					"recordsTotal" => $this->Crud->datatable_count($table, $where),
					"recordsFiltered" => $this->Crud->datatable_filtered($table, $column_order, $column_search, $order, $where),
					"data" => $data,
				);
				
				//output to json format
				echo json_encode($output);
				die;
			}

			if($param1 == 'manage') {
				$this->load->view('users/course_form', $data);
			} else {
				// for datatable
				$data['table_rec'] = 'users/course/list'; // ajax table url
				$data['order_sort'] = '0, "asc"'; // default ordering (0, 'asc')
				$data['no_sort'] = '0'; // sort disable columns (1,3,5)
				
				$data['title'] = 'Manage Courses | '.app_name;
				$data['page_active'] = 'course';
				$this->load->view('designs/header', $data);
				$this->load->view('users/course', $data);
				$this->load->view('designs/footer', $data);
			}
		
	}

	public function cos($param=''){
		if (empty($param)) {
			
		} else {
			$name = $this->Crud->read_field('code', str_replace('_', ' ', $param), 'course', 'name');
			echo '
				<label for="username">Course Name</label>
                <input type="text" name="qw" id="qw" readonly class="form-control" value="'.strtoupper($name).'">
			';
		}
	}

	public function view_result($param1='',$param2='',$param3=''){
		if (empty($param1) or empty($param2) or empty($param3)) {
			echo $this->Crud->msg('warning', 'Please Select All Fields');
		} else {
			if (empty($this->Crud->read3('programme_type', $param1, 'semester', $param2, 'level', $param3, 'course_allocate'))) {
				echo $this->Crud->msg('danger', 'No Course Available!!');
			} else {
				echo '
					<div class="row">
					    <div class="col-12 mt-3">
					        <div class="card">
					            <div class="card-header  justify-content-between align-items-center">                               
					                <h4 class="card-title">'.ucwords($param3).' '.ucwords($param1).' Time '.ucwords($param2).' Semester Courses</h4>   
					            </div>
					            <div class="card-body">
					                <div class="table-responsive">
					                    <table id="dtable" class="display table dataTable table-striped table-bordered" >
					                        <thead>
					                            <tr>
					                                <th>Course Code</th>
					                                <th>Course Name</th>
					                                <th>Course Unit</th>
					                            </tr>
					                        </thead>
					                       <tbody>';
					                       $res = $this->Crud->read_order3('programme_type', $param1, 'semester', $param2, 'level', $param3, 'course_allocate', 'course_code', 'asc');
					                       foreach ($res as $key) {
					                       	echo '<tr><td>'.strtoupper($key->course_code).'</td>';
					                       	echo '<td>'.strtoupper($this->Crud->read_field('code', $key->course_code, 'course', 'name')).'</td>';
					                       		echo '<td>'.strtoupper($this->Crud->read_field('code', $key->course_code, 'course', 'unit')).'</td></tr>';
					                       }
					                       echo '</tbody>
					                        
					                    </table>
					                </div>
					            </div>
					        </div> 

					    </div>                  
					</div>
				';
			}
		}
	}


	public function course_allocate($param1='', $param2='', $param3='') {
		$role = $this->Crud->read_field('id', $this->session->userdata('tr_user_id'), 'user', 'user_role');
		if(empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} elseif ($role != 'Superadmin') {
			redirect(base_url('dashboard'), 'refresh');
		}
		$user_id = $this->session->userdata('tr_user_id');
		
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;

		$table = 'course_allocate';
			
			// pass parameters to view
			$data['param1'] = $param1;
			$data['param2'] = $param2;
			$data['param3'] = $param3;
			$form_url = 'users/course_allocate/'.$param1;
			if($param2){$form_url .= '/'.$param2;}
			if($param3){$form_url .= '/'.$param3;}
			$data['form_url'] = $form_url;
			
			// manage record
			if($param1 == 'manage') {
				// prepare for delete
				if($param2 == 'delete') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['d_id'] = $e->id;
							}
						}
						
						if($_POST){
							$del_id = $this->input->post('d_id');
							if($this->Crud->delete('id', $del_id, $table) > 0) {
								echo $this->Crud->msg('success', 'Record Deleted');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please try later');
							}
							exit;	
						}
					}
				} else {
					// prepare for edit
					if($param2 == 'edit') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_semester'] = $e->semester;
									$data['e_course_code'] = $e->course_code;
									$data['e_level'] = $e->level;
									$data['e_programme_type'] = $e->programme_type;
								}
							}
						}
					}

					
					if($_POST){
						$id = $this->input->post('id');
						$code = $this->input->post('code');
						$semester = $this->input->post('semester');
						$level = $this->input->post('level');
						$programme_type = $this->input->post('programme_type');
						
						// do create or update
						if($id) {
							$upd_data['course_code'] = $code;
							$upd_data['semester'] = $semester;
							$upd_data['level'] = $level;
							$upd_data['programme_type'] = $programme_type;
							
							$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
							if($upd_rec > 0) {
								echo $this->Crud->msg('success', 'Record Updated');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('info', 'No Changes');	
							}
						} else {
							if($this->Crud->check2('programme_type', $programme_type, 'course_code', $code, 'course_allocate') > 0) {
								echo $this->Crud->msg('warning', 'Record Already Exist');
							} else {
								$ins_data['semester'] = $semester;
								$ins_data['course_code'] = $code;
								$ins_data['level'] = $level;
								$ins_data['programme_type'] = $programme_type;
								
								$ins_rec = $this->Crud->create($table, $ins_data);
								if($ins_rec > 0) {
									echo $this->Crud->msg('success', 'Record Created');
									echo '<script>location.reload(false);</script>';
								} else {
									echo $this->Crud->msg('danger', 'Please Try Again later');	
								}	
							}
						}
						die;	
					}
				}
			}

			
			// record listing
			if($param1 == 'list') {
				// DataTable parameters
				$table = 'course_allocate';
				$column_order = array('id', 'level', 'code', 'programme_type');
				$column_search = array('id', 'level', 'code', 'programme_type');
				$order = array('id' => 'desc');
				$where = '';
				
				// load data into table
				$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
				$data = array();
				// $no = $_POST['start'];
				$count = 1;
				foreach ($list as $item) {
					$id = $item->id;
					$level = $item->level;
					$course_code = $item->course_code;
					$semester = $item->semester;
					$programme_type = $item->programme_type;

					
					// add scripts to last record
					if($count == count($list)){
						$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
					} else {$script = '';}
					
					// edit 
					$edit_btn = '
						<a class="text-primary pop" href="javascript:;" pageTitle="Manage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record" pageName="'.base_url('users/course_allocate/manage/edit/'.$id).'" pageSize="modal-sm">
							<i class="fas fa-pencil-alt fa-1x"></i>
						</a>
					';

					
					// delete 
					$del_btn = '
						<a class="text-danger pop" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Record" pageTitle="Delete" pageName="'.base_url('users/course_allocate/manage/delete/'.$id).'" pageSize="modal-md">
							<i class="fas fa-trash fa-1x"></i>
						</a>
					';
					// add manage buttons
					$all_btn = '
						<div class="text-center">
							'.$del_btn.'&nbsp;
							'.$edit_btn.'&nbsp;
						</div>
						'.$script.'
					';
					
					
					$row = array();
					$row[] = strtoupper($course_code);
					$row[] = strtoupper($level);
					$row[] = $semester;
					$row[] = $programme_type;
					$row[] = $all_btn;
		
					$data[] = $row;
					$count += 1;
				}
		
				$output = array(
					"draw" => intval($_POST['draw']),
					"recordsTotal" => $this->Crud->datatable_count($table, $where),
					"recordsFiltered" => $this->Crud->datatable_filtered($table, $column_order, $column_search, $order, $where),
					"data" => $data,
				);
				
				//output to json format
				echo json_encode($output);
				die;
			}

			if($param1 == 'manage') {
				$this->load->view('users/course_allocate_form', $data);
			} else {
				// for datatable
				$data['table_rec'] = 'users/course_allocate/list'; // ajax table url
				$data['order_sort'] = '0, "asc"'; // default ordering (0, 'asc')
				$data['no_sort'] = '0'; // sort disable columns (1,3,5)
				
				$data['title'] = 'Courses Allocation | '.app_name;
				$data['page_active'] = 'course_allocate';
				$this->load->view('designs/header', $data);
				$this->load->view('users/course_allocate', $data);
				$this->load->view('designs/footer', $data);
			}
		
	}

	public function student($param1='', $param2='', $param3='') {
		$role = $this->Crud->read_field('id', $this->session->userdata('tr_user_id'), 'user', 'user_role');
		if(empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} elseif ($role != 'Superadmin') {
			redirect(base_url('dashboard'), 'refresh');
		}
		$user_id = $this->session->userdata('tr_user_id');
		
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;

		$table = 'student';
			
			// pass parameters to view
			$data['param1'] = $param1;
			$data['param2'] = $param2;
			$data['param3'] = $param3;
			$form_url = 'users/student/'.$param1;
			if($param2){$form_url .= '/'.$param2;}
			if($param3){$form_url .= '/'.$param3;}
			$data['form_url'] = $form_url;
			
			// manage record
			if($param1 == 'manage') {
				// prepare for delete
				if($param2 == 'delete') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['d_id'] = $e->id;
							}
						}
						
						if($_POST){
							$del_id = $this->input->post('d_id');
							if($this->Crud->delete('id', $del_id, $table) > 0) {
								echo $this->Crud->msg('success', 'Record Deleted');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please try later');
							}
							exit;	
						}
					}
				} else {
					// prepare for edit
					if($param2 == 'edit') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_student_id'] = $e->student_id;
									$data['e_surname'] = $e->surname;
									$data['e_firstname'] = $e->firstname;
									$data['e_gender'] = $e->gender;
									$data['e_address'] = $e->address;
									$data['e_level'] = $e->level;
									$data['e_programme_type'] = $e->programme_type;
									$data['e_img_id'] = $e->img_id;
								}
							}
						}
					}

					// prepare for edit
					if($param2 == 'view') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_student_id'] = $e->student_id;
									$data['e_surname'] = $e->surname;
									$data['e_firstname'] = $e->firstname;
									$data['e_gender'] = $e->gender;
									$data['e_address'] = $e->address;
									$data['e_level'] = $e->level;
									$data['e_reg_date'] = $e->reg_date;
									$data['e_programme_type'] = $e->programme_type;
									$data['e_admission_session'] = $e->admission_session;
									$data['e_img_id'] = $e->img_id;
								}
							}
						}
					}
					
					if($_POST){
						$id = $this->input->post('id');
						$student_id = $this->input->post('student_id');
						$surname = $this->input->post('surname');
						$firstname = $this->input->post('firstname');
						$gender = $this->input->post('gender');
						$address = $this->input->post('address');
						$level = $this->input->post('level');
						$programme_type = $this->input->post('programme_type');
						

						//check image upload
						if($_FILES['pics']['name']){
							$stamp = time();
							
							$path = 'assets/img/users';
							
							if (!is_dir($path))
								mkdir($path, 0755);
				
							$pathMain = './assets/img/users';
							if (!is_dir($pathMain))
								mkdir($pathMain, 0755);
				
							$result = $this->Crud->do_upload("pics", $pathMain);
				
							if (!$result['status']){
								echo $this->Crud->msg('danger', 'Can not upload picture, try another');
							} else {
								$save_path = $path . '/' . $result['upload_data']['file_name'];
								$img_id = $save_path;
								echo $this->Crud->msg('success', 'Picture Changed');
								
							}
						}
						/// end profile picture upload



						// do create or update
						if($id) {
							$upd_data['surname'] = $surname;
							$upd_data['firstname'] = $firstname;
							$upd_data['gender'] = $gender;
							$upd_data['address'] = $address;
							
							$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
							if($upd_rec > 0) {
								echo $this->Crud->msg('success', 'Record Updated');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('info', 'No Changes');	
							}
						} else {
							if($this->Crud->check('student_id', $student_id, 'student') > 0) {
								echo $this->Crud->msg('warning', 'Student ID Already Exist');
							} else {
								$ins_data['student_id'] = $student_id;
								$ins_data['surname'] = $surname;
								$ins_data['firstname'] = $firstname;
								$ins_data['gender'] = $gender;
								$ins_data['address'] = $address;
								$ins_data['level'] = $level;
								$ins_data['programme_type'] = $programme_type;
								$ins_data['img_id'] = $img_id;
								$ins_data['reg_date'] = date(fdate);
								$ins_data['admission_session'] = $this->Crud->read_field('current', '1', 'session', 'session');
								
								$ins_rec = $this->Crud->create($table, $ins_data);
								if($ins_rec > 0) {
									echo $this->Crud->msg('success', 'Record Created');
									echo '<script>location.reload(false);</script>';
								} else {
									echo $this->Crud->msg('danger', 'Please Try Again later');	
								}	
							}
						}
						die;	
					}
				}
			}

			
			// record listing
			if($param1 == 'list') {
				// DataTable parameters
				$table = 'student';
				$column_order = array('id', 'surname','firstname', 'student_id', 'level', 'gender', 'address', 'session');
				$column_search = array('id', 'surname','firstname', 'student_id', 'level', 'gender', 'address', 'session');
				$order = array('student_id' => 'desc');
				$where = '';
				
				// load data into table
				$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
				$data = array();
				// $no = $_POST['start'];
				$count = 1;
				foreach ($list as $item) {
					$id = $item->id;
					$student_id = $item->student_id;
					$surname = $item->surname;
					$firstname = $item->firstname;
					$level = $item->level;
					$gender = $item->gender;
					$img_id = $item->img_id;

					if (empty($img_id)) {
						$image = '<img src="'.base_url().'assets/avatar.png" alt="" class=" user-image" width="100px" height="100px">';
					} else { 
						$image = '<img src="'.base_url($img_id).'" alt="" class="user-image " width="100px" height="100px">';
					}
					
					
					// add scripts to last record
					if($count == count($list)){
						$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
					} else {$script = '';}
					
					// edit 
					$edit_btn = '
						<a class="text-primary pop" href="javascript:;" pageTitle="Manage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record" pageName="'.base_url('users/student/manage/edit/'.$id).'">
							<i class="fas fa-pencil-alt fa-1x"></i>
						</a>
					';

					
					// edit 
					$view_btn = '
						<a class="text-success pop" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Record" pageTitle="View" pageSize="modal-lg" pageName="'.base_url('users/student/manage/view/'.$id).'">
							<i class="ti-eye fa-1x"></i>
						</a>
					';
					
					// delete 
					$del_btn = '
						<a class="text-danger pop" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Record" pageTitle="Delete" pageName="'.base_url('users/student/manage/delete/'.$id).'" pageSize="modal-sm">
							<i class="fas fa-trash fa-1x"></i>
						</a>
					';
					// add manage buttons
					$all_btn = '
						<div class="text-center">
							'.$del_btn.'&nbsp;
							'.$edit_btn.'&nbsp;
							'.$view_btn.'&nbsp;
						</div>
						'.$script.'
					';
					
					
					$row = array();
					$row[] = $image;
					$row[] = ucwords($student_id);
					$row[] = strtoupper($surname.' '.$firstname);
					$row[] = $gender;
					$row[] = $level;
					$row[] = $all_btn;
		
					$data[] = $row;
					$count += 1;
				}
		
				$output = array(
					"draw" => intval($_POST['draw']),
					"recordsTotal" => $this->Crud->datatable_count($table, $where),
					"recordsFiltered" => $this->Crud->datatable_filtered($table, $column_order, $column_search, $order, $where),
					"data" => $data,
				);
				
				//output to json format
				echo json_encode($output);
				die;
			}

			if($param1 == 'manage') {
				$this->load->view('users/student_form', $data);
			} else {
				// for datatable
				$data['table_rec'] = 'users/student/list'; // ajax table url
				$data['order_sort'] = '1, "asc"'; // default ordering (0, 'asc')
				$data['no_sort'] = '0'; // sort disable columns (1,3,5)
				
				$data['title'] = 'Manage Students | '.app_name;
				$data['page_active'] = 'student';
				$this->load->view('designs/header', $data);
				$this->load->view('users/student', $data);
				$this->load->view('designs/footer', $data);
			}
		
	}

	/////////////////// Session Manage Script Start//////////////////////////////
	public function session($param1='', $param2='', $param3='') {
		$role = $this->Crud->read_field('id', $this->session->userdata('tr_user_id'), 'user', 'user_role');
		if(empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} elseif ($role != 'Superadmin') {
			redirect(base_url('dashboard'), 'refresh');
		}
		
		//$role = $this->Crud->read_field2('id', $log_user_id, 'active', '1', 'user', 'role');
		//if ($role == 'Admin') {
			$table = 'session';
			
			// pass parameters to view
			$data['param1'] = $param1;
			$data['param2'] = $param2;
			$data['param3'] = $param3;
			$form_url = 'users/session/'.$param1;
			if($param2){$form_url .= '/'.$param2;}
			if($param3){$form_url .= '/'.$param3;}
			$data['form_url'] = $form_url;
			
			// manage record
			if($param1 == 'manage') {
				// prepare for delete
				if($param2 == 'delete') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['d_id'] = $e->id;
							}
						}
						
						if($_POST){
							$del_id = $this->input->post('d_id');
							if($this->Crud->delete('id', $del_id, $table) > 0) {
								echo $this->Crud->msg('success', 'Record Deleted' );
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please Try Later');
							}
							exit;	
						}
					}
				} elseif ($param2 == 'current') {
					if($_POST){
						$session = $this->input->post('sesson');
						$current = $this->input->post('current');
						
						//echo $session;
						// do create or update
						if($current) {
							$upd_data['current'] = $current;
							
							if (!empty($this->Crud->read_field('current', '1', 'session', 'session'))) {
								$se = $this->Crud->read_field('current', '1', 'session', 'session');
								$up_data['current'] = 0;
								$this->Crud->update('session', $se, $table, $up_data);
								$upd_rec = $this->Crud->update('session', $session, $table, $upd_data);
								if($upd_rec > 0) {
									echo $this->Crud->msg('success', 'Current Session Changed' );
									echo '<script>location.reload(false);</script>';
								} else {
									echo $this->Crud->msg('info','No Changes' );	
								}
							} else {
								$upd_rec = $this->Crud->update('session', $session, $table, $upd_data);
								if($upd_rec > 0) {
									echo $this->Crud->msg('success', 'Current Session Changed' );
									echo '<script>location.reload(false);</script>';
								} else {
									echo $this->Crud->msg('info','No Changes' );	
								}
							}

						} 
						die;	
					}
				
				} else {
					// prepare for edit
					if($param2 == 'edit') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_session'] = $e->session;
									$data['e_current'] = $e->current;
									

								}
							}
						}
					}

					
					
					if($_POST){
						$id = $this->input->post('id');
						$session = $this->input->post('session');
						
						// do create or update
						if($id) {
							$upd_data['session'] = str_replace('/', '_', $session);
								
							$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
							if($upd_rec > 0) {
								echo $this->Crud->msg('success', 'Record Updated' );
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('info','No Changes' );	
							}

						} else {
							if($this->Crud->check('session', str_replace('/', '_', $session), $table) > 0) {
								echo $this->Crud->msg('warning', 'Record Already Exist' );
							} else {
								$ins_data['session'] = str_replace('/', '_', $session);
								
								$ins_rec = $this->Crud->create($table, $ins_data);
								if($ins_rec > 0) {
									echo $this->Crud->msg('success', 'Record Created');
									echo '<script>location.reload(false);</script>';
								} else {
									echo $this->Crud->msg('danger', 'Please Try Later');	
								}	
							}
						}
						die;	
					}
				}
			}

			// record listing
			if($param1 == 'list') {
				// DataTable parameters
				$table = 'session';
				$column_order = array('session', 'current');
				$column_search = array('session', 'current');
				$order = array('id' => 'desc');
				$where = '';
				
				// load data into table
				$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
				$data = array();
				// $no = $_POST['start'];
				$count = 1;
				foreach ($list as $item) {
					$id = $item->id;
					$session = $item->session;
					$current = $item->current;
					
					if ($current == 0) {
						$cur = '<p class="text-primary mb-10" style="color:red">Not Current</p>';
					} else {
						$cur = '<p class="text-primary mb-10" style="color:green">Current</p>';
					}
					// add scripts to last record
					if($count == count($list)){
						$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
					} else {$script = '';}
					
					// edit 
					$edit_btn = '
						<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('users/session/manage/edit/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="EDIT">
							<i class="icon-pencil fa-1x"></i>
						</a>
					';
					
					// delete 
					$del_btn = '
						<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('users/session/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
							<i class="icon-trash fa-1x"></i>
						</a>
					';
					
					// add manage buttons
					$all_btn = '
						<div class="text-center">
							'.$edit_btn.'
						</div>
						'.$script.'
					';
					
					$row = array();
					$row[] = str_replace('_', '/', $session);		
					$row[] = strtoupper($cur);		
					
					$row[] = $all_btn;
		
					$data[] = $row;
					$count += 1;

				}
		
				$output = array(
					"draw" => intval($_POST['draw']),
					"recordsTotal" => $this->Crud->datatable_count($table, $where),
					"recordsFiltered" => $this->Crud->datatable_filtered($table, $column_order, $column_search, $order, $where),
					"data" => $data,
				);
				
				//output to json format
				echo json_encode($output);
				die;
			}

				
			if($param1 == 'manage') {
				$this->load->view('users/session_form', $data);
			} else {
				// for datatable
				$data['table_rec'] = 'users/session/list'; // ajax table url
				$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
				$data['no_sort'] = '2'; // sort disable columns (1,3,5)

				//$data['user'] = $account_name;
				$data['title'] = 'Manage Session | '.app_name;
				$data['page_active'] = 'session';
				$this->load->view('designs/header', $data);
				$this->load->view('users/session', $data);
				$this->load->view('designs/footer', $data);
			}

		//} else {
		//	echo 'No Access';
		//	echo '<script>window.location.replace("'.base_url('dashboard').'");</script>';
						
		//}
	}
	///////////////////////////End//////////////////////////////////////////////



	public function check_username($param = '') {
		if($param) {
			if($this->Crud->check('staff_id', $param, 'user') <= 0) {
				echo '<span class="text-success small">Staff ID Available</span>';
			} else {
				echo '<span class="text-danger small">Staff ID Already Exist</span>';
			}
			die;
		}
	}


	public function check_id($param = '') {
		if($param) {
			if($this->Crud->check('student_id', $param, 'student') <= 0) {
				echo '<span class="text-success small">Student ID Available</span>';
			} else {
				echo '<span class="text-danger small">Student ID Already Exist</span>';
			}
			die;
		}
	}

	public function check_email() {
		$email = $this->input->get('email');
		if($email) {
			if($this->Crud->check('email', $email, 'user') <= 0) {
				echo '<span class="text-success small">Email Available</span>';
			} else {
				echo '<span class="text-danger small">Email Taken</span>';
			}
			die;
		}
	}

	public function check_password($param1 = '', $param2 = '') {
		if($param1 && $param2) {
			if($param1 == $param2) {
				echo '<span class="text-success small">Password Matched</span>';
			} else {
				echo '<span class="text-danger small">Password Not Matched</span>';
			}
			die;
		}
	}

	public function login() {
		if(!empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('dashboard'), 'refresh');
		} elseif (!empty($this->session->userdata('tr_student_id'))) {
			redirect(base_url('stud_dash'), 'refresh');
		}

		$table = 'user';
		if($_POST) {
			$type = $this->input->post('type');
			$email = $this->input->post('staff_id');
			$password = $this->input->post('password');

			if(!$email || !$password || !$type) {
				echo $this->Crud->msg('danger', 'All Field Required');
			} else {
				if ($type == 'Student') {
					$user = $this->Crud->read2('student_id', $email, 'surname', $password, 'student');
					if(empty($user)) {
						echo $this->Crud->msg('danger', 'Authentication Failed');
					
					} else {
						
						$user_id = $this->Crud->read_field('student_id', $email, 'student', 'student_id');
						
						// save user_id in session
						echo $this->session->set_userdata('tr_student_id', $user_id);
						//echo $user_id;
						echo $this->Crud->msg('success', 'Login Successful');

						// redirect
						echo '<script>window.location.replace("'.base_url('stud_dash').'");</script>';
						
						}
				} else {
					$user = $this->Crud->read2('staff_id', $email, 'password', md5($password), $table);
					if(empty($user)) {
						echo $this->Crud->msg('danger', 'Authentication Failed');
					} elseif ($this->Crud->read2('staff_id', $email, 'active_stat', 0, $table)) {
						echo $this->Crud->msg('danger', 'This Account is Deactivated');	
					} else {
						
						$user_id = $this->Crud->read_field('staff_id', $email, $table, 'id');
						$up_data['last_log'] = date(fdate);
						
						$this->Crud->update('id', $user_id, $table, $up_data);

						// save user_id in session
						echo $this->session->set_userdata('tr_user_id', $user_id);
						//echo $user_id;
						echo $this->Crud->msg('success', 'Login Successful');

						// redirect
						echo '<script>window.location.replace("'.base_url('dashboard').'");</script>';
						
					}
				}
				
			}

			die;
		}

		$data['title'] = 'Sign In | '.app_name;
		$this->load->view('login', $data);
	}

	public function logout() {
		if(!empty($this->session->userdata('tr_user_id')) ) {
			$user_id = $this->session->userdata('tr_user_id');
			$this->session->set_userdata('tr_user_id', '');
			$this->session->sess_destroy();
			
		}
		
		$data['title'] = 'Sign Out | '.app_name;
		$this->load->view('login', $data);
	}

	public function stud_logout() {
		if(!empty($this->session->userdata('tr_student_id')) ) {
			$user_id = $this->session->userdata('tr_student_id');
			$this->session->set_userdata('tr_student_id', '');
			$this->session->sess_destroy();
			
		}
		
		$data['title'] = 'Sign Out | '.app_name;
		$this->load->view('login', $data);
	}

}
