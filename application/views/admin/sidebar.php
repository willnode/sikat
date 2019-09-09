<div class="sidebar">
	<nav class="sidebar-nav">
		<ul class="nav">
			<li class="nav-item">
				<a class="nav-link" href="dashboard">
					<i class="nav-icon icon-speedometer"></i> Dashboard
				</a>
			</li>
			<li class="nav-title">Profil</li>
			<li class="nav-item">
				<a class="nav-link" href="look">
					<i class="nav-icon icon-drop"></i> Tampilan</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="biodata">
					<i class="nav-icon icon-drop"></i> Biodata</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="content">
					<i class="nav-icon icon-drop"></i> Konten</a>
			</li>
			<?php if (!$login->is_member) : ?>
			<li class="nav-item">
				<a class="nav-link" href="structure">
					<i class="nav-icon icon-pencil"></i> Struktur</a>
			</li>
			<li class="nav-title">Moderasi Data</li>
			<li class="nav-item">
				<a class="nav-link" href="review">
					<i class="nav-icon icon-pencil"></i> Dalam Moderasi <span class="badge badge-info">0</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="privacy">
					<i class="nav-icon icon-drop"></i> Privasi</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="grants">
					<i class="nav-icon icon-drop"></i> Proteksi</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="website">
					<i class="nav-icon icon-drop"></i> Website</a>
			</li>
			<?php endif ?>
			<?php if (!$login->is_member) : ?>
			<li class="nav-title">Database</li>
			<li class="nav-item">
				<a class="nav-link" href="statistics">
					<i class="nav-icon icon-pencil"></i> Statistik</a>
			</li>
			<?php endif ?>
			<?php if ($login->type == 'campus') : ?>
			<li class="nav-item">
				<a class="nav-link" href="faculty">
					<i class="nav-icon icon-pencil"></i> Fakultas</a>
			</li>
			<?php endif ?>
			<?php if ($login->type == 'campus' || $login->type == 'faculty') : ?>
			<li class="nav-item">
				<a class="nav-link" href="department">
					<i class="nav-icon icon-pencil"></i> Jurusan</a>
			</li>
			<?php endif ?>
			<?php if ($login->type == 'campus' || $login->type == 'faculty' || $login->type == 'department') : ?>
			<li class="nav-item">
				<a class="nav-link" href="program">
					<i class="nav-icon icon-pencil"></i> Prodi</a>
			</li>
			<?php endif ?>
			<?php if ($login->type == 'campus' || $login->type == 'faculty' || $login->type == 'department' || $login->type == 'program') : ?>
			<li class="nav-item">
				<a class="nav-link" href="student">
					<i class="nav-icon icon-pencil"></i> Mahasiswa</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="teacher">
					<i class="nav-icon icon-pencil"></i> Dosen</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="organization">
					<i class="nav-icon icon-pencil"></i> Organisasi</a>
			</li>
			<?php endif ?>
		</ul>
	</nav>
	<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>