<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class SearchModel {


	protected $db;

	public function __construct(ConnectionInterface &$db)
	{
		$this->db =& $db;
		$this->lang = session('site_lang') ?: (new \Config\App())->defaultLocale;
	}

	function getList($scopeAccount, $mode, $search, $page, $limit)
	{
		$query = $this->db->table($mode == 'alumni' ? 'students' : $mode);

		$fn = [
			'students' => 'narrowStudentScope',
			'alumni' => 'narrowAlumniScope',
			'teachers' => 'narrowTeacherScope',
			'organizations' => 'narrowOrganizationScope',
			'programs' => 'narrowProgramScope',
			'departments' => 'narrowDepartmentScope',
			'faculties' => 'narrowFacultyScope',
		][$mode];

		$idd = [
			'students' => 'student_id',
			'alumni' => 'student_id',
			'teachers' => 'teacher_id',
			'organizations' => 'organization_id',
			'programs' => 'program_id',
			'departments' => 'department_id',
			'faculties' => 'faculty_id',
		][$mode];

		$this->$fn($query, $scopeAccount->account_id, $scopeAccount->type);

		if (!empty($search)) $query->like('name', $search, 'both');

		$count = $query->countAllResults(FALSE);

		return [
			'items' => $query->get($limit, ($page - 1) * $limit)->getResult(),
			'count' => $count,
			'pagination' => $limit,
			'scope' => $scopeAccount->account_id,
			'query' => $search,
			'mode' => $mode,
			'member_mode' => $mode == 'students' || $mode == 'teachers',
			'id_key' => $idd,
		];
	}

	var $lang = 'id';

  	function narrowTeacherScope(&$query, $scope, $scope_type) {

	switch ($scope_type) {
		case 'faculty':
			$query->join('programs', 'programs.program_id = teachers.program_id');
			$query->join('departments', 'departments.department_id = programs.department_id');
			$query->where(['faculty_id' => $scope]);
			break;
		case 'department':
			$query->join('programs', 'programs.program_id = teachers.program_id');
			$query->where(['department_id' => $scope]);
			break;
		case 'program':
			$query->where(['program_id' => $scope]);
			break;
	}
  }


  function narrowStudentScope(&$query, $scope, $scope_type) {
	switch ($scope_type) {
		case 'department':
			$query->join('programs', 'programs.program_id = students.program_id');
			$query->where(['department_id' => $scope]);
			break;
		case 'program':
			$query->where(['program_id' => $scope]);
			break;
		default:
			# code...
			break;
	}
	$query->where(['status' => 'active']);
  }

  function narrowAlumniScope(&$query, $scope, $scope_type) {
	switch ($scope_type) {
		case 'department':
			$query->join('programs', 'programs.program_id = students.program_id');
			$query->where(['department_id' => $scope]);
			break;
		case 'program':
			$query->where(['program_id' => $scope]);
			break;
		case 'campus':
		default:
			# code...
			break;
	}
	$query->where(['status' => 'alumni']);
  }

  function narrowOrganizationScope(&$query, $scope, $scope_type) {

	switch ($scope_type) {
		case 'faculty':
			$query->join('programs', 'programs.program_id = organizations.organization_parent');
			$query->join('departments', 'departments.department_id = programs.department_id');
			$query->where(['department_id' => $scope]);
			break;
		case 'department':
			$query->join('programs', 'programs.program_id = organizations.organization_parent');
			$query->where(['department_id' => $scope]);
			break;
		case 'program':
			$query->where(['organization_parent' => $scope]);
			break;
	}
  }


  function narrowFacultyScope(&$query, $scope, $scope_type) {

	$query->join("account_localizations",
		"account_localizations.account_id = faculties.faculty_id".
		" AND account_localizations.lang = '$this->lang'", 'left outer');
  }

  function narrowDepartmentScope(&$query, $scope, $scope_type) {

	$query->join("account_localizations",
		"account_localizations.account_id = departments.department_id".
		" AND account_localizations.lang = '$this->lang'", 'left outer');
  }

  function narrowProgramScope(&$query, $scope, $scope_type) {

	$query->join("account_localizations",
		"account_localizations.account_id = programs.program_id".
		" AND account_localizations.lang = '$this->lang'", 'left outer');

	switch ($scope_type) {
		case 'faculty':
			$query->join('deparments', 'deparments.department_id = programs.department_id');
			$query->where(['faculty_id' => $scope]);
			break;
		case 'department':
			$query->where(['department_id' => $scope]);
			break;
	}
  }

  function listAllProgramOptions()
  {
	  $data = $this->db->table('account_localizations')->select(['program_id', 'title'])
	  	->join('account_localizations', 'program_id = account_id')->order_by('title')->get('programs');
	  foreach ($data->result() as $program) {
		  $list[$program->program_id] = $program->title;
	  }
	  return $list;
  }

  function listAllWeblinkOptions()
  {
	  $data = $this->db->table('op_weblinks');
	  foreach ($data->result() as $weblink) {
		  $list[$weblink->weblink] = $weblink->weblink;
	  }
	  return $list;
  }
}