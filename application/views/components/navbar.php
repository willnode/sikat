<nav class="navbar navbar-light <?=isset($float) ? 'float' : ''?>">
  <a class="navbar-brand" href="<?=base_url()?>">
	<div class="campus-logo-sm mr-2"><img class="w-100" alt="" src="<?=base_url('files/navicon.png')?>"></div>
    UTM
  </a>
  <div class="flex-grow-1"></div>
  <form class="form-inline">
    <input class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search">
  </form>
  <form class="form-inline  mr-sm-2">
    <select class="form-control form-control-sm" onchange="javascript:window.location.href='<?php echo base_url(); ?>switch_lang/'+this.value;">
      <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected'; ?>>English</option>
      <option value="indonesian" <?php if($this->session->userdata('site_lang') == 'indonesian') echo 'selected'; ?>>Indonesia</option>
    </select>
  </form>
  <?php $logid = $this->Login_model->get_current_login();
  if (empty($logid)) : ?>
    <a class="btn btn-sm btn-warning" href="<?=base_url('login')?>"><i class="fa fa-key mr-2"></i>Login</a>
  <?php else : ?>
  <small><?=$logid?></small>
    <a class="btn btn-sm btn-warning" href="<?=base_url('panel/dashboard')?>">Dashboard</a>
    <a class="btn btn-sm btn-warning" href="<?=base_url('logout')?>">Logout</a>
  <?php endif ?>
</nav>
