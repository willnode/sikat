<header class="app-header navbar">
	<button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="<?=base_url()?>">
		<img src="<?=base_url('assets/images/sikat-nav.png')?>" height="25" alt="CoreUI Logo">
	</a>
	<ul class="nav navbar-nav mr-auto d-md-down-none">
		<!-- <li class="nav-item px-3">
<a class="nav-link" href="https://coreui.io/">CoreUI Website</a>
</li>
<li class="nav-item px-3">
<a class="nav-link" href="https://coreui.io/icons/">CoreUI Icons</a>
</li>
<li class="nav-item px-3">
<a class="btn btn-warning" href="https://coreui.io/pro/">Go Pro</a>
</li> -->
	</ul>
	<ul class="nav navbar-nav d-md-down-none">
		<li class="nav-item">
		<a class="nav-link" href="#noe"><img class="img-avatar" alt="" src="<?=base_url($login->avatar)?>"></a>
		</li>
		<li class="nav-item">
			<a class="btn btn btn-link" href="<?=base_url($login->username)?>">Profile</a>
		</li>
		<li class="nav-item">
			<a class="btn btn btn-link" href="<?=base_url("logout")?>">Logout</a>
		</li>
	</ul>
</header>