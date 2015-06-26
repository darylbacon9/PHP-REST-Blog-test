<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Edit Categories</h1>
			<p>Here you can add any new categories</p>
			<a href="/admin/categories/edit/" class="btn btn-primary"><i class="fa fa-fw fa-add"></i>Add New</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php
				foreach($categories as $cat){
			?>
					<a href="/admin/categories/edit/<?php echo $cat->uuid; ?>">
						<div class="categoryWrap">
							<?php echo $cat->title; ?>
						</div>
					</a>
			<?php
				}
			?>
		</div>
	</div>
</div>