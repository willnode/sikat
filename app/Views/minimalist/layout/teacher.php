
<?= view('minimalist/widgets/hero-member', [
	'id' => $teacher->teacher_id,
	'name' => $teacher->name
	])?>

<div class="container">

<div class="box-section p-2">
	<table class="table table-borderless">
		<tr>
		<th>Status</th>
		<td><b><?=esc(lang("Campus.$teacher->status"))?></b></td>
		</tr>
		<tr>
		<th>Pengajar dalam</th>
		<td>
			Program Studi <a href="<?=esc(base_url($teacher->program_id))?>"><?=esc($teacher->program_title)?></a>,<br>
			Jurusan <a href="<?=esc(base_url($teacher->department_id))?>"><?=esc($teacher->department_title)?></a>,<br>
			Fakultas <a href="<?=esc(base_url($teacher->faculty_id))?>"><?=esc($teacher->faculty_title)?></a><br>
		</td>
		</tr>
		<tr>
		<th>NIP</th>
		<td><?=esc($teacher->employee_idn)?></td>
		</tr>
		<tr>
		<th>NIDN</th>
		<td><?=esc($teacher->lecturer_nidn)?></td>
		</tr>
		<th>Almamater</th>
		<td><?=esc($teacher->almamater)?></td>
		</tr>
		<tr>
		<th>Alamat</th>
		<td><?=esc($teacher->address)?></td>
		</tr>
	</table>
</div>

<?= view('minimalist/widgets/titles'); ?>

<?= view('minimalist/widgets/publications'); ?>

<?= view('minimalist/widgets/feed'); ?>
</div>