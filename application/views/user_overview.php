<?php echo link_tag('styles/css/welcome.css'); ?>
<div class="welcome">
	<div class="row">
		<div class="col-sm-2">
			<a class="btn btn-info" href="<?php echo base_url('user-dashboard') ?>"><i class="fa fa-angle-double-left"></i> Dashboard</a>
		</div>
		<div class="col-sm-10">
			<div class="panel panel-primary">
			  <div class="panel-heading">
			  	<h3 class="panel-title">Overviews</h3>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
			  		<div class="col-md-3">
	                  <div class="well text-center" style="background: #E5B316;">
	                    <h2>
	                    	<span class="fa fa-user" aria-hidden="true"></span> <?php if(!empty($users)) : ?>
	                    		<?php if($users < 10 ): ?>
	                    			<?php echo '0'.$users; ?>
	                    		<?php else: ?>
	                    			<?php echo $users; ?>
	                    		<?php endif; ?>
	                    	<?php endif; ?>
	                    </h2>
	                    <h4>Users</h4>
	                  </div>
	                </div>
	                <div class="col-md-3">
	                  <div class="well text-center" style="background: #90E516;">
	                    <h2>
	                    	<span class="fa fa-newspaper-o" aria-hidden="true"></span> <?php if(!empty($articles)) : ?>
	                    		<?php if($articles < 10 ): ?>
	                    			<?php echo '0'.$articles; ?>
	                    		<?php else: ?>
	                    			<?php echo $articles; ?>
	                    		<?php endif; ?>
	                    	<?php endif; ?>
	                    </h2>
	                    <h4>Articles</h4>
	                  </div>
	                </div>
	                <div class="col-md-3">
	                  <div class="well text-center" style="background: #16E5C1;">
	                    <h2>
	                    	<span class="fa fa-history" aria-hidden="true"></span> <?php if(!empty($user_story)) : ?>
	                    		<?php if($user_story < 10 ): ?>
	                    			<?php echo '0'.$user_story; ?>
	                    		<?php else: ?>
	                    			<?php echo $user_story; ?>
	                    		<?php endif; ?>
	                    	<?php endif; ?>
	                    </h2>
	                    <h4>User Story</h4>
	                  </div>
	                </div>
	                <div class="col-md-3">
	                  <div class="well text-center" style="background: lightgrey;">
	                    <h2>
	                    	<span class="fa fa-file-text" aria-hidden="true"></span> <?php if(!empty($view_files)) : ?>
	                    		<?php if($view_files < 10 ): ?>
	                    			<?php echo '0'.$view_files; ?>
	                    		<?php else: ?>
	                    			<?php echo $view_files; ?>
	                    		<?php endif; ?>
	                    	<?php endif; ?>
	                    </h2>
	                    <h4>Views Files</h4>
	                  </div>
	                </div>
			  	</div>
			  </div>
			</div>
		</div>
	</div>
</div>