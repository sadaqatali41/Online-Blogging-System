<?php echo link_tag('styles/css/welcome.css'); ?>
<?php echo link_tag('styles/css/profile_cards.css') ?>
<div class="welcome">
	<div class="row">
		<div class="col-sm-2">
			<a class="btn btn-info" href="<?php echo base_url('user-dashboard') ?>"><i class="fa fa-angle-double-left"></i> Dashboard</a>
		</div>
		<div class="col-sm-8">
			<h3 class="text-center">
				<em><u>Story Cards</u></em>
			</h3>
		</div>
	</div>
	<br>
	<div class="row">
	<?php foreach($stories as $story): ?>
		<div class="col-sm-3 col-xs-6">
			<div class="flip-card">
			  <div class="flip-card-inner">
			    <div class="flip-card-front">
			    <?php 
			    	$profile_pic = 'user-profile/'.$story->id.'.jpg';
			    	if(!file_exists($profile_pic))
			    		$profile_pic = 'user-profile/default.jpg';
			    ?>
			      <img src="<?php echo base_url("$profile_pic"); ?>" alt="Avatar" style="width:300px;height:200px;" class="img-rounded">
			    </div>
			    <div class="flip-card-back">
			      <h1><?php echo ucwords($story->name); ?></h1> 
			      <p>
			      	<em style="color: gold;">
			      		<strong><?php echo $story->story; ?></strong>
			      	</em>
			      </p>
			    </div>
			  </div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>