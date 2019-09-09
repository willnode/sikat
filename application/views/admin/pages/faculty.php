<?php

if ($login->type == 'campus' ) {
	$this->load->view('admin/listing', ['items' => $list->faculties, 'item_id' => 'faculty_id', 'item_title' => 'title']);
}
