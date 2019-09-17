<?php

if (!$login->is_member) {

	view('admin/listing', ['items' => $list->teachers, 'item_id' => 'teacher_id', 'item_title' => 'name']);

}