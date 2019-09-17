<?php

if (!$login->is_member) {

	view('admin/listing', ['items' => $list->students, 'item_id' => 'student_id', 'item_title' => 'name']);

}
