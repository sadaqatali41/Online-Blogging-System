<style type="text/css">
	.jumbotron{
		display: none;
	}
	figcaption{
		position: absolute;
		top: 10%;
		left: 20%;
		background-image: radial-gradient(circle, red, yellow, green);
		padding: 10px;
		font-weight: bold;
		border-radius: 5px;
	}
	h5{
		position: absolute;
		top: 10%;
		left: 65%;
		padding: 5px;
		background-image: radial-gradient(circle, black, violet, white);
		border-radius: 5px;
	}
</style>
<div class="container">
	<h1 class="text-center">Codeigniter Blogging System</h1>
	<a href="<?php echo base_url('user-dashboard') ?>" class="btn btn-info"><i class="fa fa-angle-double-left"></i> Dashboard</a>
	<br><br>
	<?php if($inserted = $this->session->flashdata('inserted')) :?>
			<?php $inserted_class = $this->session->flashdata('inserted_class'); ?>
			<div class="col-sm-6 <?php echo $inserted_class ?>">
				<strong>
					<?php echo $inserted; ?>
				</strong>
			</div>
			<?php echo "<br><br><br><br>"; ?>
	<?php endif; ?>
	<div class="row">
		<?php if(count($result) > 0 ) :?>
		<?php foreach($result as $article): ?>

		<div class="col-sm-4 col-md-4 col-xs-12">
			<figure>
				<a href="javascript:void(0)" data-toggle="modal" data-target="#my<?php echo $article->article_id; ?>">
					<img src="<?php echo $article->image_path; ?>" style="height: 270px;width: 360px;" class="img-thumbnail">
				</a>
				<figcaption>
					<em><?php echo $article->title; ?></em>
				</figcaption>
				<h5>
					<?php if(!empty($article->average_rating)) : ?>
						<span class="label label-info">Ratings : <?php echo number_format($article->average_rating,1) ?> / <span style="color: black;">5.0</span>
						</span>
						<br>
						<a style="line-height: 25px;" class="label label-success" href="<?php echo base_url("article-rating-details/{$article->article_id}") ?>">
							Rating Counts : <?php echo $article->rating_count; ?>
						</a>
					<?php else: ?>
						<span class="label label-danger">No Ratings</span>
					<?php endif; ?>
				</h5>
			</figure>
		</div>

		<?php endforeach; ?>
		<?php else: ?>
			<div class="alert alert-danger">Sorry! Data not Found.</div>
		<?php endif; ?>
	</div>
</div>

<!-- Modal popup -->
<?php if(count($result) > 0 ) :?>
<?php foreach($result as $article): ?>
<div id="my<?php echo $article->article_id; ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal">&times;
			    </button>
			    <h4 class="modal-title"><em><span style="color: blue;">Title:-</span> <?php echo $article->title; ?></em></h4>
		    </div>
		    <div class="modal-body">
		    	<p><em><span style="color: red;">Description:- </span><?php echo $article->body; ?></em></p>
		    	<img src="<?php echo $article->image_path ?>" width="100%" height="100%">
		    </div>
		    <div class="modal-footer">
		    	<a href="<?php echo base_url("article-photo-rating/{$article->article_id}") ?>" class="btn btn-warning">Rate Image</a>
		    </div>
	    </div>

	</div>
</div>
<?php endforeach; ?>
<?php else: ?>
	<div class="alert alert-danger">Sorry! Data not Found.</div>
<?php endif; ?>
