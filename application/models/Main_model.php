<?php

class Main_model extends CI_Model {

	function __construct()
	{
		$this->lang = ['english' => 'en', 'indonesian' => 'id'][$this->session->userdata('site_lang') ?: $this->config->config['language']];
	}

	var $lang = 'id';

	function getAccountInfo($id)
	{
		$data = $this->db->get_where('accounts', ['account_id' => $id]);
		if ($data->num_rows() == 0) show_404();
		return $data->row();
	}

	function dbGetLocalized($table, $join, $where = [])
	{
		$this->db->join("account_localizations",
			"account_localizations.account_id = $table.$join".
			" AND account_localizations.lang = '$this->lang'", 'left outer');
		$this->db->where($where);
		$this->db->from($table);
		//print($this->db->get_compiled_select('', FALSE));
		return $this->db->get();
	}

	function dbGetStructureData($id)
	{
		$this->db->select([
			//'localization__structures.title',
			'students.name as student_name',
			'teachers.name as teacher_name',
			'student_id', 'teacher_id', 'title'
			]);
		$this->db->join("structure_members", "structure_members.cabinet_id = structures.cabinet_id");
		$this->db->join('students', 'structure_members.member_id = students.student_id', 'left outer');
		$this->db->join('teachers', 'structure_members.member_id = teachers.teacher_id', 'left outer');
		$this->db->join("structure_localizations",
		"structure_localizations.cabinet_id = structures.cabinet_id AND ".
		"structure_localizations.member_id = structure_members.member_id AND ".
		"structure_localizations.lang = '$this->lang'"
		, 'left outer');
		$this->db->where(['structures.structure_id' => $id, 'category' => 0, 'end_date' => '0000-00-00']);
		$this->db->order_by('ordering');
		return $this->db->get('structures');
	}

	function dbGetFeedData($id)
	{
		return $this->db->get_where('account_feeds', ['account_id' => $id, 'lang' => $this->lang], 1)->row();
	}

	function dbGetWeblinkData($id)
	{
		$this->db->join('op_weblinks', 'op_weblinks.weblink = web_type');
		return $this->db->get_where('account_weblinks', ['account_id' => $id])->result();
	}

	function getCampusDatabase($id){
	return (object)[
		'campus' => $this->dbGetLocalized('campus', 'campus_id', ['campus.campus_id' => $id])->row(),
		'faculties' => $this->dbGetLocalized('faculties', 'faculty_id')->result(),
		'organizations' => $this->dbGetLocalized('organizations', 'organization_id', ['organization_parent' => $id])->result(),
		'stats' => (object)[
			'students' => $this->db->where('status', 'active')->count_all_results("students"),
			'alumni' => $this->db->where('status', 'alumni')->count_all_results("students"),
			'teachers' => $this->db->count_all_results("teachers"),
			'faculties' => $this->db->count_all_results("faculties"),
			'departments' => $this->db->count_all_results("departments"),
			'programs' => $this->db->count_all_results("programs"),
			'organizations' => $this->db->count_all_results("organizations")
		],
		'structure' => $this->dbGetStructureData($id)->result(),
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
		];
	}

	function getFacultyDatabase($id){
		return (object)[
			'faculty' => $this->dbGetLocalized('faculties', 'faculty_id', ['faculties.faculty_id' => $id])->row(),
			'departments' => $this->dbGetLocalized('departments', 'department_id', ['faculty_id' => $id])->result(),
			'organizations' => $this->dbGetLocalized('organizations', 'organization_id', ['organization_parent' => $id])->result(),
			'stats' => (object)[
				'departments' => $this->db->where( ["faculty_id" => $id])->count_all_results("departments"),
				'programs' => $this->db->join('departments', 'departments.department_id = programs.department_id')
							->where( ["faculty_id" => $id])->count_all_results("programs"),
				'students' => $this->db->join('programs', 'programs.program_id = students.program_id')
							->join('departments', 'departments.department_id = programs.department_id')
							->where( ["faculty_id" => $id, "status" => 'active'])->count_all_results("students"),
				'alumni' => $this->db->join('programs', 'programs.program_id = students.program_id')
							->join('departments', 'departments.department_id = programs.department_id')
							->where( ["faculty_id" => $id, "status" => 'alumni'])->count_all_results("students"),
				'teachers' => $this->db->join('programs', 'programs.program_id = teachers.program_id')
							->join('departments', 'departments.department_id = programs.department_id')
							->where( ["faculty_id" => $id])->count_all_results("teachers")
			],
			'structure' => $this->dbGetStructureData($id)->result(),
			'feed' => $this->dbGetFeedData($id),
			'weblinks' => $this->dbGetWeblinkData($id),
		];
	  }

  function getDepartmentDatabase($id){
	return (object)[
		'department' => $this->dbGetLocalized('departments', 'department_id', ['departments.department_id' => $id])->row(),
		'programs' => $this->dbGetLocalized('programs', 'program_id', ['department_id' => $id])->result(),
		'organizations' => $this->dbGetLocalized('organizations', 'organization_id', ['organization_parent' => $id])->result(),
		'stats' => (object)[
			'programs' => $this->db->where( ["department_id" => $id])->count_all_results("programs"),
			'students' => $this->db->join('programs', 'programs.program_id = students.program_id')
						->where( ["department_id" => $id, 'status' => 'active'])->count_all_results("students"),
			'alumni' => $this->db->join('programs', 'programs.program_id = students.program_id')
			->where( ["department_id" => $id, 'status' => 'alumni'])->count_all_results("students"),
			'teachers' => $this->db->join('programs', 'programs.program_id = teachers.program_id')
						->where( ["department_id" => $id])->count_all_results("teachers")
		],
		'structure' => $this->dbGetStructureData($id)->result(),
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
	];
  }

