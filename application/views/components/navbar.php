<nav class="navbar navbar-light">
  <a class="navbar-brand" href="<?=base_url()?>">
	<div class="campus-logo-sm mr-2"><img class="w-100" alt="" src="<?=base_url('files/navicon.png')?>"></div>
    UTM
  </a>
  <div class="flex-grow-1"></div>
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
  </form>
  <select class="form-inline" onchange="javascript:window.location.href='<?php echo base_url(); ?>switch_lang/'+this.value;">
    <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected'; ?>>English</option>
    <option value="indonesian" <?php if($this->session->userdata('site_lang') == 'indonesian') echo 'selected'; ?>>Indonesia</option>
  </select>
  <?php $logid = $this->Login_model->get_current_login();
  if (empty($logid)) : ?>
    <a class="btn btn-sm btn-outline-success" href="<?=base_url('login')?>">Login</a>
  <?php else : ?>
  <small><?=$logid?></small>
    <a class="btn btn-sm btn-outline-warning" href="<?=base_url('panel/dashboard')?>">Dashboard</a>
    <a class="btn btn-sm btn-outline-warning" href="<?=base_url('logout')?>">Logout</a>
  <?php endif ?>
</nav>
