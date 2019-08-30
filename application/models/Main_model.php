<?php

class Main_model extends CI_Model {

	function __construct()
	{
		$this->lang = ['english' => 'en', 'indonesian' => 'id'][$this->config->config['language']];
	}

	var $lang = 'id';

	function getAccountInfo($id)
	{
		$id = $id ?: $this->db->get('campus')->result_array()[0]['campus_id'];
		$data = $this->db->get_where('accounts', ['user_id' => $id]);
		if ($data->num_rows() == 0) show_404();
		return $data->result_array()[0];
	}

	function dbGetLocalized($table, $joins, $where = [])
	{
		$this->db->join("localization__$table", join(' AND ', array_map(function($key) use($table) {
			return "localization__$table.$key = $table.$key";
		}, $joins)));
		$this->db->where("localization__$table.lang = '$this->lang'");
		foreach ($where as $key => $value) {
			$this->db->where($key, $value);
		}
		return $this->db->get($table);
	}

	function dbGetStructureData($id)
	{
		$this->db->select([
			'localization__structures.title',
			'students.name as student_name',
			'teachers.name as teacher_name',
			'student_id', 'teacher_id'
			]);
		$this->db->join('students', 'structures.member_id = students.student_id', 'left outer');
		$this->db->join('teachers', 'structures.member_id = teachers.teacher_id', 'left outer');
		return $this->dbGetLocalized('structures',  ['structure_id', 'member_id'], ['structures.structure_id' => $id]);
	}

	function getCampusDatabase($id){
	return (object)[
		'campus' => $this->dbGetLocalized('campus', ['campus_id'], ['campus.campus_id' => $id])->result_array()[0],
		'departments' => $this->dbGetLocalized('departments', ['department_id'])->result_array(),
		'organizations' => $this->dbGetLocalized('organizations', ['organization_id'], ['organization_parent' => $id])->result_array(),
		'stats' => (object)[
			'students' => $this->db->count_all_results("students"),
			'alumni' => $this->db->count_all_results("student_alumni"),
			'teachers' => $this->db->count_all_results("teachers"),
			'departments' => $this->db->count_all_results("departments"),
			'programs' => $this->db->count_all_results("programs"),
			'organizations' => $this->db->count_all_results("organizations")
		],
		'structure' => $this->dbGetStructureData($id)->result_array()
		];
	}

  function getDepartmentDatabase($id){
	return (object)[
		'department' => $this->dbGetLocalized('departments', ['department_id'], ['departments.department_id' => $id])->result_array()[0],
		'programs' => $this->dbGetLocalized('programs', ['program_id'], ['department_id' => $id])->result_array(),
		'organizations' => $this->dbGetLocalized('organizations', ['organization_id'], ['organization_parent' => $id])->result_array(),
		'stats' => (object)[
			'programs' => $this->db->where( ["department_id" => $id])->count_all_results("programs"),
			'students' => $this->db->join('programs', 'programs.program_id = students.program_id')
						->where( ["department_id" => $id])->count_all_results("students"),
			'alumni' => $this->db
						->join('students', 'student_alumni.student_id = students.student_id')
						->join('programs', 'programs.program_id = students.program_id')
						->where( ["department_id" => $id])->count_all_results("student_alumni"),
			'teachers' => $this->db->join('programs', 'programs.program_id = teachers.program_id')
						->where( ["department_id" => $id])->count_all_results("teachers")
		],
		'structure' => $this->dbGetStructureData($id)->result_array()
	];
  }

  function getProgramDatabase($id){
	return (object)[
		'program' => $this->dbGetLocalized('programs', ['program_id'], ['programs.program_id' => $id])->result_array()[0],
		'organizations' => $this->dbGetLocalized('organizations', ['organization_id'], ['organization_parent' => $id])->result_array(),
		'stats' => (object)[
			'students' => $this->db->where( ["program_id" => $id])->count_all_results("students"),
			'alumni' => $this->db->join('students', 'student_alumni.student_id = students.student_id')
						->where( ["program_id" => $id])->count_all_results("student_alumni"),
			'teachers' => $this->db->where( ["program_id" => $id])->count_all_results("teachers")
		],
		'structure' => $this->dbGetStructureData($id)->result_array()
	];
  }

