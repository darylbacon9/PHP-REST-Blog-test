<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<!-- Favicon -->
    <link rel="icon" type="image/ico" href="<?php echo base_url() . '/assets/images/favicon.ico'; ?>"/>
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/admin.min.css" rel="stylesheet">
	<link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/admin/dashboard/">Beyond Local Admin</a>
			</div>
			<ul class="nav navbar-right top-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $username; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="/admin/dashboard/logout"><i class="fa fa-fw fa-envelope"></i> Log Out</a>
						</li>
					</ul>
				</li>
			</ul>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li>
						<a href="/"><i class="fa fa-fw fa-thumbs-up"></i> View The Site</a>
					</li>
					<li>
						<a href="/admin/dashboard/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
					</li>
					<li>
						<a href="#" data-toggle="collapse" data-target="#contentNav"><i class="fa fa-pencil-square-o"></i> Blog Posts <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="contentNav" class="collapse">
							<li>
								<a href="/admin/posts/">View Posts</a>
							</li>
							<li>
								<a href="/admin/posts/edit/">Add Post</a>
							</li>
						</ul>
					</li>
					<!--
					<li>
						<a href="/admin/team/"><i class="fa fa-fw fa-users"></i> Team Members</a>
					</li>
					<li>
						<a href="#" data-toggle="collapse" data-target="#contentNav"><i class="fa fa-pencil-square-o"></i> Content <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="contentNav" class="collapse">
							<li>
								<a href="/admin/content/edit/3debdb5d-50ba-4d26-be70-3860552ff5be">Home</a>
							</li>
							<li>
								<a href="/admin/content/edit/90eed1a1-e5eb-48b4-8802-6dd96805fda4">About</a>
							</li>
							<li>
								<a href="/admin/content/edit/acbb778f-2c95-47bc-926c-a953ff85a9bf">Contact</a>
							</li>
							<li>
								<a href="/admin/content/edit/77a0e37d-994d-4e7d-b1b0-ad492829e771">Apprenticeships &amp; Jobs</a>
							</li>
							<li>
								<a href="/admin/content/edit/0d62f16f-983e-47d5-86e2-d50c6ca55f9c">Campaign</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" data-toggle="collapse" data-target="#workNav"><i class="fa fa-fw fa-cubes"></i> Work <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="workNav" class="collapse">
							<li>
								<a href="/admin/work/workTypes">Edit Work Types</a>
							</li>
							<li>
								<a href="/admin/work/">Edit Existing Work</a>
							</li>
							<li>
								<a href="/admin/work/edit">Add New Work</a>
							</li>
						</ul>
					</li> -->
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</nav>
		<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">