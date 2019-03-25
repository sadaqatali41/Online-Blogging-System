<?php echo link_tag('styles/css/welcome.css'); ?>

<div class="welcome">
	<h3 class="text-muted text-center">Welcome To Admin Dashboard</h3>
	<div class="row">
		<div class="col-sm-3 pull-right">
			<h4 class="alert alert-success text-center">Hello... <span class="text text-primary"><?php echo ucwords($this->session->userdata('name')); ?>
			</span></h4>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<a class="btn btn-info" href="<?php echo base_url('user-dashboard') ?>"><i class="fa fa-angle-double-left"></i> Dashboard</a>
		</div>
		<div class="col-sm-9">
			<form class="form-inline">
				<div class="form-group">
				    <label for="status">Select Status:</label>
				    <select id="status" class="form-control">
				    	<option value="" disabled selected>Select Status</option>
				    	<option value="1">Active</option>
				    	<option value="0">Inactive</option>
				    </select>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-offset-3 col-sm-6">
			<div id="status_is_changed"></div>
		</div>
	</div>
	<br>
	<div class="table-responsive ">
		<table class="table table-striped table-bordered" id="dataview">
			<thead>
				<tr class="success">
					<th>Serial No.</th>
					<th>Full Name</th>
					<th>User Name</th>
					<th>Password</th>
					<th>Mobile Number</th>
					<th>Email Address</th>
					<th>Actions</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php if(count($details) > 0 ) : ?>
				<?php $count = $this->uri->segment(2,0); ?>
				<?php foreach($details as $details) : ?> 
					<tr class="status" data-user_status="<?php echo $details->status ?>">
						<td><?php echo ++$count; ?></td>
						<td><?php echo ucwords($details->name); ?></td>
						<td><?php echo $details->uname; ?></td>
						<td><?php echo $details->pwd; ?></td>
						<td><?php echo $details->mobile; ?></td>
						<td><?php echo $details->email; ?></td>
						<td>
							<div class="btn-group">
								<?php echo anchor("edit-user-details/{$details->id}",' ',array('class'=>'btn btn-info btn-xs fa fa-edit','title'=>'Edit','data-toggle'=>'tooltip','data-placement'=>'top')),
										anchor("delete-user-details/{$details->id}",' ',array('class'=>'btn btn-danger btn-xs fa fa-trash dlt','title'=>'Delete','data-toggle'=>'tooltip','data-placement'=>'top')),
										anchor("view-user-details/{$details->id}",' ',array('class'=>'btn btn-success btn-xs fa fa-eye','title'=>'View','data-toggle'=>'tooltip','data-placement'=>'top'));
									?>
							</div>
						</td>
						<td>
							<?php if($details->status == 1): ?>
								<button class="btn btn-success btn-xs change_status" data-status="<?php echo $details->status ?>" data-user_id="<?php echo $details->id ?>" title="Change Status" data-toggle="tooltip" data-placement="right">Active</button>
							<?php else: ?>
								<button class="btn btn-danger btn-xs change_status" data-status="<?php echo $details->status ?>" data-user_id="<?php echo $details->id ?>" title="Change Status" data-toggle="tooltip" data-placement="right">Inactive</button>
							<?php endif ?>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php else: ?>
					<tr class="danger">
						<th colspan="8" class="text-center">Sorry! Records not Found.</th>
					</tr>
				<?php endif; ?>
				
			</tbody>
			<tr>
				<th colspan="8">
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
			var option = confirm('Do You Want To Delete This User.');
			if(option)
			{
				var option = confirm('Really, You Want To Delete This User.');
				if(option)
					return true;
				else
					return false;
			}
			else
				return false;
		});

		// change the status
		$('.change_status').click(function(){
			if(confirm('Do You Want to Change the Status?'))
			{
				var id = $(this).data('user_id');
				var status = $(this).data('status');
				$.ajax({

					url: "<?php echo base_url('change-user-status') ?>",
					type: "POST",
					data: {user_id:id,user_status:status},
					success: function(data)
					{
						// console.log(data);
						if(data == "not")
						{
							$('#status_is_changed').html("<p class='alert alert-warning text-center'><strong><em>Sorry! You can't Change Active Admin Status.</em></strong></p>");
							setTimeout(function(){
								$('#status_is_changed').fadeOut('slow');
							},3000);
						}
						else
						{
							$('#status_is_changed').html(data);

							setTimeout(function(){
								$('#status_is_changed').fadeOut('slow');
							},3000);

							setTimeout(function(){
								window.location.href = "<?php echo base_url('user-registration-details') ?>";
							},3000);
						}
					},
					error: function(error)
					{
						console.log(error);
					}
				});
			}
			else
			{
				return false;
			}
		});
		// change status ends here

		// Filteration is starts here
		$('#status').change(function(){
			var status = $(this).val();
			$('.status').each(function(){
				var form_status = $(this).data('user_status');
				if(status != form_status)
					$(this).hide();
				else
					$(this).show();
			});
		});
		// filteration is ends here
	});
</script>

