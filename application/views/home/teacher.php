
<div class="cv p-2">
	<div class="d-flex flex-row align-items-center">
	<div class="campus-photo">Foto</div>
	<div>
	<h2><?=$teacher["name"]?></h2>
	<?=$teacher["teacher_id"]?><br>
	</div>
	</div>
</div>


<div class="box-section p-2">
	Dosen <a href="<?=base_url($teacher["program_id"])?>"><?=$teacher["program_name"]?></a>, <a href="<?=base_url($teacher["department_id"])?>"><?=$teacher["department_name"]?></a><br>
	NIP. <?=$teacher["employee_idn"]?><br>
	NIDN. <?=$teacher["lecturer_nidn"]?><br>
</div>

