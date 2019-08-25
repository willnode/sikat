<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->model('Main_model');

		$data = $this->Main_model->getCampusDatabase();
		$this->load->view('components/header');
		$this->load->view('home/campus', $data);
		$this->load->view('components/footer');
	}

	public function faculty($id)
	{
		$this->load->model('Main_model');

		$data = $this->Main_model->getFacultyDatabase($id);
		$this->load->view('components/header');
		$this->load->view('home/faculty', $data);
		$this->load->view('components/footer');
	}

	public function program($id)
	{
		$this->load->model('Main_model');

		$data = $this->Main_model->getProgramDatabase($id);
		$this->load->view('components/header');
		$this->load->view('home/program', $data);
		$this->load->view('components/footer');
	}

	public function student($id)
	{
		$this->load->model('Main_model');

		$data = $this->Main_model->getStudentDatabase($id);
		$this->load->view('components/header');
		$this->load->view('home/student', $data);
		$this->load->view('components/footer');
	}

	public function lecturer($id)
	{
		$this->load->model('Main_model');

		$data = $this->Main_model->getLecturerDatabase($id);
		$this->load->view('components/header');
		$this->load->view('home/lecturer', $data);
		$this->load->view('components/footer');
	}
}
