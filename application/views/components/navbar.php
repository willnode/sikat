<nav class="navbar navbar-light <?=isset($float) ? 'float' : ''?>">
  <a class="navbar-brand" href="<?=base_url()?>">
	<div class="campus-logo-sm mr-2"><img class="w-100" alt="" src="<?=base_url('files/navicon.png')?>"></div>
  </a>
  <div class="flex-grow-1"></div>
  <form class="form-inline" action="<?=current_url()?>">
    <input name="q" class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search" value="<?=$this->input->get('q')?>">
  </form>
  <form class="form-inline  mr-sm-2">
    <select class="form-control form-control-sm" onchange="javascript:window.location='<?php echo base_url(); ?>switch_lang/'+this.value;">
      <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected'; ?>>English</option>
      <option value="indonesian" <?php if($this->session->userdata('site_lang') == 'indonesian') echo 'selected'; ?>>Indonesia</option>
    </select>
  </form>
  <?php $logid = $this->Login_model->get_current_login();
  if (empty($logid)) : ?>
    <a class="btn btn-sm btn-warning" href="<?=base_url('login')?>"><i class="fa fa-key mr-2"></i>Login</a>
  <?php else : ?>
  <div class="btn-group">
  <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <i class="fa fa-user mr-2"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <a class="dropdown-item" href="<?=base_url($logid)?>"><?=$logid?></a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?=base_url('panel/dashboard')?>">Dashboard</a>
      <a class="dropdown-item" href="<?=base_url('logout')?>">Logout</a>
    </div>
    </div>
  <?php endif ?>
</nav>
