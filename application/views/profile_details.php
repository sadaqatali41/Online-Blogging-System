<style type="text/css">
div.profile
{
	margin: auto;
	padding: 1%;
	box-shadow: 4px 5px 20px 6px gray;
}
input{overflow: hidden;}
</style>
<div class="profile">
	<div class="container">
		<a href="<?php echo base_url('user-dashboard') ?>" class="btn btn-info"><i class="fa fa-angle-double-left"></i> Dashboard</a>
		<h3 class="text-center">Your Profile Details</h3>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Full Name :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $profile->name ?>" class="form-control" disabled></div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">User Name :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $profile->uname ?>" class="form-control" disabled></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Password :</div>
					<div class="col-xs-8">
						<input type="password" value="<?php echo $profile->pwd ?>" class="form-control" disabled id="pwd">
					</div>
					<div class="col-xs-1">
						<input type="checkbox" id="pwd_show" style="margin: 11px -46px 0;">
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Mobile Number :</div>
					<div class="col-xs-8"><input type="number" value="<?php echo $profile->mobile ?>" class="form-control" disabled></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Email Address :</div>
					<div class="col-xs-8"><input type="email" value="<?php echo $profile->email ?>" class="form-control" disabled></div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Password Count :</div>
					<div class="col-xs-8"><input type="number" value="<?php echo $profile->pwd_count ?>" class="form-control" disabled></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Security Ques. :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $profile->sques ?>" class="form-control" disabled></div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Security Answer :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $profile->answer ?>" class="form-control" disabled></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Created Date :</div>
					<div class="col-xs-8"><input type="text" value="<?php echo $profile->created_date ?>" class="form-control" disabled></div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Updated Date :</div>
					<?php if($profile->updated_date != "") : ?>
					<div class="col-xs-8"><input type="text" value="<?php echo $profile->updated_date ?>" class="form-control" disabled></div>
					<?php else: ?>
					<div class="col-xs-8"><input type="text" value="Not Updated Yet" class="form-control" disabled></div>	
					<?php endif; ?>
				</div>
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