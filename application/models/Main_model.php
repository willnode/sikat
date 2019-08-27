<?php

class Main_model extends CI_Model {

	var $lang = 'id';

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

	function getCampusDatabase(){

	return (object)[
		'campus' => $this->db->get_where("localization__campus", "lang = '$this->lang'")->result_array()[0],
		'faculties' => $this->dbGetLocalized('faculties', ['faculty_id'])->result_array()
	];
	}

  function getFacultyDatabase($id){
	return (object)[
		'faculty' => $this->dbGetLocalized('faculties', ['faculty_id'], ['faculties.faculty_id' => $id])->result_array()[0],
		'programs' => $this->dbGetLocalized('programs', ['program_id'], ['faculty_id' => $id])->result_array()
		];
  }

  function getProgramDatabase($id){
	return (object)[
		'program' => $this->dbGetLocalized('programs', ['program_id'], ['programs.program_id' => $id])->result_array()[0],
		'stats' => (object)[
			'students' => $this->db->get_where("students", ["program_id" => $id])->num_rows()
		]
	];
  }


  function getStudentDatabase($id){
	return (object)[
		'student' => $this->db->get_where("students", ["student_id" => $id])->result_array()[0]
	];
  }

  function getLecturerDatabase($id){
	return (object)[
		'lecturer' => $this->db->get_where("lecturers", ["lecturer_id" => $id])->result_array()[0]
	];
  }

  function getOrganizationDatabase($id){
	return (object)[
		'organization' => $this->dbGetLocalized('organizations', ['org_id'], ['organizations.org_id' => $id])->result_array()[0]
	];
  }

}