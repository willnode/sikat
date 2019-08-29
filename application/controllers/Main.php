<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index($id = '')
	{
		$account = $this->Main_model->getAccountInfo($id);
		$this->load->view('components/header');
		switch ($account['type']) {
			case 'c':
				$data = $this->Main_model->getCampusDatabase($account['user_id']);
				$this->load->view('home/campus', $data);
				break;
			case 'd':
				$data = $this->Main_model->getDepartmentDatabase($id);
				$this->load->view('home/department', $data);
				break;
			case 'p':
				$data = $this->Main_model->getProgramDatabase($id);
				$this->load->view('home/program', $data);
				break;
			case 's':
				$data = $this->Main_model->getStudentDatabase($id);
				$this->load->view('home/student', $data);
				break;
			case 't':
				$data = $this->Main_model->getTeacherDatabase($id);
				$this->load->view('home/teacher', $data);
				break;
			case 'o':
				$data = $this->Main_model->getOrganizationDatabase($id);
				$this->load->view('home/organization', $data);
				break;
			default:
				# code...
				break;
		}
		$this->load->view('components/footer');
	}

	public function search($type, $id = '')
	{
		$this->load->view('components/header');

		$account = $this->Main_model->getAccountInfo($id);
		$data = $this->Main_model->getTeacherList($id, $account['type'], 0, 50);
		$this->load->view('search/teacher', $data);

		$this->load->view('components/footer');
	}
	// public function department($id)
	// {
	// 	$data = $this->Main_model->getFacultyDatabase($id);
	// 	$this->load->view('components/header');
	// 	$this->load->view('home/department', $data);
	// 	$this->load->view('components/footer');
	// }

	// public function program($id)
	// {
	// 	$data = $this->Main_model->getProgramDatabase($id);
	// 	$this->load->view('components/header');
	// 	$this->load->view('home/program', $data);
	// 	$this->load->view('components/footer');
	// }

	// public function student($id)
	// {
	// 	$data = $this->Main_model->getStudentDatabase($id);
	// 	$this->load->view('components/header');
	// 	$this->load->view('home/student', $data);
	// 	$this->load->view('components/footer');
	// }

	// public function teacher($id)
	// {
	// 	$data = $this->Main_model->getTeacherDatabase($id);
	// 	$this->load->view('components/header');
	// 	$this->load->view('home/teacher', $data);
	// 	$this->load->view('components/footer');
	// }


	// public function organization($id)
	// {
	// 	$data = $this->Main_model->getOrganizationDatabase($id);
	// 	$this->load->view('components/header');
	// 	$this->load->view('home/organization', $data);
	// 	$this->load->view('components/footer');
	// }
}
