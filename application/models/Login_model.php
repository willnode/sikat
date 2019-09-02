<?php

class Login_model extends CI_Model{

	function is_logged_in() {
		return (bool)$this->session->userdata('username');
	}

	function get_current_login() {
		return $this->session->userdata('username');
	}

	function get_current_login_detail() {
		$id = $this->session->userdata('username');
		$type = $this->db->select('type')->get_where('accounts', ['user_id' => $id])->row()->type;
		$is_member = $type == 's' || $type == 't';
		$folder = $is_member ? 'profiles' : 'logos';
		$ext = $is_member == 't' ? 'jpg' : 'png';
		return (object)[
			'username' => $id,
			'type' => $type,
			'is_member' => $is_member,
			'avatar' => "files/$folder/$id.$ext"
		];
	}

	function set_current_login($id) {
		return $this->session->set_userdata('username', $id);
	}

	function check_login($user,$pwd){
		$login = ['user_id' => $user];
		if (!empty($pwd))
			$login['password'] = sha1($pwd);
		return $this->db->get_where('accounts',$login, 1)->num_rows() == 1;
	}

	function set_password($user,$pwd){
		return $this->db->update('accounts', ['password' => sha1($pwd)], ['user_id' => $user], 1);
	}

}