<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Project SIKAT</title>
	<link rel="stylesheet" href="<?=base_url('assets/vendors/font-awesome/css/font-awesome.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/vendors/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
	<link rel="icon" href="<?=base_url('files/navicon.png')?>">
	<script src="<?=base_url('assets/vendors/jquery/jquery-3.4.1.min.js')?>"></script>
	<script src="<?=base_url('assets/vendors/bootstrap/js/bootstrap.min.js')?>"></script>
</head>
<body>
<?php $this->load->view('components/navbar') ?>
