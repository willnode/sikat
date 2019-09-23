<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class LoginModel {

	protected $db;

	public function __construct(ConnectionInterface &$db)
	{
			$this->db =& $db;
			$this->lang = session('site_lang') ?: (new \Config\App())->defaultLocale;
	}

	function is_logged_in() {
		return !empty(session('username'));
	}

	function get_current_login() {
		return session('username');
	}

	function get_current_login_detail() {
		$id = session('username');
		echo empty($id);
		$type = $this->db->table('accounts')->select('type')->getWhere(['account_id' => $id])->getRow()->type;
		$is_member = $type == 'student' || $type == 'teacher';
		$folder = $is_member ? 'profiles' : 'logos';
		$ext = $is_member ? 'jpg' : 'png';
		return (object)[
			'username' => $id,
			'type' => $type,
			'is_member' => $is_member,
			'avatar' => "files/$folder/$id.$ext"
		];
	}

	function set_current_login($id) {
		return session()->set('username', $id);
	}

	function check_login($user,$pwd){
		$login = ['account_id' => $user];
		if (!empty($pwd))
			$login['password'] = sha1($pwd);
		return !empty($this->db->table('accounts')->getWhere($login, 1)->getRow());
	}

	function set_password($user,$pwd){
		return $this->db->update('accounts', ['password' => sha1($pwd)], ['account_id' => $user], 1);
	}

}