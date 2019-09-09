<?php

class Search_model extends CI_Model {

	function __construct()
	{
		$this->lang = ['english' => 'en', 'indonesian' => 'id'][$this->session->userdata('site_lang') ?: $this->config->config['language']];
	}

	var $lang = 'id';

  function getTeacherList($scope, $scope_type, $query, $offset = 0, $limit = 0) {

	switch ($scope_type) {
		case 'faculty':
			$this->db->join('programs', 'programs.program_id = teachers.program_id');
			$this->db->join('departments', 'departments.department_id = programs.department_id');
			$this->db->where(['faculty_id' => $scope]);
			break;
		case 'department':
			$this->db->join('programs', 'programs.program_id = teachers.program_id');
			$this->db->where(['department_id' => $scope]);
			break;
		case 'program':
			$this->db->where(['program_id' => $scope]);
			break;
	}

	if ($query)	$this->db->like('name', $query, 'both');

	$count = $this->db->count_all_results('teachers', FALSE);

	return (object)[
		'teachers' => $this->db->get('', $limit, $offset)->result(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];

  }


  function getStudentList($scope, $scope_type, $query, $offset = 0, $limit = 0) {

	switch ($scope_type) {
		case 'department':
			$this->db->join('programs', 'programs.program_id = students.program_id');
			$this->db->where(['department_id' => $scope]);
			break;
		case 'program':
			$this->db->where(['program_id' => $scope]);
			break;
		default:
			# code...
			break;
	}

	$this->db->where(['status' => 'active']);

	if ($query)	$this->db->like('name', $query, 'both');

	$count = $this->db->count_all_results('students', FALSE);

	return (object)[
		'students' => $this->db->get('', $limit, $offset)->result(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];
  }

  function getAlumniList($scope, $scope_type, $query, $offset = 0, $limit = 0) {

	switch ($scope_type) {
		case 'department':
			$this->db->join('programs', 'programs.program_id = students.program_id');
			$this->db->where(['department_id' => $scope]);
			break;
		case 'program':
			$this->db->where(['program_id' => $scope]);
			break;
		case 'campus':
		default:
			# code...
			break;
	}

	if ($query)	$this->db->like('name', $query, 'both');

	$this->db->where(['status' => 'alumni']);

	$count = $this->db->count_all_results('students', FALSE);

	return (object)[
		'students' => $this->db->get('', $limit, $offset)->result(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];
  }

  function getOrganizationList($scope, $scope_type, $query, $offset = 0, $limit = 0) {

	switch ($scope_type) {
		case 'faculty':
			$this->db->join('programs', 'programs.program_id = organizations.organization_parent');
			$this->db->join('departments', 'departments.department_id = programs.department_id');
			$this->db->where(['department_id' => $scope]);
			break;
		case 'department':
			$this->db->join('programs', 'programs.program_id = organizations.organization_parent');
			$this->db->where(['department_id' => $scope]);
			break;
		case 'program':
			$this->db->where(['organization_parent' => $scope]);
			break;
	}

	if ($query)	$this->db->like('slug', $query, 'both');

	$count = $this->db->count_all_results('organizations', FALSE);

	return (object)[
		'organizations' => $this->db->get('', $limit, $offset)->result(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];
  }


  function getFacultyList($scope, $scope_type, $query, $offset = 0, $limit = 0) {

	$this->db->join("account_localizations",
		"account_localizations.account_id = faculties.faculty_id".
		" AND account_localizations.lang = '$this->lang'", 'left outer');

	if ($query)	$this->db->like('title', $query, 'both');

	$count = $this->db->count_all_results('faculties', FALSE);

	return (object)[
		'faculties' =>  $this->db->get('', $limit, $offset)->result(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];
  }

  function getDepartmentList($scope, $scope_type, $query, $offset = 0, $limit = 0) {

	$this->db->join("account_localizations",
		"account_localizations.account_id = departments.department_id".
		" AND account_localizations.lang = '$this->lang'", 'left outer');

	if ($query)	$this->db->like('title', $query, 'both');

	$count = $this->db->count_all_results('departments', FALSE);

	return (object)[
		'departments' =>  $this->db->get('', $limit, $offset)->result(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];
  }

  function getProgramList($scope, $scope_type, $query, $offset = 0, $limit = 0) {

	switch ($scope_type) {
		case 'faculty':
			$this->db->join('deparments', 'deparments.department_id = programs.department_id');
			$this->db->where(['faculty_id' => $scope]);
			break;
		case 'department':
			$this->db->where(['department_id' => $scope]);
			break;
	}

	$this->db->join("account_localizations",
		"account_localizations.account_id = programs.program_id".
		" AND account_localizations.lang = '$this->lang'", 'left outer');

	if ($query)	$this->db->like('title', $query, 'both');

	$count = $this->db->count_all_results('programs', FALSE);

	return (object)[
		'programs' =>  $this->db->get('', $limit, $offset)->result(),
		'count' => $count,
		'pagination' => $limit,
		'scope' => $scope
	];
  }

  function listAllProgramOptions()
  {
	  $data = $this->db->select(['program_id', 'title'])
	  	->join('account_localizations', 'program_id = account_id')->order_by('title')->get('programs');
	  foreach ($data->result() as $program) {
		  $list[$program->program_id] = $program->title;
	  }
	  return $list;
  }

  function listAllWeblinkOptions()
  {
	  $data = $this->db->get('op_weblinks');
	  foreach ($data->result() as $weblink) {
		  $list[$weblink->weblink] = $weblink->weblink;
	  }
	  return $list;
  }
}