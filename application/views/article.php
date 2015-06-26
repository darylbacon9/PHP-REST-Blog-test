	<?php
		if (!empty($this->session->flashdata('msg')) && $this->session->flashdata('msg') !== false && $this->session->flashdata('success') == 1){
	?>
		<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('msg'); ?></div>
	<?php
		} elseif (!empty($this->session->flashdata('msg')) && $this->session->flashdata('msg') !== false && $this->session->flashdata('success') == 0) {
	?>
		<div class="alert alert-danger" role="alert">There has been a problem: <?php echo $this->session->flashdata('msg'); ?></div>
	<?php
		}
	?>
	<div class="heroImage">
		<a href="/blog/posts" class="blogLink"><i class="fa fa-fw fa-long-arrow-left"></i>Back to Blog</a>
		<div class="titleWrap">
			<h1><?php echo $post[0]->title; ?></h1>
			<p><strong><i class="fa fa-fw fa-clock-o"></i><?php echo date('dS F Y g:ia',strtotime($post[0]->date_added)); ?> by <i class="fa fa-fw fa-user"></i><?php echo $post[0]->username; ?></strong></p>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="blogPost">
					<?php echo $post[0]->body; ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php
					if ($post[0]->allowComments){
				?>
					<div class="commentsWrap">
						<h2>Comments</h2>
						<?php
							if(!empty($post[0]->uuidComment)){
								foreach($post as $comment) {
						?>
									<div class="comment">
										<strong><?php echo $comment->name; ?></strong> - <?php echo date('dS F Y g:ia',strtotime($comment->comment_date)); ?>
										<p><?php echo $comment->text; ?></p>
									</div>
						<?php
								}
							} else {
						?>
							<div class="comment">
								<p>No comments found</p>
							</div>
						<?php
							}
						?>
						<h2>Leave a comment</h2>
						<form class="form-horizontal" action="/blog/saveComment" method="POST">
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">Name:</label>
								<div class="col-sm-10">
									<input type="text" id="name" name="name" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="text" class="col-sm-2 control-label">Comment:</label>
								<div class="col-sm-10">
									<textarea id="text" name="text" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<input type="hidden" name="uuidPost" value="<?php echo $post[0]->uuid; ?>">
									<input type="hidden" name="slug" value="<?php echo $post[0]->slug; ?>">
									<input type="submit" value="Submit" class="btn btn-primary">
								</div>
							</div>
						</form>
					</div>
				<?php
					}
				?>
			</div>
		</div>

	</div>