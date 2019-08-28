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
		$this->db->join("localization__$table", join('AND', array_map(function($key) use($table) {
			return "localization__$table.$key = $table.$key";
		}, $joins)));
		$this->db->where("localization__$table.lang = '$this->lang'");
		foreach ($where as $key => $value) {
			$this->db->where($key, $value);
		}
		return $this->db->get($table);
	}

	function getCampusDatabase($id){
	return (object)[
		'campus' => $this->dbGetLocalized('campus', ['campus_id'], ['campus.campus_id' => $id])->result_array()[0],
		'departments' => $this->dbGetLocalized('departments', ['department_id'])->result_array(),
		'organizations' => $this->dbGetLocalized('organizations', ['organization_id'], ['organization_parent' => $id])->result_array(),
		'stats' => (object)[
			'students' => $this->db->get("students")->num_rows(),
			'alumni' => $this->db->get("student_alumni")->num_rows(),
			'teachers' => $this->db->get("teachers")->num_rows(),
			'departments' => $this->db->get("departments")->num_rows(),
			'programs' => $this->db->get("programs")->num_rows(),
			'organizations' => $this->db->get("organizations")->num_rows()
		]
		];
	}

  function getDepartmentDatabase($id){
	return (object)[
		'department' => $this->dbGetLocalized('departments', ['department_id'], ['departments.department_id' => $id])->result_array()[0],
		'programs' => $this->dbGetLocalized('programs', ['program_id'], ['department_id' => $id])->result_array(),
		'organizations' => $this->dbGetLocalized('organizations', ['organization_id'], ['organization_parent' => $id])->result_array(),
		'stats' => (object)[
			'programs' => $this->db->get_where("programs", ["department_id" => $id])->num_rows(),
			'students' => $this->db->join('programs', 'programs.program_id = students.program_id')
						->get_where("students", ["department_id" => $id])->num_rows(),
			'alumni' => $this->db
						->join('students', 'student_alumni.student_id = students.student_id')
						->join('programs', 'programs.program_id = students.program_id')
						->get_where("student_alumni", ["department_id" => $id])->num_rows(),
			'teachers' => $this->db->join('programs', 'programs.program_id = teachers.program_id')
						->get_where("teachers", ["department_id" => $id])->num_rows()
		]
		];
  }

  function getProgramDatabase($id){
	return (object)[
		'program' => $this->dbGetLocalized('programs', ['program_id'], ['programs.program_id' => $id])->result_array()[0],
		'organizations' => $this->dbGetLocalized('organizations', ['organization_id'], ['organization_parent' => $id])->result_array(),
		'stats' => (object)[
			'students' => $this->db->get_where("students", ["program_id" => $id])->num_rows(),
			'alumni' => $this->db->join('students', 'student_alumni.student_id = students.student_id')
						->get_where("student_alumni", ["program_id" => $id])->num_rows(),
			'teachers' => $this->db->get_where("teachers", ["program_id" => $id])->num_rows()
		]
	];
  }

  function getStudentDatabase($id){
	return (object)[
		'student' => $this->db->get_where("students", ["student_id" => $id])->result_array()[0]
	];
  }

  function getTeacherDatabase($id){
	return (object)[
		'teacher' => $this->db->get_where("teachers", ["teacher_id" => $id])->result_array()[0]
	];
  }

  function getOrganizationDatabase($id){
	return (object)[
		'organization' => $this->dbGetLocalized('organizations', ['organization_id'], ['organizations.organization_id' => $id])->result_array()[0]
	];
  }

}