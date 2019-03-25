<style type="text/css">
div.details
{
	margin: auto;
	padding: 1%;
	box-shadow: 4px 5px 20px 6px gray;
	height: 500px;
}
input{overflow: hidden;}
</style>
<div class="details">
	<div class="container">
		<a href="<?php echo base_url('user-registration-details') ?>" class="btn btn-info"><i class="fa fa-angle-double-left"></i> User Details</a>
		<a href="<?php echo base_url('view-user-articles/'.$details->id) ?>" class="btn btn-success pull-right" style="margin-right: 50px;"><i class="fa fa-eye"></i> All Articles <span style="color: blue;">(<?php echo $details->article_counts ?>)</span></a>
		<h3 class="text-center">User Profile Details</h3>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Full Name :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $details->name ?>" class="form-control" disabled></div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">User Name :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $details->uname ?>" class="form-control" disabled></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Password :</div>
					<div class="col-xs-8">
						<input type="password" value="<?php echo $details->pwd ?>" class="form-control" disabled id="pwd">
					</div>
					<div class="col-xs-1">
						<input type="checkbox" id="pwd_show" style="margin: 11px -26px 0;">
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Mobile Number :</div>
					<div class="col-xs-8"><input type="number" value="<?php echo $details->mobile ?>" class="form-control" disabled></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Email Address :</div>
					<div class="col-xs-8"><input type="email" value="<?php echo $details->email ?>" class="form-control" disabled></div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Password Count :</div>
					<div class="col-xs-8"><input type="number" value="<?php echo $details->pwd_count ?>" class="form-control" disabled></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Security Ques. :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $details->sques ?>" class="form-control" disabled></div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Security Answer :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $details->answer ?>" class="form-control" disabled></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Created Date :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $details->created_date ?>" class="form-control" disabled></div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Updated Date :</div>
					<?php if($details->updated_date != "") : ?>
					<div class="col-xs-8"><input type="text" value="<?php echo $details->updated_date ?>" class="form-control" disabled></div>
					<?php else: ?>
					<div class="col-xs-8"><input type="text" value="Not Updated Yet" class="form-control" disabled></div>	
					<?php endif; ?>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Profile Picture :</div>
					<div class="col-xs-8">
					<?php $user_id = $this->session->userdata('user_id');
						$user_pic = 'user-profile/'.$details->id.'.jpg';	
				 	?>
				 	<?php if(file_exists($user_pic)): ?>
						<img src="<?php echo base_url("$user_pic") ?>" class="img-rounded" style="cursor: pointer;" heigth="100" width="150">
					<?php else: ?>
						<img src="<?php echo base_url("user-profile/default.jpg") ?>" class="img-rounded" style="cursor: pointer;" height="100" width="150">
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
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
		$('#pwd_show').click(function(){
			$('#pwd').attr('type',$(this).is(':checked') ? 'text' : 'password');
		});
	});
</script>
<script type="text/javascript">
	$(window).on('load',function(){

		$('img').on('click',function(){

			var src = $(this).attr('src');
			$("#image_modal").attr('src',src);

			$("#model").modal('show');
		});
	});
</script>