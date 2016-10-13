<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Nviba Media</title>

	<!-- CSS !-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
	<!-- JS !-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>


</head>
<body>
<div class="container-fluid">
	<div class="">
		<?php if($this->session->userdata('logged_in')):?>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Nviba Media</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="<?php echo base_url(); ?>">Home<span class="sr-only">(current)</span></a></li>
						<li><a href="<?php echo base_url(); ?>events">Create Event</a></li>
						<li><a href="<?php echo base_url(); ?>events/all">Events List</a></li>
						<?php if($this->session->userdata('logged_in')): ?>
							<li><a href="<?php echo base_url(); ?>user/logout" style="color: red">Logout</a></li>
						
						<?php endif;?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<?php endif; ?>
	</div>
</div>

<div class="container">
	<div class="alert bg-success" style="display:none;"></div>
	<div class="alert bg-danger" style="display:none;"></div>
