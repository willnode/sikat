<?php

if ($login->type == 'campus' || $login->type == 'faculty' || $login->type == 'department' ) {
	$this->load->view('admin/listing', ['items' => $list->programs, 'item_id' => 'program_id', 'item_title' => 'title']);
}
