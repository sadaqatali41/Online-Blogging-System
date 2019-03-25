<?php echo link_tag('styles/css/welcome.css');?>
<div class="welcome">
	<div class="row">
		<div class="col-sm-3">
			<a class="btn btn-info" href="<?php echo base_url('user-dashboard') ?>"><i class="fa fa-angle-double-left"></i> Dashboard</a>
		</div>
		<div class="col-sm-7 col-sm-offset-2"><h4>User's Article List</h4></div>
	</div>
<br>
	<div class="table-responsive ">
		<table class="table table-striped table-bordered" id="dataview">
			<thead>
				<tr class="success">
					<th>Serial No.</th>
					<th>Articles Title</th>
					<th>Articles Description</th>
					<th>Images</th>
					<th>Image Downloads</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody> 
			<?php if(count($articles) > 0 ): ?>
				<?php $count = $this->uri->segment(2,0); ?>
					<?php foreach ($articles as $articles): ?> 
							<tr>
								<td><?php echo ++$count; ?></td>
								<td><?php echo $articles->title; ?></td>
								<td style="width: 40%;text-align: justify;"><?php echo $articles->body; ?></td>
								<td><?php if(!is_null($articles->image_path)): ?>
									<a href="javascript:void(0)">
										<img src="<?php echo $articles->image_path; ?>" height="90" width="90" class="img-rounded" alt="<?php echo $articles->title; ?>">
									</a>
								<?php endif; ?>
								</td>
								<td><span class="label label-info"><?php echo $articles->img_count; ?></span></td>
								<th>
									<div class="btn-group">
									<?php echo anchor("edit-user-article/{$articles->article_id}",' ',array('class'=>'btn btn-info fa fa-edit','title'=>'Edit','data-toggle'=>'tooltip','data-placement'=>'bottom')),
											anchor("delete-user-article/{$articles->article_id}/{$articles->id}",' ',array('class'=>'btn btn-danger fa fa-trash dlt','title'=>'Delete','data-toggle'=>'tooltip','data-placement'=>'bottom')),
											anchor("print-pdf/{$articles->article_id}",' ',array('class'=>'btn btn-warning fa fa-eye','target'=>'_blank','title'=>'View','data-toggle'=>'tooltip','data-placement'=>'bottom')),
											anchor('download-photo/'.$articles->article_id,' ',array('class'=>'btn btn-primary fa fa-download','title'=>'Download','data-toggle'=>'tooltip','data-placement'=>'bottom'));
									 ?>
									 </div>
								</th>
							</tr>
					<?php endforeach; ?>
					<tr>
						<th colspan="6">
							<?php echo $this->pagination->create_links(); ?>
						</th>
					</tr>
				<?php else: ?>
					<tr>
						<th colspan="6">Sorry! Data not Found.</th>
					</tr>
				<?php endif; ?>
		</table>
	</div>
</div>
<div id="model" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"></h4>
		    </div>
		    <div class="modal-body">
		        <img src="" id="image_modal" width="100%" height="100%">
		    </div>
	    </div>

	</div>
</div>

<script type="text/javascript">
	$(window).on('load',function(){

		$('img').on('click',function(){

			var src = $(this).attr('src');
			var title = $(this).attr('alt');
			$("#image_modal").attr('src',src);
			if(title != undefined)
				$(".modal-title").html("<em>"+title+"</em>");
			else
				return false;

			$("#model").modal('show');
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();

		$('.dlt').click(function(){
			var option = confirm('Do You Want To Delete This Article.');
			if(option)
			{
				var option = confirm('Really, You Want To Delete This Article.');
				if(option)
					return true;
				else
					return false;
			}
			else
				return false;
		});
	});
</script>

