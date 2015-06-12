<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/main.min.css" rel="stylesheet">
	<link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/animate.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="heroImage">
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-md-12">
				<?php var_dump($blogPosts); ?>
				<div class="blogPost">
					<?php
					foreach ($blogPosts as $blogPost) {
					?>
					<h1><?php echo $blogPost->title; ?></h1>
					<?php echo $blogPost->body; ?>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<script src="/assets/js/jquery.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
