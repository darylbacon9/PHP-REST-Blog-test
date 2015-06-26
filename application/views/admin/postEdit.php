<h1><?php echo $title; ?></h1>
<?php
	if ($this->session->flashdata('msg') !== NULL && !empty($this->session->flashdata('success')) && $this->session->flashdata('success') == 1){
?>
	<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('msg'); ?></div>
<?php
	} elseif ($this->session->flashdata('msg') !== NULL && !empty($this->session->flashdata('success')) && $this->session->flashdata('success') == 0) {
?>
	<div class="alert alert-danger" role="alert">There has been a problem: <?php echo $this->session->flashdata('msg'); ?></div>
<?php
	}
?>

<!-- <div class="container"> -->
	<div class="row">
		<?php echo form_open($formAction, $formAttributes); ?>
			<div class="form-group">
				<label for="slug" class="col-sm-3">Slug</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="slug" id="slug" />
				</div>
			</div>
			<div class="form-group">
				<label for="title" class="col-sm-3">Title</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="title" id="title" />
				</div>
			</div>
			<div class="form-group">
				<label for="category" class="col-sm-3">Category</label>
				<div class="col-sm-9">
					<select name="category" id="category" class="form-control">
						<option selected disabled>-- Please Select --</option>
						<?php
						foreach ($categories as $category) {
						?>
							<option value="<?php echo $category->uuid; ?>"><?php echo $category->title; ?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="status" class="col-sm-3">Status</label>
				<div class="col-sm-9">
					<select name="status" id="status" class="form-control">
						<option selected disabled>-- Please Select --</option>
						<?php
						foreach ($statuses as $status) {
						?>
							<option value="<?php echo $status->uuid; ?>"><?php echo $status->title; ?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="allowComments" class="col-sm-3">Allow Comments?</label>
				<div class="col-sm-9">
					<input type="checkbox" name="allowComments" id="allowComments" value="1">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3" for="body">Body</label>
				<div class="col-sm-9">
					<textarea rows="6" class="form-control" name="body" id="body"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="uuid" value="<?php echo isset($post->uuid) ? $post->uuid : ''; ?>" />
					<input type="submit" class="btn btn-primary" value="Save">
				</div>
			</div>		
		</form>
	</div>
<!-- </div> -->