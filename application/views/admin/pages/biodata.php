<?php
# Nama, Bio, NIP, NIDN,

echo validation_errors();

echo form_open_multipart('panel/look');

if ($login->type == 's') {
	input_text('name', $biodata->name, 'Nama');
}

input_text('', 'Submit', '', 'submit');

echo form_close();
