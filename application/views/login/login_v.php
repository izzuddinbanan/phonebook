<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>CodeIgniter Tutorial</title>
				
			<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
			<!-- FONTAWESOME STYLES-->
			<link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
			<!-- CUSTOM STYLES-->
			<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" />
			<!-- GOOGLE FONTS-->
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> 
				
</head>
<body>
<div class="container">
	<div class="row text-center ">
        <div class="col-md-12">
            <br /><br />
             <h2>Login</h2>
            <br />
        </div>
    </div>
	<div class="row ">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				<strong>Enter Details To Login</strong>  
				</div>
				<div class="panel-body">
				 <?php get_message(); ?>
					<form role="login" method="POST" action="<?php base_url(); ?>login/verify">
						   <br />
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
								<input type="text" name="username" class="form-control" placeholder="Your Username " />
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
								<input type="password" name="password" class="form-control"  placeholder="Your Password" />
							</div>
							<div class="form-group">
								<span class="pull-right">
									   <a href="#" >Forget password ? </a> 
								</span>
							</div>
						<input type="submit" value="Login" name="submit" class="btn btn-primary "/>
						<hr />
					</form>
				</div>   
			</div>
		</div>
	</div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="<?php echo base_url();?>assets/js/custom.js?v=" . time() ></script>
		
		</body>
</html>