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