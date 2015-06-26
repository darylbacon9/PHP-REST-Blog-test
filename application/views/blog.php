	<div class="heroImage">
		<div class="titleWrap">
			<h1>Blog</h1>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="blogPost">
					<?php
						foreach ($blogPosts as $blogPost) {
					?>
							<h1><a href="/posts/<?php echo $blogPost->slug; ?>"><?php echo $blogPost->title; ?></a></h1>
							<p><strong>Posted at <?php echo date('dS F Y g:ia',strtotime($blogPost->date_added)); ?> by <?php echo $blogPost->username; ?></strong></p>
							<?php echo substr(strip_tags($blogPost->body),0,500); ?>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>