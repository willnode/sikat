<?php namespace App\Controllers;

use \App\Models\LoginModel;
use \App\Models\MainModel;
use \App\Models\SearchModel;

class Home extends BaseController
{
	public $db;
	public $MainModel;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->MainModel = new MainModel($this->db);
		\helper('DefaultGen');
	}

	public function index()
	{
		$id = $this->db->table('campus')->select('campus_id')->get()->getRow()->campus_id;
		return $this->page($id);
	}

	public function index_api()
	{
		$id = $this->db->table('campus')->select('campus_id')->get()->getRow()->campus_id;
		return $this->response->redirect(base_url('api/'.$id));
	}

	public function api($id)
	{
		$account = $this->MainModel->getAccountInfo($id);
		return $this->response->setJSON($this->MainModel->getDatabase($id, $account->type));
	}

	public function page($id)
	{
		$theme = 'minimalist';

		$account = $this->MainModel->getAccountInfo($id);
		return
			view("$theme/header").
			view("$theme/navbar", ['float' => 1, 'query' => '', 'login' =>  session('username'), 'lang' => session('site_lang')]).
			view("$theme/layout/$account->type", $this->MainModel->getDatabase($id, $account->type)).
			view("$theme/footer", ['account' => $account]);
	}

	public function search($type, $id = '')
	{
		$this->theme = 'minimalist';
		$page_count = 40;
		$page = min(10, $this->request->getGet('page') ?: 1);
		$id = $id ?: $this->db->table('campus')->get()->getRow()->campus_id;
		$account = $this->MainModel->getAccountInfo($id);
		$q = $this->request->getGet('q');
		$data = (new SearchModel($this->db))
			->getList($account, $type, $q, $page, $page_count);
		return
			view("$this->theme/header").
			view("$this->theme/navbar", ['query' => $q, 'login' => $account->account_id, 'lang' => session('site_lang')]).
			view("$this->theme/layout/search", $data).
			view("$this->theme/footer", ['account' => $account]);
	}

	public function fetch_rss($id)
	{
		$rss = $this->db->table('account_feeds')->getWhere(['account_id' => $id, 'lang' => $this->MainModel->lang], 1)->getRow()->rss;
		if (!empty($rss)) {

			$cache_file = WRITEPATH.'feeds'.DIRECTORY_SEPARATOR.$id.'.xml';
			if(file_exists($cache_file)) {
				// 1 day cache
				if(time() - filemtime($cache_file) < 86400) {
					// cache is still fresh
					return $this->response->setXML(file_get_contents($cache_file));
				}
			}

			$cache = file_get_contents($rss);
			if ($cache === FALSE) if (file_exists($cache_file)) $cache = file_get_contents($cache_file);
			else return;

			$rawdom = new \DOMDocument();
			libxml_use_internal_errors(true);
			if($rawdom->loadXML(iconv('UTF-8', 'UTF-8//IGNORE', $cache), LIBXML_NOERROR)) {
				$dom = new \DOMDocument();
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
			}
			return $this->response->setXML($cache);

		}
	}

	public function login()
	{
		$db = \Config\Database::connect();
		$LoginModel = new LoginModel($db);
		if ($this->request->getMethod() == 'post') {
			$id = $this->request->getPost('username');
			if ($LoginModel->check_login($id, $this->request->getPost('password'))) {
				$LoginModel->set_current_login($id);
				return $this->response->redirect(base_url('panel/dashboard'));
			} else {
				echo 'FAIL';
				return view('admin/login');
			}
		} else if ($LoginModel->is_logged_in()) {
			return redirect(base_url('panel/dashboard'));
		} else {
			return view('admin/login');
		}
	}

	function logout(){
		session()->destroy();
		$this->response->redirect($this->request->getUserAgent()->getReferrer() ?: base_url('login'));
	}

	function switch_lang() {
		session()->set('site_lang', $this->request->getPost('lang') ?: "en");
		$this->response->redirect($this->request->getUserAgent()->getReferrer());
	}

	//--------------------------------------------------------------------

}
