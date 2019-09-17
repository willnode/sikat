<?php namespace App\Controllers;

use \App\Models\LoginModel;

class Panel extends BaseController
{

	public function __construct()
	{
			$db = \Config\Database::connect();
			$this->LoginModel = new LoginModel($db);
	}

	public function dashboard()
	{
		view('admin/header');
		view('admin/footer');
	}

	public function _remap($page)
	{
		if (!$this->LoginModel->is_logged_in()) {
			return $this->response->redirect(base_url('login'));
		}
		if (!file_exists(APPPATH."Views/admin/pages/$page.php"))
			show_404();
		$data = [
			"login" => $this->LoginModel->get_current_login_detail()
		];
		if (method_exists($this, $page."Data")) {
			$this->{$page."Data"}($data);
		}
		view('admin/header', $data);
		view("admin/pages/$page", $data);
		view('admin/footer');
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
		$data['op_weblinks'] = $this->SearchModel->listAllWeblinkOptions();
	}

	public function dbData($type, &$data) {
		$page_count = 100;
		$page = $this->input->get('page') ?: 1;

		$id = $data['login']->username;
		$account = $this->MainModel->getAccountInfo($id);
		$query = [
			'students' => 'getStudentList',
			'alumni' => 'getAlumniList',
			'teachers' => 'getTeacherList',
			'organizations' => 'getOrganizationList',
			'programs' => 'getProgramList',
			'departments' => 'getDepartmentList',
			'faculties' => 'getFacultyList',
		][$type];
		$data['list'] = $this->SearchModel->$query($id, $account->type, $this->input->get('q'), ($page - 1) * $page_count, $page_count);
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
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function content()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function structure()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function review()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function privacy()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function grants()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function website()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function statistics()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function department()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function program()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function student()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function teacher()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }

	// public function organization()
	// {
	// 	view('admin/header');
	// 	view('admin/footer');
	// }
}
