<?php
# Nama, Bio, NIP, NIDN,

echo validation_errors();

echo form_open_multipart('panel/look');

if ($login->type == 's') {
	input_text('name', $biodata->name, 'Nama');
	input_option('status', $biodata->status, 'Status', ['y' => 'Aktif', 'n' => 'Nonaktif', 'a' => 'Alumni']);
	input_option('gender', $biodata->gender, 'Jenis Kelamin', ['' => 'Tidak Disebutkan', 'm' => 'Laki-Laki', 'f' => 'Perempuan']);
	input_option('program_id', $biodata->program_id, 'Jenis Kelamin', ['' => 'Tidak Disebutkan', 'm' => 'Laki-Laki', 'f' => 'Perempuan']);
	input_text('student_index', $biodata->student_index, 'NIM');
	input_text('almamater', $biodata->work_status, 'Almamater');
	input_area('address', $biodata->address, 'Alamat');
}

if ($login->type == 't') {
	input_text('name', $biodata->name, 'Nama');
	input_option('program_id', $biodata->program_id, 'Program Studi', $this->Search_model->listAllProgramOptions());
	input_option('gender', $biodata->gender, 'Jenis Kelamin', ['' => 'Tidak Disebutkan', 'm' => 'Laki-Laki', 'f' => 'Perempuan']);
	input_area('address', $biodata->address, 'Alamat');
}


input_text('', 'Submit', '', 'submit');

echo form_close();
