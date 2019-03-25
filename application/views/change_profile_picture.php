<style type="text/css">
div.profile_picture
{
	margin: auto;
	padding: 1%;
	box-shadow: 4px 5px 20px 6px gray;
}
input{overflow: hidden;}
</style>
<div class="profile_picture">
	<div class="container">
		<a href="<?php echo base_url('user-dashboard') ?>" class="btn btn-info"><i class="fa fa-angle-double-left"></i> Dashboard</a>
		<h3 class="text-center">Change Profile Picture</h3>
		<form method="post" action="<?php echo base_url('profile-picture-submit') ?>" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Upload Picture :</div>
					<div class="col-xs-8"><input type="file" id="profile" name="profile" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">
						<input type="submit" value="Submit" class="btn btn-info">
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row">
					<div class="col-xs-3">Old Picture :</div>
					<div class="col-xs-8">
					<?php $user_id = $this->session->userdata('user_id');
						$user_pic = 'user-profile/'.$user_id.'.jpg';	
				 	?>
				 	<?php if(file_exists($user_pic)): ?>
						<img src="<?php echo base_url("$user_pic") ?>" class="img-rounded" heigth="50%" width="50%">
					<?php else: ?>
						<img src="<?php echo base_url("user-profile/default.jpg") ?>" class="img-rounded" height="200" width="200">
					<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6" id="container">
				<div class="row">
					<div class="col-xs-3">New Picture :</div>
					<div class="col-xs-8">
						<img src="" id="image_preview" width="200" height="200" class="img-rounded">
					</div>
				</div>
			</div>
		</div>
			
		</form>
	</div>
</div>
<script type="text/javascript">
	$('#container').hide();

	$(window).on('load',function(){
		var image_preview = $('#image_preview');
		$('#profile').change(function(e){
			
			try{
					$('#container').show();
					var url = URL.createObjectURL(e.target.files[0]);
					image_preview.attr('src',url);
			}
			catch(e)
			{
				$('#container').hide();
				return false;
			}
			

			URL.revokeObjectURL(this.src);
		});
	});
</script>
