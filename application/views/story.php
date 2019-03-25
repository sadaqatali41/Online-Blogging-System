<style type="text/css">
	.story{
		width: 40%;
		margin: auto;
	}
</style>
<h1 class="text-center">
	<a href="<?php echo base_url('user-dashboard') ?>" class="btn btn-info pull-left">
		<i class="fa fa-angle-double-left"></i> Dashboard
	</a>
	Your Story
</h1>

<form method="post" action="<?php echo base_url('story-submit') ?>">
	<div class="story">
		<?php if($feedback = $this->session->flashdata('story')) : ?>
		<?php $feedback_class = $this->session->flashdata('feedback_class'); ?>
		<div class="alert <?php echo "$feedback_class"; ?> text-center">
			<strong><?php echo $feedback;  ?></strong>
		</div>
		<?php endif;?>

		<div class="form-group">
			<label>Your Story:</label>
			<textarea cols="10" rows="5" class="form-control" placeholder="Enter Few Words about You" name="story" style="resize: none;" required><?php echo (!empty($story_data) ? trim($story_data->story) : trim("Welcome To Online Blogging System.")); ?>
			</textarea>
		</div>
		<button type="submit" class="btn btn-success btn-lg" name="update">Update
		</button>
	</div>
</form>