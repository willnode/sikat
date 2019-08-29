
<div class="cv">
	<div class="d-flex flex-row align-items-center">
	<div class="campus-logo">
	<?php if (is_file("./files/profiles/{$student['student_id']}.jpg")) : ?>
	<img class="w-100" alt="Photo" src="<?=base_url("./files/profiles/{$student['student_id']}.jpg")?>">
	<?php endif ?>
	</div>
	<div>
	<h2><?=$student["name"]?></h2>
	<?=$student["student_id"]?>
	</div>
	</div>
</div>
