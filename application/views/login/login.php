<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=title_set()?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description"> 
	<link href="<?php echo base_url(); ?>assets/img/favicon.ico" rel="icon">
	<link href="<?php echo base_url(); ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">
	<link href="<?php echo base_url(); ?>assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/css_custom.css" rel="stylesheet"> 
</head>
<body style="background-image: linear-gradient(to left, red, yellow);">
	<div class="container login">
		<div class="row justify-content-center login"> 
			<div class="form-group col-md-8 col-md-offset-5 " > 
				<div class="card align-middle"style="border:none;" >
					<div class="login-back-img" style="background-image: url(<?php echo base_url(); ?>assets/img/honda/bg.png);"> 
						<img src="<?php echo base_url(); ?>assets/img/honda/logo.png">
						<span class="login_title align-middle"> Login Panel</span>
					</div>
					<div class="card-body">
					<?= $this->session->flashdata('message'); ?>
						<?php echo form_open('login/login_masuk','autocomplete="off"'); ?>
							<div class="row col-xs-12" style="margin-bottom: 10px;" >
								<span class="col-md-4 "><h5>Username</h5></span>
								<input class="col-md-7 form-control" type="text" name="username" id="user" placeholder="Enter username"> 
							</div>

							<div class="row col-xs-12" >
								<span class="col-md-4"><h5>Password</h5></span>
								<input class="col-md-7 form-control" type="password" id="pass" name="pass" placeholder="Enter password"> 
							</div>
							<br>
							<button style="position: relative; float: right;" class="btn-default black-invert">LOGIN</button> 
							<br>
						<?php echo form_close(); ?>
					</div>
				</div>
            </div>
		</div>
	</div> 
</div>
<script src="https://demo-hebatconsulting.my.id/mamre/assets/newjscss/jquery.min.js"></script>
</body>