
<div class="text-center">
	<div>
		<h1><div class="campus-logo">
			<img class="w-100" alt="" src="<?=base_url('files/logos/campus.png')?>">
		</div> <?=$campus['name']?></h1>
	</div>
</div>

<div class="box-section">
	<div class="container-label">Fakultas</div>
	<div class="campus-list">
		<?php foreach ($faculties as $faculty) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url('faculty/'.$faculty['faculty_id'])?>">
			<?=$faculty['name']?>
			</a>
		</div>
		<?php endforeach ?>
	</div>
</div>

<div class="box-section">
	<div class="container-label">Bio</div>
	<div class="campus-stat">
		<div>Akreditasi X</div>
		<div>X Pengajar</div>
		<div>X Mahasiswa</div>
		<div>X Alumni</div>
		<div>X Program Studi</div>
		<div>X Organisasi</div>
	</div>
</div>

<div class="box-section">
	<div class="container-label">Jabatan</div>
</div>

<div class="box-section">
	<div class="container-label">Organisasi</div>
</div>