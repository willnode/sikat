<div class="text-center">
	<img height="200" alt="" src="<?=base_url($login->avatar)?>">
	<h1>Selamat Datang, <b><?=$login->username?></b></h1>
</div>

<div class="align-items-center d-flex flex-column">
	<h3 class="mt-3">Profil</h3>
	<div class="list-group list-group-horizontal">
		<a class="list-group-item list-group-item-action" href="look">
			Tampilan</a>
		<a class="list-group-item list-group-item-action" href="biodata">
			Biodata</a>
		<a class="list-group-item list-group-item-action" href="content">
			Konten</a>
		<a class="list-group-item list-group-item-action" href="structure">
			Struktur</a>
	</div>
	<h3 class="mt-3">Moderasi</h3>
	<div class="list-group list-group-horizontal">
		<a class="list-group-item list-group-item-action" href="review">
			Pending&nbsp;<span class="badge badge-info">0</span></a>
		<a class="list-group-item list-group-item-action" href="privacy">
			Visibilitas</a>
		<a class="list-group-item list-group-item-action" href="grants">
			Proteksi</a>
		<a class="list-group-item list-group-item-action" href="website">
			Website</a>
		<a class="list-group-item list-group-item-action" href="api">
			API</a>
		</div>
	<h3 class="mt-3">Database</h3>
	<div class="list-group list-group-horizontal">
		<?php if ($login->type == 'campus') : ?>
		<a class="list-group-item list-group-item-action" href="faculty">
			Fakultas</a>
		<?php endif ?>
		<?php if ($login->type == 'campus' || $login->type == 'faculty') : ?>
		<a class="list-group-item list-group-item-action" href="department">
			Jurusan</a>
		<?php endif ?>
		<?php if ($login->type == 'campus' || $login->type == 'faculty' || $login->type == 'department') : ?>
		<a class="list-group-item list-group-item-action" href="program">
			Prodi</a>
		<a class="list-group-item list-group-item-action" href="student">
			Mahasiswa</a>
		<a class="list-group-item list-group-item-action" href="teacher">
			Dosen</a>

		<?php endif ?>
	</div>
	<?php if ($login->type == 'campus' || $login->type == 'faculty' || $login->type == 'department' || $login->type == 'program') : ?>
	<div class="list-group list-group-horizontal">
		<a class="list-group-item list-group-item-action" href="organization">
			Organisasi</a>
		<a class="list-group-item list-group-item-action" href="organization">
			Fasilitas</a>
		<a class="list-group-item list-group-item-action" href="organization">
			Layanan</a>
		<a class="list-group-item list-group-item-action" href="organization">
			Jurnal</a>
	</div>
	<div class="list-group list-group-horizontal">
		<a class="list-group-item list-group-item-action" href="organization">
			Prestasi</a>
		<a class="list-group-item list-group-item-action" href="organization">
			Publikasi</a>
		<a class="list-group-item list-group-item-action" href="organization">
			Event</a>
	</div>
	<?php endif ?>

</div>