  function getProgramDatabase($id){
	return (object)[
		'program' => $this->dbGetLocalized('programs', 'program_id', ['programs.program_id' => $id])->row(),
		'organizations' => $this->dbGetLocalized('organizations', 'organization_id', ['organization_parent' => $id])->result(),
		'stats' => (object)[
			'students' => $this->db->where( ["program_id" => $id])->count_all_results("students"),
			'alumni' => 0,//$this->db->join('students', 'student_alumni.student_id = students.student_id')
						//->where( ["program_id" => $id])->count_all_results("student_alumni"),
			'teachers' => $this->db->where( ["program_id" => $id])->count_all_results("teachers")
		],
		'structure' => $this->dbGetStructureData($id)->result(),
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
	];
  }

  function getStudentDatabase($id){
	$this->db->select([
		'departments.faculty_id',
		'programs.program_id',
		'programs.department_id',
		'students.student_id',
		'students.name',
		'programs.program_type',
		'EXTRACT(YEAR from students.entry_date) as entry_year',
		'(YEAR(CURRENT_TIMESTAMP) - YEAR(students.entry_date)) * 2 - 1 + (3 - FLOOR(MONTH(CURRENT_TIMESTAMP) / 6)) as semester'
		]);
	$this->db->join("programs", 'programs.program_id = students.program_id');
	$this->db->join("departments", 'departments.department_id = programs.department_id');
	$student = $this->db->get_where('students', ['students.student_id' => $id], 1)->row();
	$student->program_title = $this->db->select('title')->get_where('account_localizations',
		['account_id' => $student->program_id, 'lang' => $this->lang], 1)->row()->title;
	$student->department_title = $this->db->select('title')->get_where('account_localizations',
		['account_id' => $student->department_id, 'lang' => $this->lang], 1)->row()->title;
	$student->faculty_title = $this->db->select('title')->get_where('account_localizations',
		['account_id' => $student->faculty_id, 'lang' => $this->lang], 1)->row()->title;
	return (object)[
		'student' => $student,
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
		'organizations' => $this->db
			->join("organizations", 'organizations.organization_id = organization_members.organization_id')
			->get_where('organization_members', ['member_id' => $id])->result(),
		'structures' => $this->db
			->select([
				'account_localizations.title as organization_title',
				'structure_localizations.title as structure_title',
				'structures.structure_id',
				'structures.start_date',
				'structures.end_date',
				])
			->join("structures", "structures.cabinet_id = structure_members.cabinet_id")
			->join("account_localizations", "account_localizations.account_id = structures.structure_id AND account_localizations.lang = '$this->lang'", 'left outer')
			->join("structure_localizations", "structure_localizations.cabinet_id = structure_members.cabinet_id"
			." AND structure_localizations.member_id = structure_members.member_id"
			." AND structure_localizations.lang = '$this->lang'", 'left outer')
			->get_where('structure_members', ['structure_members.member_id' => $id])->result(),
	];
  }

  function getTeacherDatabase($id){
	$this->db->select([
		'programs.program_id',
		'programs.department_id',
		'teachers.teacher_id',
		'teachers.name',
		'teachers.employee_idn',
		'teachers.lecturer_nidn',
		]);
	$this->db->join("programs", 'programs.program_id = teachers.program_id');
	$teacher = $this->db->get_where('teachers', ['teachers.teacher_id' => $id], 1)->row();
	$teacher->program_title = $this->db->select('title')->get_where('account_localizations',
		['account_id' => $teacher->program_id, 'lang' => $this->lang], 1)->row()->title ?: '';
	$teacher->department_title = $this->db->select('title')->get_where('account_localizations',
		['account_id' => $teacher->department_id, 'lang' => $this->lang], 1)->row()->title;
	return (object)[
		'teacher' => $teacher,
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
		'organizations' => $this->db
			->join("organizations", 'organizations.organization_id = organization_members.organization_id')
			->get_where('organization_members', ['member_id' => $id])->result(),
		'structures' => $this->db
			->select([
				'account_localizations.title as organization_title',
				'structure_localizations.title as structure_title',
				'structures.structure_id',
				'structures.start_date',
				'structures.end_date',
				])
			->join("structures", "structures.cabinet_id = structure_members.cabinet_id")
			->join("account_localizations", "account_localizations.account_id = structures.structure_id AND account_localizations.lang = '$this->lang'", 'left outer')
			->join("structure_localizations", "structure_localizations.cabinet_id = structure_members.cabinet_id"
			." AND structure_localizations.member_id = structure_members.member_id"
			." AND structure_localizations.lang = '$this->lang'", 'left outer')
			->get_where('structure_members', ['structure_members.member_id' => $id])->result(),
	];
  }

  function getOrganizationDatabase($id){

	return (object)[
		'organization' => $this->dbGetLocalized('organizations', 'organization_id', ['organizations.organization_id' => $id])->row(),
		'stats' => (object)[
			'members' => $this->db->where( ["organization_id" => $id])->count_all_results("organization_members"),
			'alumni' => 0,
			'committees' => $this->db->where( ["structure_id" => $id])->count_all_results("structures")
		],
		'structure' => $this->dbGetStructureData($id)->result(),
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
	];
  }

}