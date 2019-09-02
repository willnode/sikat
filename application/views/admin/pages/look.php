<?php

echo validation_errors();

echo form_open_multipart('panel/look');

if (!$login->is_member) {
	input_img('pic_about', 'files/backgrounds', $login->username.".jpg", 'Gambar Sampul');

	input_img('pic_about', 'files/logos', $login->username.".png", 'Logo');
} else {
	input_img('pic_about', 'files/profiles', $login->username.".jpg", 'Foto Profil');
}

input_text('', 'Submit', '', 'submit');

echo form_close();
