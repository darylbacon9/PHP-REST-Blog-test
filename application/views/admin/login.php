<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/admin.min.css" rel="stylesheet">
	<link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/animate.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-default loginPanel <?php if ($loginInvalid){echo 'shake animated';}?>">
					<div class="panel-heading">
						<h3 class="panel-title">Login</h3>
					</div>
					<div class="panel-body">
						<?php echo form_open('admin/login/verifyLogin', $formAttributes); ?>
							<?php
								if(validation_errors()){
							?>
								<div class="alert alert-danger" role="alert">
									<span class="fa fa-fw fa-exclamation" aria-hidden="true"></span>
									<span class="sr-only">Error:</span>
									<?php echo validation_errors(); ?>
								</div>	
							<?php
								}
							?>							
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
									<input type="text" class="form-control" name="username" placeholder="Username">
								</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-fw fa-unlock-alt"></i></span>
									<input type="password" class="form-control" name="password" placeholder="Password">
								</div>
							</div>
							<input type="submit" class="btn btn-lg btn-primary btn-block" value="Login">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="/assets/js/jquery.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
