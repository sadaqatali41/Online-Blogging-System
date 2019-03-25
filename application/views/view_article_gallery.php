<style>
.col-sm-4, .col-xs-6, .col-md-3, .col-lg-3{
	max-height: 250px;
	margin-top: 10px;
}
</style>
<div class="row">
	<div class="col-sm-3">
		<a class="btn btn-info" href="<?php echo base_url('user-dashboard') ?>"><i class="fa fa-angle-double-left"></i> Dashboard</a>
	</div>
</div>
<br>
<div class="row">
	<div class="list-group gallery">
		<?php if(count($articles_gallery) > 0 ): ?>
			<?php foreach($articles_gallery as $key => $articles_gallery): ?>
			<div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
            	<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo $articles_gallery->image_path ?>">
                <img class="img-responsive" alt="" src="<?php echo $articles_gallery->image_path ?>"/><br/>
                <div class='text-right'>
                    <p class='text-muted text-center'><em><?php echo strtoupper($articles_gallery->title) ?></em></p>
                </div> <!-- text-right / end -->
            	</a>
        	</div> <!-- col-6 / end -->
			<?php endforeach; ?>
		<?php else: ?>
			<h1 class="text-center text-danger">Sorry! Gallery not Found.</h1>
		<?php endif; ?>
	</div>
</div>

<script>
$(document).ready(function(){

    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none",
        'width'  : 600,           // set the width
        'height' : 300, 
        // 'type'   : 'iframe',
        'autoSize' : false
    });
});
   
  
</script>