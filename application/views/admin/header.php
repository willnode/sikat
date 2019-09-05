<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Project SIKAT</title>
	<link rel="stylesheet" href="<?=base_url('assets/vendors/coreui/css/style.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/vendors/perfect-scrollbar/css/perfect-scrollbar.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/vendors/simple-line-icons/css/simple-line-icons.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/vendors/coreui/icons/css/coreui-icons.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
	<link rel="icon" href="<?=base_url('files/navicon.png')?>">
	<script src="<?=base_url('assets/vendors/jquery/jquery-3.4.1.min.js')?>"></script>
	<script src="<?=base_url('assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js')?>"></script>
	<script src="<?=base_url('assets/vendors/coreui/js/coreui.min.js')?>"></script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show pace-done pace-done">
<?php $this->load->view('admin/navbar', ['login' => $login]); ?>
<div class="app-body">
<?php $this->load->view('admin/sidebar', ['login' => $login]);?>
<main class="main">
<div class="container-fluid my-3">