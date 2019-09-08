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

		$data = [
			"login" => $this->Login_model->get_current_login_detail()
		];
		if (method_exists($this, $page."Data")) {
			$this->{$page."Data"}($data);
		}
		$this->load->view('admin/header', $data);
		$this->load->view('admin/pages/'.$page, $data);
		$this->load->view('admin/footer');
	}

	public function biodataData(&$data) {
		switch ($data['login']->type) {
			case 's':
				$row = $this->db->get_where('students', ['student_id' => $data['login']->username])->row();
				$data['biodata'] = $row;
				break;
			case 't':
				$row = $this->db->get_where('teachers', ['teacher_id' => $data['login']->username])->row();
				$data['biodata'] = $row;
				break;
		}
	}
	public function lookData(&$data) {

	}


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
