<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class MainModel {

	protected $db;
	var $lang = 'id';

	public function __construct(ConnectionInterface &$db)
	{
			$this->db =& $db;
			$this->lang = session('site_lang') ?: (new \Config\App())->defaultLocale;
	}

	function getAccountInfo($id)
	{
		$data = $this->db->table('accounts')->getWhere(['account_id' => $id])->getRow();
		if ($data) {
			return $data;
		}
		else throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	}

	function dbGetLocalized($table, $join, $where = [])
	{
		return $this->db->table($table)->join("account_localizations",
			"account_localizations.account_id = $table.$join".
			" AND account_localizations.lang = '$this->lang'",
			'left outer')->where($where)->get();
	}

	function dbGetOrganizationsData($id)
	{
		return (object)[
			'community' => $this->dbGetLocalized('organizations', 'organization_id', ['organization_parent' => $id])->getResult(),
			'facility' => $this->dbGetLocalized('facilities', 'facility_id', ['facility_parent' => $id])->getResult(),
			'services' => $this->dbGetLocalized('services', 'service_id', ['service_parent' => $id])->getResult(),
		];
	}

	function dbGetStructureData($id)
	{
		return $this->db->table('structures')->select([
				'students.name as student_name',
				'teachers.name as teacher_name',
				'student_id', 'teacher_id', 'title'])
			->join("structure_members", "structure_members.cabinet_id = structures.cabinet_id")
			->join('students', 'structure_members.member_id = students.student_id', 'left outer')
			->join('teachers', 'structure_members.member_id = teachers.teacher_id', 'left outer')
			->join("structure_localizations",
				"structure_localizations.cabinet_id = structures.cabinet_id AND ".
				"structure_localizations.member_id = structure_members.member_id AND ".
				"structure_localizations.lang = '$this->lang'"
				, 'left outer')
			->where(['structures.structure_id' => $id, 'category' => 0, 'end_date' => '0000-00-00'])
			->orderBy('ordering')
			->get();
	}

	function dbGetFeedData($id)
	{
		return $this->db->table('account_feeds')->getWhere(['account_id' => $id, 'lang' => $this->lang], 1)->getRow();
	}

	function dbGetWeblinkData($id)
	{
		return $this->db->table('account_weblinks')
			->join('op_weblinks', 'op_weblinks.weblink = web_type')
			->getWhere(['account_id' => $id])->getResult();
	}


	function dbGetWebpageData($id)
	{
		return $this->db->table('account_webpages')->getWhere(['account_id' => $id, 'lang' => $this->lang])->getResult();
	}

	function getTheme(){
		return 'minimalist';
	}

	function getDatabase($id, $type){
		return $this->{'get'.ucfirst($type).'Database'}($id);
	}

	function getCampusDatabase($id){
		$stats = (object)[
			'students' => $this->db->table("students")->where('status', 'active')->countAllResults(),
			'alumni' => $this->db->table("students")->where('status', 'alumni')->countAllResults(),
			'teachers' => $this->db->table("teachers")->countAllResults(),
			'faculties' => $this->db->table("faculties")->countAllResults(),
			'departments' => $this->db->table("departments")->countAllResults(),
			'programs' => $this->db->table("programs")->countAllResults(),
			'organizations' => $this->db->table("organizations")->countAllResults(),
			'services' => $this->db->table("services")->countAllResults(),
			'facilities' => $this->db->table("facilities")->countAllResults(),
		];
		$unit = $this->dbGetLocalized('campus', 'campus_id', ['campus.campus_id' => $id])->getRow();
		return [
			'id' => $id,
			'title' => $unit->title,
			'theme' => $this->getTheme(),
			'unit' => $unit,
			'subunits' => $this->dbGetLocalized('faculties', 'faculty_id')->getResult(),
			'organizations' => $this->dbGetOrganizationsData($id),
			'stats' => $stats,
			'structure' => $this->dbGetStructureData($id)->getResult(),
			'feed' => $this->dbGetFeedData($id),
			'weblinks' => $this->dbGetWeblinkData($id),
			'pages' => $this->db->table('account_webpages')->getWhere(['account_id' => $id, 'lang' => $this->lang])->getResult(),
		];
	}

	function getFacultyDatabase($id){
		$stats = (object)[
			'departments' => $this->db->table("departments")->where( ["faculty_id" => $id])->countAllResults(),
			'programs' => $this->db->table("programs")
						->join('departments', 'departments.department_id = programs.department_id')
						->where( ["faculty_id" => $id])->countAllResults(),
			'students' => $this->db->table("students")
						->join('programs', 'programs.program_id = students.program_id')
						->join('departments', 'departments.department_id = programs.department_id')
						->where( ["faculty_id" => $id, "status" => 'active'])->countAllResults(),
			'alumni' => $this->db->table("students")
						->join('programs', 'programs.program_id = students.program_id')
						->join('departments', 'departments.department_id = programs.department_id')
						->where( ["faculty_id" => $id, "status" => 'alumni'])->countAllResults(),
			'teachers' => $this->db->table("teachers")
						->join('programs', 'programs.program_id = teachers.program_id')
						->join('departments', 'departments.department_id = programs.department_id')
						->where( ["faculty_id" => $id])->countAllResults()
		];
		$unit = $this->dbGetLocalized('faculties', 'faculty_id', ['faculties.faculty_id' => $id])->getRow();
		return [
			'id' => $id,
			'title' => $unit->title,
			'theme' => $this->getTheme(),
			'unit' => $unit,
			'subunits' => $this->dbGetLocalized('departments', 'department_id', ['faculty_id' => $id])->getResult(),
			'organizations' => $this->dbGetOrganizationsData($id),
			'stats' => $stats,
			'structure' => $this->dbGetStructureData($id)->getResult(),
			'feed' => $this->dbGetFeedData($id),
			'weblinks' => $this->dbGetWeblinkData($id),
		];
	  }

  	function getDepartmentDatabase($id){
		$stats =  (object)[
			'programs' => $this->db->table("programs")
						->where( ["department_id" => $id])->countAllResults(),
			'students' => $this->db->table("students")
						->join('programs', 'programs.program_id = students.program_id')
						->where( ["department_id" => $id, 'status' => 'active'])->countAllResults(),
			'alumni' => $this->db->table("students")
						->join('programs', 'programs.program_id = students.program_id')
						->where( ["department_id" => $id, 'status' => 'alumni'])->countAllResults(),
			'teachers' => $this->db->table("teachers")
						->join('programs', 'programs.program_id = teachers.program_id')
						->where( ["department_id" => $id])->countAllResults()
		];
		$unit = $this->dbGetLocalized('departments', 'department_id', ['departments.department_id' => $id])->getRow();

		return [
			'id' => $id,
			'title' => $unit->title,
			'theme' => $this->getTheme(),
			'unit' => $unit,
			'subunits' => $this->dbGetLocalized('programs', 'program_id', ['department_id' => $id])->getResult(),
			'organizations' => $this->dbGetOrganizationsData($id),
			'stats' => $stats,
			'structure' => $this->dbGetStructureData($id)->getResult(),
			'feed' => $this->dbGetFeedData($id),
			'weblinks' => $this->dbGetWeblinkData($id),
		];
  }

	function getProgramDatabase($id){
		$stats =  (object)[
			'students' => $this->db->table("students")->where( ["program_id" => $id])->countAllResults(),
			'alumni' => 0,//$this->db->join('students', 'student_alumni.student_id = students.student_id')
						//->where( ["program_id" => $id])->table("student_alumni")->countAllResults(),
			'teachers' => $this->db->table("teachers")->where( ["program_id" => $id])->countAllResults()
		];
		$unit = $this->dbGetLocalized('programs', 'program_id', ['programs.program_id' => $id])->getRow();
		return [
			'id' => $id,
			'title' => $unit->title,
			'theme' => $this->getTheme(),
			'unit' => $unit,
			'organizations' => $this->dbGetOrganizationsData($id),
			'stats' => $stats,
			'structure' => $this->dbGetStructureData($id)->getResult(),
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
	$student = $this->db->getWhere('students', ['students.student_id' => $id], 1)->getRow();
	$student->program_title = $this->db->select('title')->getWhere('account_localizations',
		['account_id' => $student->program_id, 'lang' => $this->lang], 1)->getRow()->title;
	$student->department_title = $this->db->select('title')->getWhere('account_localizations',
		['account_id' => $student->department_id, 'lang' => $this->lang], 1)->getRow()->title;
	$student->faculty_title = $this->db->select('title')->getWhere('account_localizations',
		['account_id' => $student->faculty_id, 'lang' => $this->lang], 1)->getRow()->title;
	return [
		'student' => $student,
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
		'organizations' => $this->db
			->join("organizations", 'organizations.organization_id = organization_members.organization_id')
			->getWhere('organization_members', ['member_id' => $id])->getResult(),
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
			->getWhere('structure_members', ['structure_members.member_id' => $id])->getResult(),
	];
  }

  function getTeacherDatabase($id){
	$teacher = $this->db->table('teachers')->select([
		'programs.program_id',
		'programs.department_id',
		'teachers.teacher_id',
		'teachers.name',
		'teachers.employee_idn',
		'teachers.lecturer_nidn',
		])
		->join("programs", 'programs.program_id = teachers.program_id')
		->getWhere(['teachers.teacher_id' => $id], 1)->getRow();
	$teacher->program_title = $this->db->table('account_localizations')->select('title')->getWhere(
		['account_id' => $teacher->program_id, 'lang' => $this->lang], 1)->getRow()->title ?: '';
	$teacher->department_title = $this->db->table('account_localizations')->select('title')->getWhere(
		['account_id' => $teacher->department_id, 'lang' => $this->lang], 1)->getRow()->title;
	return [
		'teacher' => $teacher,
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
		'organizations' => $this->db->table('organization_members')
			->join("organizations", 'organizations.organization_id = organization_members.organization_id')
			->getWhere(['member_id' => $id])->getResult(),
		'structures' => $this->db->table('structure_members')
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
			->getWhere(['structure_members.member_id' => $id])->getResult(),
	];
  }


  function getFacilityDatabase($id){
	$unit = $this->dbGetLocalized('facilities', 'facility_id', ['facilities.facility_id' => $id])->getRow();
	return [
		'id' => $id,
		'title' => $unit->title,
		'theme' => $this->getTheme(),
		'unit' => $unit,
		'slug' => $unit->slug,
		'structure' => $this->dbGetStructureData($id)->getResult(),
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
	];
  }

  function getOrganizationDatabase($id){
	$unit = $this->dbGetLocalized('organizations', 'organization_id', ['organizations.organization_id' => $id])->getRow();
	$stats = (object)[
		'members' => $this->db->table("organization_members")->where( ["organization_id" => $id])->countAllResults(),
		'alumni' => 0,
		'committees' => $this->db->table("structures")->where( ["structure_id" => $id])->countAllResults()
	];
	return [
		'id' => $id,
		'title' => $unit->title,
		'theme' => $this->getTheme(),
		'unit' => $unit,
		'slug' => $unit->slug,
		'stats' => $stats,
		'structure' => $this->dbGetStructureData($id)->getResult(),
		'feed' => $this->dbGetFeedData($id),
		'weblinks' => $this->dbGetWeblinkData($id),
	];
  }

}