<?php

if ($login->type == 'campus' || $login->type == 'faculty' ) {
	view('admin/listing', ['items' => $list->departments, 'item_id' => 'department_id', 'item_title' => 'title']);
}
