	<div class="heroImage">
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-md-12">
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