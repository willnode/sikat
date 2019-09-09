<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->helper('form_controls');
	}

	public function dashboard()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/footer');
	}

	public function _remap($page)
	{
		if (!$this->Login_model->is_logged_in())
			redirect('login');
		if (!file_exists(APPPATH."views/admin/pages/$page.php"))
			show_404();
		$data = [
			"login" => $this->Login_model->get_current_login_detail()
		];
		if (method_exists($this, $page."Data")) {
			$this->{$page."Data"}($data);
		}
		$this->load->view('admin/header', $data);
		$this->load->view("admin/pages/$page", $data);
		$this->load->view('admin/footer');
	}

	public function biodataData(&$data) {
		$id = $data['login']->username;
		switch ($data['login']->type) {
			case 'student':
				$row = $this->db->get_where('students', ['student_id' => $id], 1)->row();
				$data['biodata'] = $row;
				break;
			case 'teacher':
				$row = $this->db->get_where('teachers', ['teacher_id' => $id], 1)->row();
				$data['biodata'] = $row;
				break;
			case 'organization':
				$row = $this->db->get_where('organizations', ['organization_id' => $id], 1)->row();
				$data['biodata'] = $row;
				break;
			case 'program':
				$row = $this->db->get_where('programs', ['program_id' => $id], 1)->row();
				$data['biodata'] = $row;
				break;
			case 'department':
				$row = $this->db->get_where('departments', ['department_id' => $id], 1)->row();
				$data['biodata'] = $row;
				break;
			case 'faculty':
				$row = $this->db->get_where('faculties', ['faculty_id' => $id], 1)->row();
				$data['biodata'] = $row;
				break;
			case 'campus':
				$row = $this->db->get_where('campus', ['campus_id' => $id], 1)->row();
				$data['biodata'] = $row;
				break;
		}
	}

	public function lookData(&$data) {
		$id = $data['login']->username;
		$row = $this->db->get_where('account_localizations', ['account_id' => $id])->result();
		$data['localizations'] = $row;
	}

	public function contentData(&$data) {
		$id = $data['login']->username;
		$feed = $this->db->get_where('account_feeds', ['account_id' => $id])->result();
		$weblink = $this->db->get_where('account_weblinks', ['account_id' => $id])->result();
		$data['feeds'] = $feed;
		$data['weblinks'] = $weblink;
		$data['op_weblinks'] = $this->Search_model->listAllWeblinkOptions();
	}

	public function dbData($type, &$data) {
		$page_count = 100;
		$page = $this->input->get('page') ?: 1;

		$id = $data['login']->username;
		$account = $this->Main_model->getAccountInfo($id);
		$query = [
			'students' => 'getStudentList',
			'alumni' => 'getAlumniList',
			'teachers' => 'getTeacherList',
			'organizations' => 'getOrganizationList',
			'programs' => 'getProgramList',
			'departments' => 'getDepartmentList',
			'faculties' => 'getFacultyList',
		][$type];
		$data['list'] = $this->Search_model->$query($id, $account->type, $this->input->get('q'), ($page - 1) * $page_count, $page_count);
	}

	public function facultyData(&$data) { $this->dbData('faculties', $data); }
	public function departmentData(&$data) { $this->dbData('departments', $data); }
	public function programData(&$data) { $this->dbData('programs', $data); }
	public function organizationData(&$data) { $this->dbData('organizations', $data); }
	public function teacherData(&$data) { $this->dbData('teachers', $data); }
	public function studentData(&$data) { $this->dbData('students', $data); }

	// public function look()
	// {
	// 	}

	// public function biodata()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function content()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function structure()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function review()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function privacy()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function grants()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function website()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function statistics()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function department()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function program()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function student()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function teacher()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }

	// public function organization()
	// {
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/footer');
	// }
}
