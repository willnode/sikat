<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
	}

	public function index($id = '')
	{
		if (in_array($id, ['students', 'teachers', 'organizations', 'programs', 'departments', 'faculties', 'alumni'])) {
			return $this->search($id, '');
		}
		$id = $id ?: $this->db->select('campus_id')->get('campus')->row()->campus_id;
		$account = $this->Main_model->getAccountInfo($id);
		$this->load->view('components/header', ['float' => 1]);
		switch ($account->type) {
			case 'campus':
				$data = $this->Main_model->getCampusDatabase($account->account_id);
				$this->load->view('home/campus', $data);
				break;
			case 'faculty':
				$data = $this->Main_model->getFacultyDatabase($id);
				$this->load->view('home/faculty', $data);
				break;
			case 'department':
				$data = $this->Main_model->getDepartmentDatabase($id);
				$this->load->view('home/department', $data);
				break;
			case 'program':
				$data = $this->Main_model->getProgramDatabase($id);
				$this->load->view('home/program', $data);
				break;
			case 'student':
				$data = $this->Main_model->getStudentDatabase($id);
				$this->load->view('home/student', $data);
				break;
			case 'teacher':
				$data = $this->Main_model->getTeacherDatabase($id);
				$this->load->view('home/teacher', $data);
				break;
			case 'organization':
				$data = $this->Main_model->getOrganizationDatabase($id);
				$this->load->view('home/organization', $data);
				break;
			default:
				# code...
				break;
		}
		$this->load->view('components/footer', ['account' => $account]);
	}

	public function search($type, $id = '')
	{
		$page_count = 40;
		$page = min(10, $this->input->get('page') ?: 1);
		$this->load->view('components/header');

		$id = $id ?: $this->db->get('campus')->row()->campus_id;
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
		$data = $this->Search_model->$query($id, $account->type, $this->input->get('q'), ($page - 1) * $page_count, $page_count);
		$this->load->view('search/'.$type, $data);

		$this->load->view('components/footer', ['account' => $account]);
	}

	public function fetch_rss($id)
	{
		$rss = $this->db->get_where('account_feeds', ['account_id' => $id, 'lang' => $this->Main_model->lang], 1)->row()->rss;
		if (!empty($rss)) {
			header('Content-Type: application/xml');

			$cache_file = FCPATH.'application'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'feeds'.DIRECTORY_SEPARATOR.$id.'.xml';

			if(file_exists($cache_file)) {
				// 1 day cache
				if(time() - filemtime($cache_file) < 86400) {
					// cache is still fresh
					echo file_get_contents($cache_file);
					return;
				}
			}
			{
				$cache = file_get_contents($rss);
				if ($cache === FALSE) if (file_exists($cache_file)) $cache = file_get_contents($cache_file);
				else return;

				$rawdom = new DOMDocument();
				$rawdom->loadXML(iconv('UTF-8', 'UTF-8//IGNORE', $cache));

				$dom = new DOMDocument();
				$dom->preserveWhiteSpace = false;
				$root = $dom->createElement('feed');
				$entries = $rawdom->getElementsByTagName('entry');
				if ($entries->length == 0) $entries = $rawdom->getElementsByTagName('item');
				$c = 0;
				foreach ($entries as $item) {
					$el = $dom->createElement('entry');
					$title = $dom->createElement('title', $item->getElementsByTagName('title')->item(0)->textContent);
					$rawlink = $item->getElementsByTagName('link')->item(0);
					$link = $dom->createElement('link', $rawlink->getAttribute('href') ?: $rawlink->textContent);
					$rawupdated = $item->getElementsByTagName('updated')->item(0);
					if ($rawupdated == NULL) $rawupdated = $item->getElementsByTagName('pubDate')->item(0);
					$updated = $dom->createElement('updated', $rawupdated->textContent);
					$el->appendChild($title);
					$el->appendChild($link);
					$el->appendChild($updated);
					$root->appendChild($el);
					if ($c++ >= 12) break;
				}

				$dom->appendChild($root);

				$cache = $dom->saveXML();
				file_put_contents($cache_file, $cache);
				echo $cache;
				return;
			}
		}
	}

	public function login()
	{
		$this->load->model('Login_model');
		if ($this->input->method() == 'post') {
			$id = $this->input->post('username');
			if ($this->Login_model->check_login($id, $this->input->post('password'))) {
				$this->Login_model->set_current_login($id);
				redirect(base_url('panel/dashboard'));
			} else {
				echo 'FAIL';
				$this->load->view('admin/login');
			}
		} else if ($this->Login_model->is_logged_in()) {
			redirect(base_url('panel/dashboard'));
		} else {
			$this->load->view('admin/login');
		}


	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	function switch_lang($language = "") {
		$this->load->library('user_agent');
		$this->session->set_userdata('site_lang', $language ?: "english");
		redirect($this->agent->referrer());
	}
}
