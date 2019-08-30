
<div class="cv p-2">
	<div class="d-flex flex-row align-items-center">
	<div class="campus-photo">
	<?php if (is_file("./files/profiles/{$student['student_id']}.jpg")) : ?>
	<img class="w-100" alt="Photo" src="<?=base_url("./files/profiles/{$student['student_id']}.jpg")?>">
	<?php endif ?>
	</div>
	<div class="ml-3">
	<h2><?=$student["name"]?></h2>
	<?=$student["student_id"]?>
	</div>
	</div>
</div>


<div class="box-section p-2">
	Jenjang <?=lang($student["program_type"])?><br>
	Prodi <a href="<?=base_url($student["program_id"])?>"><?=$student["program_name"]?></a><br>
	Fakultas <a href="<?=base_url($student["department_id"])?>"><?=$student["department_name"]?></a><br>
	Semester <?=$student["semester"]?><br>
	Angkatan <?=$student["entry_year"]?><br>
</div>

