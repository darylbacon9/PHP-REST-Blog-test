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
			<h1><?php echo (!empty($uuid)?'Add':'Edit');?> Category</h1>
			<p>Fill out the form below to add a new category</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php echo form_open($formAction, $formAttributes); ?>
				<div class="form-group">
					<label for="title" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="title" id="title">
					</div>
				</div>
				<div class="form-group">
					<label for="slug" class="col-sm-2 control-label">Slug</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="slug" id="slug">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input type="submit" class="btn btn-primary" value="Save">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>