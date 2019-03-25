<?php include 'hheader.php'; ?>
<?php echo anchor('user-login','Login',array('class'=>'btn btn-info pull-right')); ?>
<?php echo link_tag('styles/css/particle.css'); ?>
<br><br>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr class="success">
				<th>Serial No.</th>
				<th>Published By</th>
				<th>Article Title</th>
				<th>Article Description</th>
				<th>Images</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if(count($result))
				{
					$count = $this->uri->segment(2,0);
					foreach($result as $result)
					{
						?>
						<tr>
							<th><?php echo ++$count; ?></th>
							<td><?php echo $result->name; ?></td>
							<td><?php echo anchor("get-single-article/{$result->article_id}",$result->title) ?></td>
							<td><?php echo $result->body; ?></td>
							<td>
								<img style="height: 75px;cursor: pointer;" src="<?php echo $result->image_path; ?>" class="img-thumbnail" alt="<?php echo $result->title ?>">
								<br>
								<a href="<?php echo base_url('download-article/'.$result->article_id); ?>" class="btn btn-primary btn-xs" style="margin-top: 5px;width: 80%;margin-left: 5px;" data-toggle="tooltip" data-placement="left" title="Download Picture"><i class="fa fa-download"></i>
								</a>
							</td>
						</tr>
						<?php
					}
				}
				else
				{
					?>
					<tr>
						<th colspan="5">Sorry! Records not Found.</th>
					</tr>
					<?php
				}
			?>
			<tr>
				<th colspan="4">
					<?php echo $this->pagination->create_links(); ?>
				</th>
			</tr>
		</tbody>
	</table>
</div>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span style="color: red;">&times;</span>
				</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<img src="" id="main_image" width="100%" height="100%">
			</div>
			<div class="modal-footer">
        		<a href="<?php echo base_url('user-login') ?>" class="btn btn-success">Rate Photo</a>
      		</div>
		</div>
	</div>
</div>
<?php include 'ffooter.php'; ?>
<script type="text/javascript">
	$(window).on('load',function() 
	{
		$('img').on('click',function(){
			var src = $(this).attr('src');
			var title = $(this).attr('alt');
			$('#main_image').attr('src',src);
			if(title != undefined)
				$('.modal-title').html('<em><span style="color:red;">Title :- </span>'+title+'</em>');
			else
				return false;
			$('#myModal').modal('show');
		});
	});
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>