<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Blog Title</th>
			<th>Category</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($blogPost as $post) {
		?>
		<tr>
			<td><?php echo $post->$title; ?></td>
			<td><?php echo $post->category_title; ?></td>
			<td><?php echo $post->status_title; ?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>