<?php

if (!$login->is_member) {

	$this->load->view('admin/listing', ['items' => $list->teachers, 'item_id' => 'teacher_id', 'item_title' => 'name']);

}