  function getStudentDatabase($id){
	$this->db->select([
		'localization__programs.name as program_name',
		'localization__departments.name as department_name',
		'programs.program_id',
		'programs.department_id',
		'students.student_id',
		'students.name',
		'students.program_type',
		'EXTRACT(YEAR from students.entry_date) as entry_year',
		'(YEAR(CURRENT_TIMESTAMP) - YEAR(students.entry_date)) * 2 - 1 + (3 - FLOOR(MONTH(CURRENT_TIMESTAMP) / 6)) as semester'
		]);
	$this->db->join("programs", 'programs.program_id = students.program_id');
	$this->db->join("localization__departments", 'localization__departments.department_id = programs.department_id');
	$this->db->join("localization__programs", 'localization__programs.program_id = students.program_id');
	$this->db->where("localization__programs.lang = '$this->lang'");
	$this->db->where("localization__departments.lang = '$this->lang'");
	$this->db->where(['students.student_id' => $id]);
	return (object)[
		'student' => $this->db->get('students', 1)->result_array()[0]
	];
  }

  function getTeacherDatabase($id){
	$this->db->select([
		'localization__programs.name as program_name',
		'localization__departments.name as department_name',
		'programs.program_id',
		'programs.department_id',
		'teachers.teacher_id',
		'teachers.name',
		'teachers.employee_idn',
		'teachers.lecturer_nidn',
		]);
	$this->db->join("programs", 'programs.program_id = teachers.program_id');
	$this->db->join("localization__departments", 'localization__departments.department_id = programs.department_id');
	$this->db->join("localization__programs", 'localization__programs.program_id = teachers.program_id');
	$this->db->where("localization__programs.lang = '$this->lang'");
	$this->db->where("localization__departments.lang = '$this->lang'");
	$this->db->where(['teachers.teacher_id' => $id]);
	return (object)[
		'teacher' => $this->db->get('teachers', 1)->result_array()[0]
	];
  }

  function getOrganizationDatabase($id){

	return (object)[
		'organization' => $this->dbGetLocalized('organizations', ['organization_id'], ['organizations.organization_id' => $id])->result_array()[0],
		'stats' => (object)[
			'members' => $this->db->where( ["organization_id" => $id])->count_all_results("organization_members"),
			'alumni' => $this->db->join('organization_members', 'student_alumni.student_id = organization_members.member_id')
						->where( ["organization_id" => $id])->count_all_results("student_alumni"),
			'committees' => $this->db->where( ["structure_id" => $id])->count_all_results("structures")
		],
		'structure' => $this->dbGetStructureData($id)->result_array()
	];
  }

  function getTeacherList($scope, $scope_type, $offset = 0, $limit = 0) {

	switch ($scope_type) {
		case 'd':
			$this->db->join('programs', 'programs.program_id = teachers.program_id');
			$this->db->where(['department_id' => $scope]);
			break;
		case 'p':
			$this->db->where(['program_id' => $scope]);
			break;
	}

	$count = $this->db->count_all_results('teachers', FALSE);

	return (object)[
		'teachers' => $this->db->get('', $limit, $offset)->result_array(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];

  }


  function getStudentList($scope, $scope_type, $offset = 0, $limit = 0) {

	switch ($scope_type) {
		case 'd':
			$this->db->join('programs', 'programs.program_id = students.program_id');
			$this->db->where(['department_id' => $scope]);
			break;
		case 'p':
			$this->db->where(['program_id' => $scope]);
			break;
		case 'c':
		default:
			# code...
			break;
	}

	$count = $this->db->count_all_results('students', FALSE);

	return (object)[
		'students' => $this->db->get('', $limit, $offset)->result_array(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];

  }


  function getOrganizationList($scope, $scope_type, $offset = 0, $limit = 0) {

	switch ($scope_type) {
		case 'd':
			$this->db->join('programs', 'programs.program_id = organizations.organization_parent');
			$this->db->where(['department_id' => $scope]);
			break;
		case 'p':
			$this->db->where(['organization_parent' => $scope]);
			break;
	}

	$count = $this->db->count_all_results('organizations', FALSE);

	return (object)[
		'organizations' => $this->db->get('', $limit, $offset)->result_array(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];

  }
}