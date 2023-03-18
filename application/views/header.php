<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=title_set()?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="description" content="Situs Resmi Gereja Batak Karo Protestan">
	<meta name="keywords" content="Gereja Batak Karo Protestan">
	<meta name="author" content="Support by: hebatconsulting.com">

	<link rel="manifest" href="<?=base_url();?>/manifest.json">
	<link href="<?=base_url();?>assets/img/favicon.ico" rel="icon">
	<link href="<?=base_url();?>assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	
	<link href="<?=base_url();?>assets/css/style.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/css/css_custom.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/css/responsive.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/newjscss/jquery.mCustomScrollbar.min.css" rel="stylesheet prefetch">
</head>
<body>
<header id="header">
    <div class="container-fluid">
		<div id="logo">
			<a href="<?=base_url();?>home/index"><img src="<?=base_url();?>assets/img/honda/logo.png" alt="" title=""  /></a>
		</div>
		<nav id="nav-menu-container">
			<ul class="nav-menu" id="site-page" style="display:none;"></ul>
		</nav>
	</div>
</header>
<div id="popup_loading" class="_backdrop">
	<div class="_table">
		<div class="_table_cell">
			<span class="_loader"></span>
			<div>Mohon Tunggu...</div>
		</div>
	</div>
</div>
<script src='<?=base_url()?>assets/newjscss/xjquery.min.js'></script>
<script src="<?=base_url()?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
