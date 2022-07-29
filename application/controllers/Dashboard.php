<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('tr_user_id'))) {
			redirect(base_url('login'), 'refresh');
		}
		$user_id = $this->session->userdata('tr_user_id');

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
					<a class="text-warning" href="'.base_url('transcript/send_transcript/'.$id).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send Transcript" pageTitle="View Request" pageName="" pageSize="modal-md">
						<i class="ti-location-arrow fa-2x"></i>
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

		// for datatable
		$data['table_rec'] = 'transcript/index/list'; // ajax table url
		$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
		$data['no_sort'] = '0'; // sort disable columns (1,3,5)
				
				
		$username = $this->Crud->read_field('id', $user_id, 'user', 'staff_id');
		$data['username'] = $username;
		$data['title'] = 'Dashboard | '.app_name;
		$data['page_active'] = 'dashboard';
		$this->load->view('designs/header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('designs/footer', $data);
	}

	public function stud_dash($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('tr_student_id'))) {
			redirect(base_url('login'), 'refresh');
		}
		$user_id = $this->session->userdata('tr_student_id');

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
					<a class="text-warning" href="'.base_url('transcript/send_transcript/'.$id).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send Transcript" pageTitle="View Request" pageName="" pageSize="modal-md">
						<i class="ti-location-arrow fa-2x"></i>
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

		// for datatable
		$data['table_rec'] = 'transcript/stud_dash/list'; // ajax table url
		$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
		$data['no_sort'] = '0'; // sort disable columns (1,3,5)
				
				
		$data['title'] = 'Dashboard | '.app_name;
		$data['page_active'] = 'dashboard';
		$this->load->view('designs/header', $data);
		$this->load->view('student_dash', $data);
		$this->load->view('designs/footer', $data);
	}

	public function error() {
		
		$data['title'] = 'Error Page | '.app_name;
		$data['page_active'] = 'dashboard';
		//$this->load->view('designs/header', $data);
		$this->load->view('error', $data);
		//$this->load->view('designs/footer', $data);
		
	}

	public function test() {
		
		$data['title'] = 'Error Page | '.app_name;
		$data['page_active'] = 'dashboard';
		//$this->load->view('designs/header', $data);
		$this->load->view('test', $data);
		//$this->load->view('designs/footer', $data);
		
	}

	public function profile() {
		if(empty($this->session->userdata('ta_user_id'))) {
			redirect(base_url('login'), 'refresh');
		}
			$user_id = $this->session->userdata('ta_user_id');


		$table = 'info';
		$get_img_id = $this->Crud->read_field('id', $user_id, 'user', 'img_id');
		$get_img_small = $this->Crud->read_field('id', $get_img_id, 'image', 'pics_small');
		$get_img_square = $this->Crud->read_field('id', $get_img_id, 'image', 'pics_square');
		$data['image_upload'] = $get_img_small;
		$data['image_square'] = $get_img_square;
		$name = $this->Crud->read_field('id', $user_id, 'info', 'matric');
		$role = $this->Crud->read_field('id', $user_id, 'user', 'role');
		$department = $this->Crud->read_field('id', $user_id, 'info', 'department');
		$level = $this->Crud->read_field('id', $user_id, 'info', 'level');
		$school = $this->Crud->read_field('id', $user_id, 'info', 'school');


		$data['user'] = $name;
		$data['role'] = $role;
		$data['level'] = $level;
		$data['department'] = ucfirst($department);
		$data['school'] = $schools;

		$get_img_id = $this->Crud->read_field('id', $user_id, 'info', 'img_id');
		$get_img_small = $this->Crud->read_field('id', $get_img_id, 'image', 'pics_small');
		$get_img_square = $this->Crud->read_field('id', $get_img_id, 'image', 'pics');
		$data['image_upload'] = $get_img_small;
		$data['image_square'] = $get_img_square;

		$edit = $this->Crud->read_single('id', $user_id, $table);
		if(!empty($edit)) {
			foreach($edit as $e) {
				$data['e_id'] = $e->id;
				$data['e_surname'] = $e->surname;
				$data['e_first_name'] = $e->first_name;
				$data['e_last_name'] = $e->last_name;
				$data['e_matric'] = $e->matric;
				$data['e_level'] = $e->level;
				$data['e_semester'] = $e->semester;
				$data['e_time'] = $e->time;
				$data['e_department'] = $e->department;
				$data['e_school'] = $e->school;
			}
		}

		
		$data['title'] = 'Profile | '.app_name;
		$data['page_active'] = 'dashboard';
		$this->load->view('designs/header', $data);
		$this->load->view('profile', $data);
		$this->load->view('designs/footer', $data);
	}

	
	
}
