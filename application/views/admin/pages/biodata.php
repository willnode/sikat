<?php
# Nama, Bio, NIP, NIDN,

echo validation_errors();

echo form_open_multipart('panel/look');

$student_status = ['active' => 'Aktif', 'off' => 'Nonaktif', 'alumni' => 'Alumni'];
$teacher_status = ['professor' => 'Guru Besar', 'lecturer' => 'Dosen', 'educator' => 'Tenaga Pendidik', 'assistant' => 'Asisten', 'off' => 'Pengajar Nonaktif'];
$genders = ['' => 'Tidak Disebutkan', 'men' => 'Laki-laki', 'women' => 'Perempuan'];
$accreditation = ['' => 'Tidak Ada/Tidak Disebutkan', 'A' => 'A', 'B' => 'B', 'C' => 'C'];

if ($login->type == 'student') {
	input_text('name', $biodata->name, 'Nama');
	input_option('status', $biodata->status, 'Status', $student_status);
	input_option('gender', $biodata->gender, 'Jenis Kelamin', $genders);
	input_option('program_id', $biodata->program_id, 'Program Studi', $this->Search_model->listAllProgramOptions());
	input_text('student_index', $biodata->student_index, 'NIM');
	input_text('almamater', $biodata->work_status, 'Almamater');
	input_area('address', $biodata->address, 'Alamat');
}

if ($login->type == 'teacher') {
	input_text('name', $biodata->name, 'Nama');
	input_option('status', $biodata->status, 'Status', $teacher_status);
	input_option('program_id', $biodata->program_id, 'Program Studi', $this->Search_model->listAllProgramOptions());
	input_option('gender', $biodata->gender, 'Jenis Kelamin', $genders);
	input_area('address', $biodata->address, 'Alamat');
}

if ($login->type == 'campus') {
	input_option('accreditation', $biodata->accreditation, 'Akreditasi', $accreditation);
	input_area('address', $biodata->address, 'Alamat');
}

if ($login->type == 'department') {
	input_area('address', $biodata->address, 'Alamat');
}

if ($login->type == 'program') {
	input_option('accreditation', $biodata->accreditation, 'Akreditasi', $accreditation);
}


input_text('', 'Submit', '', 'submit');

echo form_close();
