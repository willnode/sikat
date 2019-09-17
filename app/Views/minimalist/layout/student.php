
<?= view('minimalist/widgets/hero-member', [
	'id' => $student->student_id,
	'name' => $student->name
	])?>

<div class="container">
<div class="box-section p-2">
	Jenjang <?=lang($student->program_type)?><br>
	Prodi <a href="<?=base_url($student->program_id)?>"><?=$student->program_title?></a><br>
	Jurusan <a href="<?=base_url($student->department_id)?>"><?=$student->department_title?></a><br>
	Fakultas <a href="<?=base_url($student->faculty_id)?>"><?=$student->faculty_title?></a><br>
	Semester <?=$student->semester?><br>
	Angkatan <?=$student->entry_year?><br>
</div>


<?= view('minimalist/widgets/organization'); ?>

<?= view('minimalist/widgets/titles'); ?>

<?= view('minimalist/widgets/feed'); ?>
</div>