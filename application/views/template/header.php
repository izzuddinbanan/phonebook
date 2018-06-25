	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
				
				 <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
				<!-- FONTAWESOME STYLES-->
				<link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
				<!-- CUSTOM STYLES-->
				<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" />
				<!-- GOOGLE FONTS-->
				<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> 
				<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/phone.ico"/>
				<title>My PhoneBook</title>
	</head>
	<body>
	<?php  $username = $this->session->userdata('username'); ?>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header" STYLE="background: none;">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand active" href="<?php echo base_url();?>dashboard">Phone Book</a>
					<ul class="nav navbar-nav">
						<li><a href="<?php echo base_url();?>user">User</a></li>
						<li><a href="<?php echo base_url();?>contact/contactpage">Contact</a></li>
						<?php /* <li><a href="<?php echo base_url();?>user/hobi">Hobby</a></li> */ ?> 
					</ul>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url();?>upload/<?php echo $this->session->userdata('image') == "" ? "blank.png" : $this->session->userdata('image')  ?>" width="30" height="30" class="img-circle" alt="Bird"> &emsp; <?php echo $username; ?>  <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url();?>user/profile">Update Profile</a></li>
							<li><a href="<?php echo base_url();?>contact/change_pwd">Change Password</a></li>
							<li><a href="<?php echo base_url();?>email/sendmail">Send Email</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url();?>login/logout">Log Out</a></li>
						</ul>
					</li>
				</ul>	
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
