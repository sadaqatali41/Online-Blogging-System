<style type="text/css">
	div.row div{
		margin-left: 5%;
		margin-top: 10px;
	}
	.col-sm-3{
		box-shadow: 5px 5px 35px 3px black;
		padding: 12px;
		border-radius: 10px;
	}
</style>
<h3 class="text-center">
	<a href="<?php echo base_url('article-list-for-ratings') ?>" class="btn btn-info pull-left">Back</a>
	<u>
		<i>Article Rating Details</i>
	</u>
	<?php if(count($article_average_rating) > 0 ): ?>
		<label class="label label-warning pull-right">Average Ratings: <i style="color: red;"><?php echo number_format($article_average_rating->average_rating,1) ?> / 5.0
		</i><em class="text-success"> :: </em>
		Rating Counts: <em style="color: blue;"><?php echo $article_average_rating->rating_count ?></em>
		</label>
	<?php endif; ?>
</h3>
<div class="row">
	<?php if(count($rating_details) > 0 ): ?>
	<?php foreach($rating_details as $rating_detail) : ?>
	<div class="col-sm-3">
		<figure>
			<img src="<?php echo $rating_detail->image_path ?>" style="width: 100%;">
			<figcaption>
				By :- <em style="color: red;font-weight: bold;"><?php echo $rating_detail->name ?></em>
				<span class="text-center">
					Rating : <em style="color: red;"><?php echo number_format($rating_detail->ratings,2) ?> </em>OF 5.00
				</span><br>
				<span>
					Rating Date :- <em style="color: red;"><?php echo $rating_detail->created_date ?></em>
				</span>
					
			</figcaption>
		</figure>
	</div>
	<?php endforeach; ?>
	<?php else: ?>
		<div class="col-md-push-3 col-md-6 col-xs-6 alert alert-danger text-center">Sorry! Data not Found.
		</div>
	<?php endif; ?>
</div>