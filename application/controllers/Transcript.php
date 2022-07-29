<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transcript extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

	public function request() {
		if(empty($this->session->userdata('tr_student_id'))) {
			redirect(base_url('login'), 'refresh');
		}
		$user_id = $this->session->userdata('truser_id');
				
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;
		
		$data['title'] = 'Transcript Request | '.app_name;
		$data['page_active'] = 'request';
		$this->load->view('designs/header', $data);
		$this->load->view('transcript/request', $data);
		$this->load->view('designs/footer', $data);
		
		
	}

	public function sent($param='', $param1=''){

		$student_id = $this->Crud->read_field('id', $param1, 'transcript', 'student_id');
		$student_name = $this->Crud->read_field('student_id', $student_id, 'student', 'surname');
		$receiver_email = $this->Crud->read_field('id', $param1, 'transcript', 'receiver_email');
		
		$to = $receiver_email;
		$from = 'tofunmi015@gmail.com';
		$name = 'OGITECH';
		$subject = 'Transcript';

		$body_msg = 'This is transcript for '.$student_name.' with Matric No '.$student_id;

		$this->email->from($from, $name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body_msg);

		if($this->Crud->send_mailer($from, $name, $to, $param, $subject, $body_msg)){
			echo '<script>alert("Email has been successfully Sent!!");window.location.replace("'.base_url('transcript').'");</script>';
			unlink($param);
		}

		
	}

	public function canvass($id=''){
		define('UPLOAD_DIR', base_url('assets/img'));  
		$img = $_POST['imgBase64'];  
		$img = str_replace('data:image/png;base64,', '', $img);  
		$img = str_replace(' ', '+', $img);  
		$data = base64_decode($img);  
		$file = 'assets/img/transcript/' . uniqid() . '.png';  
		
		$success = file_put_contents($file, $data);  
		
		$this->sent($file, $id);
	}


	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('login'), 'refresh');
		}
		$user_id = $this->session->userdata('tr_user_id');
		
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;

		$table = 'transcript';
			
			// pass parameters to view
			$data['param1'] = $param1;
			$data['param2'] = $param2;
			$data['param3'] = $param3;
			$form_url = 'transcript/index/'.$param1;
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
					if($param2 == 'approve') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_status'] = $e->request_status;
									
								}
							}
						}
					}

					if($param2 == 'view') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_student_id'] = $e->student_id;
									$data['e_status'] = $e->request_status;
									$data['e_request_type'] = $e->request_type;
									$data['e_request_date'] = $e->request_date;
									$data['e_request_approve'] = $e->request_approve;
									$data['e_receiver_email'] = $e->receiver_email;
									$data['e_date_approved'] = $e->date_approved;
									
								}
							}
						}
					}

					
					if($_POST){
						$id = $this->input->post('id');
						$status = $this->input->post('status');
						
						
						// do create or update
						if($id) {
							$upd_data['request_status'] = $status;
							$upd_data['date_approved'] = date(fdate);
							$upd_data['request_approve'] = $user_id;
							
							$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
							if($upd_rec > 0) {
								echo $this->Crud->msg('success', 'Request Updated');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('info', 'No Changes');	
							}
						}
						
						die;	
					}
				}
			}

			
			// record listing
			if($param1 == 'list') {
				// DataTable parameters
				$table = 'transcript';
				$column_order = array('id', 'student_id', 'request_type', 'request_date');
				$column_search = array('id', 'student_id', 'request_type', 'request_date');
				$order = array('request_date' => 'desc');
				$where = '';
				
				// load data into table
				$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
				$data = array();
				// $no = $_POST['start'];
				$count = 1;
				foreach ($list as $item) {
					$id = $item->id;
					$student_id = $item->student_id;
					$request_date = $item->request_date;
					$request_type = $item->request_type;
					$request_status = $item->request_status;
					


					if ($request_status == 0) {
						$request = '<span class="text-warning">Request Pending</span>';
					} elseif ($request_status == 2) {
						$request = '<span class="text-danger">Request Denied</span>';
					} else {
						$request = '<span class="text-success">Request Approved</span>';
					}
					
					
					// add scripts to last record
					if($count == count($list)){
						$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
					} else {$script = '';}
					
					// edit 
					$edit_btn = '
						<a class="text-primary pop" href="javascript:;" pageTitle="Approve Request" data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve Request" pageName="'.base_url('transcript/index/manage/approve/'.$id).'" pageSize="modal-md">
							<i class="ti-check-box fa-2x"></i>
						</a>
					';

					
					// delete 
					$del_btn = '
						<a class="text-success pop" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Request" pageTitle="View Request" pageName="'.base_url('transcript/index/manage/view/'.$id).'" pageSize="modal-md">
							<i class="ti-eye fa-2x"></i>
						</a>
					';

					
					// delete 
					$send_btn = '
						<a class="text-warning" href="'.base_url('transcript/send_transcript/send/'.$id).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send Transcript" pageTitle="View Request" pageName="" pageSize="modal-md">
							<i class="ti-location-arrow fa-2x"></i>
						</a>
					';

					// delete 
					$dow_btn = '
						<a class="text-info" href="'.base_url('transcript/send_transcript/download/'.$id).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Transcript" pageTitle="View Request" pageName="" pageSize="modal-md">
							<i class="ti-cloud-down fa-2x"></i>
						</a>
					';

					if ($request_status == 1 && $request_type == 'Official') {
						// add manage buttons
						$all_btn = '
							<div class="text-center">
								'.$del_btn.'&nbsp;
								'.$send_btn.'&nbsp;
							</div>
							'.$script.'
						';
					} elseif ($request_status == 1 && $request_type == 'Unofficial') {
						// add manage buttons
						$all_btn = '
							<div class="text-center">
								'.$del_btn.'&nbsp;
								'.$dow_btn.'&nbsp;
							</div>
							'.$script.'
						';
					} else {
						// add manage buttons
						$all_btn = '
							<div class="text-center">
								'.$del_btn.'&nbsp;
								'.$edit_btn.'&nbsp;
							</div>
							'.$script.'
						';
					
					}
					
					
					$row = array();
					$row[] = ucwords($student_id);
					$row[] = date('F d, Y', strtotime($request_date));
					$row[] = $request_type;
					$row[] = $request;
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
				$this->load->view('transcript/manage_form', $data);
			} else {
				// for datatable
				$data['table_rec'] = 'transcript/index/list'; // ajax table url
				$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
				$data['no_sort'] = '0'; // sort disable columns (1,3,5)
				
				$data['title'] = 'Manage Transcript | '.app_name;
				$data['page_active'] = 'transcript';
				$this->load->view('designs/header', $data);
				$this->load->view('transcript/manage', $data);
				$this->load->view('designs/footer', $data);
			}
		
	}

	public function history($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('tr_student_id'))) {
			redirect(base_url('login'), 'refresh');
		}
		$user_id = $this->session->userdata('tr_student_id');
		

		$table = 'transcript';
			
			// pass parameters to view
			$data['param1'] = $param1;
			$data['param2'] = $param2;
			$data['param3'] = $param3;
			$form_url = 'transcript/history/'.$param1;
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
					if($param2 == 'approve') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_status'] = $e->request_status;
									
								}
							}
						}
					}

					if($param2 == 'view') {
						if($param3) {
							$edit = $this->Crud->read_single('id', $param3, $table);
							if(!empty($edit)) {
								foreach($edit as $e) {
									$data['e_id'] = $e->id;
									$data['e_student_id'] = $e->student_id;
									$data['e_status'] = $e->request_status;
									$data['e_request_type'] = $e->request_type;
									$data['e_request_date'] = $e->request_date;
									$data['e_request_approve'] = $e->request_approve;
									$data['e_receiver_email'] = $e->receiver_email;
									$data['e_date_approved'] = $e->date_approved;
									
								}
							}
						}
					}

					
					if($_POST){
						$id = $this->input->post('id');
						$status = $this->input->post('status');
						
						
						// do create or update
						if($id) {
							$upd_data['request_status'] = $status;
							$upd_data['date_approved'] = date(fdate);
							$upd_data['request_approve'] = $user_id;
							
							$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
							if($upd_rec > 0) {
								echo $this->Crud->msg('success', 'Request Updated');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('info', 'No Changes');	
							}
						}
						
						die;	
					}
				}
			}

			
			// record listing
			if($param1 == 'list') {
				// DataTable parameters
				$table = 'transcript';
				$column_order = array('id', 'student_id', 'request_type', 'request_date');
				$column_search = array('id', 'student_id', 'request_type', 'request_date');
				$order = array('request_date' => 'desc');
				$where = array('student_id' => $user_id);
				
				// load data into table
				$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
				$data = array();
				// $no = $_POST['start'];
				$count = 1;
				foreach ($list as $item) {
					$id = $item->id;
					$student_id = $item->student_id;
					$request_date = $item->request_date;
					$request_type = $item->request_type;
					$request_status = $item->request_status;
					


					if ($request_status == 0) {
						$request = '<span class="text-warning">Request Pending</span>';
					} elseif ($request_status == 2) {
						$request = '<span class="text-danger">Request Denied</span>';
					} else {
						$request = '<span class="text-success">Request Approved</span>';
					}
					
					
					// add scripts to last record
					if($count == count($list)){
						$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
					} else {$script = '';}
					
					// edit 
					$edit_btn = '
						<a class="text-primary pop" href="javascript:;" pageTitle="Approve Request" data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve Request" pageName="'.base_url('transcript/history/manage/approve/'.$id).'" pageSize="modal-md">
							<i class="ti-check-box fa-2x"></i>
						</a>
					';

					
					// delete 
					$del_btn = '
						<a class="text-success pop" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Request" pageTitle="View Request" pageName="'.base_url('transcript/history/manage/view/'.$id).'" pageSize="modal-md">
							<i class="ti-eye fa-2x"></i>
						</a>
					';

					
					// delete 
					$dow_btn = '
						<a class="text-info" href="'.base_url('transcript/send_transcript/download/'.$id).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Transcript" pageTitle="View Request" pageName="" pageSize="modal-md">
							<i class="ti-cloud-down fa-2x"></i>
						</a>
					';

					if ($request_status == 1 && $request_type == 'Official') {
						// add manage buttons
						$all_btn = '
							<div class="text-center">
								'.$del_btn.'&nbsp;
								'.$dow_btn.'&nbsp;
							</div>
							'.$script.'
						';
					} elseif ($request_status == 1 && $request_type == 'Unofficial') {
						// add manage buttons
						$all_btn = '
							<div class="text-center">
								'.$del_btn.'&nbsp;
							</div>
							'.$script.'
						';
					} else {
						// add manage buttons
						$all_btn = '
							<div class="text-center">
								'.$del_btn.'&nbsp;
							</div>
							'.$script.'
						';
					
					}
					
					
					$row = array();
					$row[] = ucwords($student_id);
					$row[] = date('F d, Y', strtotime($request_date));
					$row[] = $request_type;
					$row[] = $request;
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
				$this->load->view('transcript/manage_form', $data);
			} else {
				// for datatable
				$data['table_rec'] = 'transcript/history/list'; // ajax table url
				$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
				$data['no_sort'] = '0'; // sort disable columns (1,3,5)
				
				$data['title'] = 'Transcript History | '.app_name;
				$data['page_active'] = 'transcript_history';
				$this->load->view('designs/header', $data);
				$this->load->view('transcript/manage', $data);
				$this->load->view('designs/footer', $data);
			}
		
	}

	public function send_transcript($param='', $param1=''){
		$student_id = $this->Crud->read_field('id', $param1, 'transcript', 'student_id');
		$data['student_id'] = $student_id;
		$data['id'] = $param1;
		$data['param'] = $param;
		$data['title'] = ' Transcript View';
		
		$this->load->view('transcript/view', $data);
	}

	public function send(){
		if ($_POST) {
			$request_type = $this->input->post('request_type');
			$rec_email = $this->input->post('rec_email');
			
			if ($request_type == 'Official' && $rec_email=='') {
				echo $this->Crud->msg('warning', 'Please Fill all Fields');
			} else {
					
				$ins_data['request_type'] = $request_type;
				$ins_data['receiver_email'] = $rec_email;
				$ins_data['student_id'] = $this->session->userdata('tr_student_id');
				$ins_data['request_date'] = date(fdate);
				
				$ins_id = $this->Crud->create('transcript', $ins_data);
				if($ins_id > 0) {
					echo $this->Crud->msg('success', 'Transcript Request Submitted!!<br> Check back for the Status!');
					echo '<script>location.reload(false);</script>';
				} else {
					echo $this->Crud->msg('danger', 'Please Try Again Later');
				}

				
			}
		}
	}

}
