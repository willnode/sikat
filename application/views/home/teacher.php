
<?php $this->load->view('components/campus-profile-hero', [
	'id' => $teacher->teacher_id,
	'name' => $teacher->name
	])?>


<div class="box-section p-2">
	Dosen <a href="<?=base_url($teacher->program_id)?>"><?=$teacher->program_title?></a>, <a href="<?=base_url($teacher->department_id)?>"><?=$teacher->department_title?></a><br>
	NIP. <?=$teacher->employee_idn?><br>
	NIDN. <?=$teacher->lecturer_nidn?><br>
</div>


<?php $this->load->view('components/campus-feed', ['feed' => $feed]); ?>
