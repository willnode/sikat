<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function login()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/footer');
	}

}
