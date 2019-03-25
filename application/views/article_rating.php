<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
 ?>
<style type="text/css">
	span{
		background-color: black;
		color: white;
		padding: 5px;
		border-radius: 10px 4px 4px 10px; 
	}
</style>
<a href="<?php echo base_url('article-list-for-ratings'); ?>" class="btn btn-info"><i class="fa fa-list"></i> All Articles</a>
<div style="clear: both;"></div>
<?php if(!empty($article_average_rating)) : ?>
	<label class="label label-warning" style="margin-left: 17%;">Average Ratings: <i style="color: red;"><?php echo number_format($article_average_rating->average_rating,1) ?> / 5.0
	</i><em class="text-success"> :: </em>
	<a href="<?php echo base_url("article-rating-details/{$article_average_rating->article_id}") ?>" style="text-decoration: none;color: black;">
		Rating Counts: <em style="color: blue;"><?php echo $article_average_rating->rating_count ?></em>
	</a>
	</label>
<?php endif; ?>
<div style="margin-left: 10%;">
	<form method="post" action="<?php echo base_url('article-rating-submit') ?>">
		<div class="row">
			<div class="col-sm-4 col-xs-6">
				<h3 class="text-success">Rate The Article Picture:-</h3>
				<ul type="none">
					<li>
						<input type="hidden" name="article_id" value="<?php echo $result->article_id; ?>">
					</li>
					<li>
						<div class="radio">
							<label><input type="radio" name="rate" value="1" required data-toggle="tooltip" data-placement="left" title="Very Bad" <?php echo(!empty($article_ratings) && $article_ratings->ratings == "1") ? "checked" : "" ?>>
								<span>Very Bad</span>
							</label>
						</div>
					</li>
					<li>
						<div class="radio">
							<label><input type="radio" name="rate" value="2" data-toggle="tooltip" data-placement="left" title="Bad" <?php echo(!empty($article_ratings) && $article_ratings->ratings == "2") ? "checked" : "" ?>>
								<span>Bad</span>
							</label>
						</div>
					</li>
					<li>
						<div class="radio">
							<label><input type="radio" name="rate" value="3" data-toggle="tooltip" data-placement="left" title="Good" <?php echo(!empty($article_ratings) && $article_ratings->ratings == "3") ? "checked" : "" ?>>
								<span>Good</span>
							</label>
						</div>
					</li>
					<li>
						<div class="radio">
							<label><input type="radio" name="rate" value="4" data-toggle="tooltip" data-placement="left" title="Very Good" <?php echo(!empty($article_ratings) && $article_ratings->ratings == "4") ? "checked" : "" ?>>
								<span>Very Good</span>
							</label>
						</div>
					</li>
					<li>
						<div class="radio">
							<label><input type="radio" name="rate" value="5" data-toggle="tooltip" data-placement="left" title="Excellent" <?php echo(!empty($article_ratings) && $article_ratings->ratings == "5") ? "checked" : "" ?>>
								<span>Excellent</span>
							</label>
						</div>
					</li>
				</ul>
				<br>
				<input type="submit" name="submit" value="Submit" class="btn btn-primary" style="margin-left: 15%;">
				<input type="reset" value="Cear" class="btn btn-danger">
			</div>
			<div class="col-sm-8">
				<?php if(count($result) > 0 ): ?>
				<img src="<?php echo $result->image_path ?>" height="300" width="85%" class="img-rounded" alt="<?php echo $result->title ?>" body="<?php echo $result->body; ?>" style="cursor: pointer;"><br>
				<a href="<?php echo base_url("article-photo-rating/$next->article_id") ?>" class="btn btn-success btn-lg pull-right">Next <i class="fa fa-angle-double-right"></i></a>
				<?php else: ?>
					<p class="alert alert-danger">Data not Found.</p>
				<?php endif; ?>
			</div>
		</div>
	</form>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		    	<button type="button" class="close" data-dismiss="modal">&times;
		    	</button>
		    	<h4 class="modal-title"></h4>
		    </div>
		    <div class="modal-body">
		    	<p id="desc"></p>
		    	<img src="" id="image" width="100%" height="100%">
		    </div>
	    </div>

	</div>
</div>
<script type="text/javascript">
	$(window).on('load',function(){
		$('img').on('click',function(){
			var src = $(this).attr('src');
			var title = $(this).attr('alt');
			var desc = $(this).attr('body');
			$('#image').attr('src',src);

			if(title != undefined){
				$('.modal-title').html("<em><i  style='color:red;'>Title :-</i> "+title+"</em>");
				$('#desc').html("<em><i  style='color:red;'>Description :-</i> "+desc+"</em>");
			}
			else
				return false;
			$('#myModal').modal('show');
		});
	});
</script>