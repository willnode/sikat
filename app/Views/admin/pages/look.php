<?php

echo validation_errors();

echo form_open_multipart('panel/look');

# ---------

?><div class="card"><div class="card-header">Media</div><div class="card-body"><?php

if (!$login->is_member) {
	input_img('pic_about', 'files/backgrounds', $login->username.".jpg", 'Gambar Sampul');
	input_img('pic_about', 'files/logos', $login->username.".png", 'Logo');

} else {
	input_img('pic_about', 'files/profiles', $login->username.".jpg", 'Foto Profil');
}

?></div></div><?php

# ----------

if (!$login->is_member) {
?><div class="card"><div class="card-header">Teks</div><div class="card-body"><?php
foreach ($localizations as $loc) {
	echo "<h3>$loc->lang</h3>";
	input_text('name', $loc->title, 'Judul');
	input_area('name', $loc->summary, 'Teks');
}
?></div></div><?php
}

# ------------

text_input('', 'Submit', '', 'submit');


echo form_close();


