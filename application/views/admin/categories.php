<?php
	if(!empty($this->session->flashdata('success'))){
		if ($this->session->flashdata('msg') !== false && $this->session->flashdata('success') == 1){
?>
			<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('msg'); ?></div>
	<?php
		} elseif ($this->session->flashdata('msg') !== false && $this->session->flashdata('success') == 0) {
	?>
		<div class="alert alert-danger" role="alert">There has been a problem: <?php echo $this->session->flashdata('msg'); ?></div>
<?php
		}
	}
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Edit Categories</h1>
			<p>Here you can add any new categories</p>
			<a href="/admin/categories/edit/" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Add New</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h4><strong>Existing Categories</strong></h4>
			<?php
				foreach($categories as $cat){
			?>
					<p class="categoryWrap">
						<?php echo $cat->title; ?>
					</p>
			<?php
				}
			?>
		</div>
	</div>
</div>