
<div class="text-center">
	<h1><div class="campus-logo">Logo</div><?=$faculty["name"]?></h1>
</div>

<div class="container">
	<div class="container-label">Program Studi</div>
	<div class="campus-list">
		<?php foreach ($programs as $program) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url('program/'.$program["program_id"])?>">
		<?=$program["name"]?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>

<div class="container">
	<div class="container-label">Bio</div>
	<div class="campus-stat">
		<div>X Pengajar</div>
		<div>X Mahasiswa</div>
		<div>X Alumni</div>
		<div>X Program Studi</div>
	</div>
</div>

<div class="container">
	<div class="container-label">Jabatan</div>
</div>

<div class="container">
	<div class="container-label">Organisasi</div>
</div>