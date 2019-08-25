
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
		<div class="text-center">
			<div class="h2">B</div>
			<div>Akreditasi</div>
		</div>
		<div class="text-center">
			<div class="h2">1</div>
			<div>Dosen</div>
		</div>
		<div class="text-center">
			<div class="h2">1</div>
			<div>Mahasiswa</div>
		</div>
		<div class="text-center">
			<div class="h2">1</div>
			<div>Alumni</div>
		</div>
		<div class="text-center">
			<div class="h2">17</div>
			<div>Program Study</div>
		</div>
		<div class="text-center">
			<div class="h2">20</div>
			<div>Organisasi</div>
		</div>
	</div>
</div>

<div class="box-section">
	<div class="container-label">Jabatan</div>
</div>

<div class="box-section">
	<div class="container-label">Organisasi</div>
</div>