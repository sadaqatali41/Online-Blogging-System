<?php echo link_tag('styles/css/welcome.css'); ?>
<div class="welcome">
	<div class="row">
		<?php if(count($details) > 0 ): ?>
		<div class="col-sm-3">
			<a class="btn btn-info" href="<?php echo base_url('view-user-details/'.$details[0]->id) ?>"><i class="fa fa-angle-double-left"></i> User Details</a>
		</div>
		<?php else: ?>
		<div class="col-sm-3">
			<a class="btn btn-info" href="<?php echo base_url('user-registration-details') ?>"><i class="fa fa-angle-double-left"></i> User Details</a>
		</div>	
		<?php endif; ?>
	</div>
	<br>
	<div class="table-responsive ">
		<table class="table table-striped table-bordered" id="dataview">
			<thead>
				<tr class="success">
					<th>Serial No.</th>
					<th>Article Title</th>
					<th>Article Description</th>
					<th>Images</th>
					<th>Downloads</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php if(count($details) > 0 ) : ?>
				<?php $count = $this->uri->segment(3,0); ?>
				<?php foreach($details as $details) : ?> 
					<tr>
						<td><?php echo ++$count; ?></td>
						<td><?php echo $details->title; ?></td>
						<td style="width: 40%;"><?php echo $details->body; ?></td>
						<td>
							<img src="<?php echo $details->image_path ?>" width="90" height="90" alt="<?php echo $details->title ?>" style="cursor: pointer;">
						</td>
						<td><?php echo $details->img_count; ?></td>
						<td>
							<div class="btn-group">
								<?php echo anchor("edit-user-article/{$details->article_id}",' ',array('class'=>'btn btn-info fa fa-edit','title'=>'Edit','data-toggle'=>'tooltip','data-placement'=>'top')),
										anchor("delete-user-article/{$details->article_id}/{$details->id}",' ',array('class'=>'btn btn-danger fa fa-trash dlt','title'=>'Delete','data-toggle'=>'tooltip','data-placement'=>'top'));
									?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php else: ?>
					<tr class="danger">
						<th colspan="6" class="text-center">Sorry! Articles not Found.</th>
					</tr>
				<?php endif; ?>
				
			</tbody>
			<tr>
				<th colspan="6">
					<?php echo $this->pagination->create_links(); ?>
				</th>
			</tr>
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

		$('img').on('click',function(){
			var src = $(this).attr('src');
			var title = $(this).attr('alt');

			$('#image_modal').attr('src',src);
			if(title != undefined)
			{
				$('.modal-title').html('<em>Title : </em><em style="color:blue;">'+title+'</em>');
			}
			else
				return false;
			$('#model').modal('show');
		});
	});
</script>

