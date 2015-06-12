	<h1>Home</h1>
	<?php
		if ($this->session->flashdata('msg') !== false && $this->session->flashdata('success') == 1){
	?>
		<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('msg'); ?></div>
	<?php
		} elseif ($this->session->flashdata('msg') !== false && $this->session->flashdata('success') == 0) {
	?>
		<div class="alert alert-danger" role="alert">There has been a problem: <?php echo $this->session->flashdata('msg'); ?></div>
	<?php
		}
	?>
	<p>Welcome to the Admin Panel <?php echo $username; ?>. From the menu on the left you can edit your site.</p>