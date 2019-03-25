<?php include 'hheader.php'; ?>

<?php echo anchor('public-articles','Back',array('class'=>'btn btn-warning btn-lg pull-right')) ?>
<div class="row">
	<div class="col-lg-4">
		<h3>Article Title :-</h3>
		<h4 class="text text-primary text-center"><?php echo $data->title; ?></h4>
	</div>
	<div class="col-lg-4">
		<h3>Article Description :-</h3>
		<h4 class="text text-primary text-justify"><?php echo $data->body; ?></h4>
	</div>
	<div class="col-lg-4">
		<h3>Article Picture :-</h3>
		<img src="<?php echo $data->image_path; ?>" class='img-thumbnail' style='height: 300px;width: auto;'>
	</div>
</div>


<?php include 'ffooter.php'; ?>