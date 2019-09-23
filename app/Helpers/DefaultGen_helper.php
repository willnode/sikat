<?php

function placeholder($text) {
	$text = substr($text, 0, strpos($text, '.'));
	$text = strtoupper($text);
	return "$text";
}

function campus_logo_md($id, $margin = 'mb-2') {
	if (is_file("./files/logos/$id.png")) {
	return '<div class="campus-logo-md '.$margin.' flex-shrink-0">
				<img class="w-100" alt="Logo" src="'.base_url("files/logos/$id.png").'">
			</div>';
	} else {
	return '<div class="campus-logo-md '.$margin.' flex-shrink-0 campus-placeholder">
				'.placeholder($id).'
			</div>';
	}
}

function campus_photo($id, $margin = 'mb-2') {
	$photo = "./files/profiles/$id.jpg";
	if (is_file($photo)) {
	return '<div class="campus-photo '.$margin.'">
				<img class="w-100" alt="Logo" src="'.base_url($photo).'">
			</div>';
	} else {
		return '<div class="campus-photo campus-placeholder '.$margin.'">
					<img class="w-100" alt="Logo" src="'.base_url('assets/images/user.png').'">
				</div>';
	}
}