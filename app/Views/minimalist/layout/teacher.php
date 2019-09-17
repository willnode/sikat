
<?= view('minimalist/widgets/hero-member', [
	'id' => $teacher->teacher_id,
	'name' => $teacher->name
	])?>

<div class="container">

<div class="box-section p-2">
	Dosen <a href="<?=base_url($teacher->program_id)?>"><?=$teacher->program_title?></a>, <a href="<?=base_url($teacher->department_id)?>"><?=$teacher->department_title?></a><br>
	NIP. <?=$teacher->employee_idn?><br>
	NIDN. <?=$teacher->lecturer_nidn?><br>
</div>

<?= view('minimalist/widgets/organization'); ?>

<?= view('minimalist/widgets/titles'); ?>

<?= view('minimalist/widgets/feed'); ?>
</div>