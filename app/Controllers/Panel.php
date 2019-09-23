<?php namespace App\Controllers;

use \App\Models\LoginModel;
use \App\Models\SearchModel;

class Panel extends BaseController
{

	public function __construct()
	{
			$db = \Config\Database::connect();
			$this->LoginModel = new LoginModel($db);
			$this->SearchModel = new SearchModel($db);
			$this->db = &$db;
			\helper('form');
			\helper('FormControl');
		}

	public function dashboard()
	{
		return
		view('admin/header').
		view('admin/footer');
	}

	public function page($page)
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
		return
		view('admin/header', $data).
		view("admin/pages/$page", $data).
		view('admin/footer');
	}

	public function biodataData(&$data) {
		$id = $data['login']->username;
		switch ($data['login']->type) {
			case 'student':
				$row = $this->db->table('students')->getWhere(['student_id' => $id], 1)->getRow();
				$data['biodata'] = $row;
				break;
			case 'teacher':
				$row = $this->db->table('teachers')->getWhere(['teacher_id' => $id], 1)->getRow();
				$data['biodata'] = $row;
				break;
			case 'organization':
				$row = $this->db->table('organizations')->getWhere(['organization_id' => $id], 1)->getRow();
				$data['biodata'] = $row;
				break;
			case 'program':
				$row = $this->db->table('programs')->getWhere(['program_id' => $id], 1)->getRow();
				$data['biodata'] = $row;
				break;
			case 'department':
				$row = $this->db->table('departments')->getWhere(['department_id' => $id], 1)->getRow();
				$data['biodata'] = $row;
				break;
			case 'faculty':
				$row = $this->db->table('faculties')->getWhere(['faculty_id' => $id], 1)->getRow();
				$data['biodata'] = $row;
				break;
			case 'campus':
				$row = $this->db->table('campus')->getWhere(['campus_id' => $id], 1)->getRow();
				$data['biodata'] = $row;
				break;
		}
	}

	public function lookData(&$data) {
		$id = $data['login']->username;
		$row = $this->db->table('account_localizations')->getWhere(['account_id' => $id])->getResult();
		$data['localizations'] = $row;
	}

	public function contentData(&$data) {
		$id = $data['login']->username;
		$feed = $this->db->table('account_feeds')->getWhere(['account_id' => $id])->getResult();
		$weblink = $this->db->table('account_weblinks')->getWhere(['account_id' => $id])->getResult();
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
