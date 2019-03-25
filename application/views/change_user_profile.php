<style type="text/css">
div.change_profile
{
	margin: auto;
	padding: 1%;
	box-shadow: 4px 5px 20px 6px gray;
	height: 500px;
}
input{overflow: hidden;}
</style>
<div class="change_profile">
	<div class="container">
		<a href="<?php echo base_url('edit-user-details/'.$user_id) ?>" class="btn btn-info">
			<i class="fa fa-angle-double-left"></i> User Profile
		</a>

		<h3 class="text-center">Change User Profile</h3>
	<form method="post" action="<?php echo base_url('change-user-profile-submit/'.$user_id) ?>" enctype="multipart/form-data">	
		<div class="row">
			<div class="col-sm-4 col-xs-4">
				<div class="row">
					<div class="col-xs-5">Old Profile Picture :</div>
				</div>
				<br>
				<div class="row">	
					<div class="col-xs-7">
					<?php $user_id = $this->session->userdata('user_id');
						$user_pic = 'user-profile/'.$user_id.'.jpg';	
				 	?>
				 	<?php if(file_exists($user_pic)): ?>
						<img src="<?php echo base_url("$user_pic") ?>" class="img-rounded" style="cursor: pointer;" heigth="200" width="250">
					<?php else: ?>
						<img src="<?php echo base_url("user-profile/default.jpg") ?>" class="img-rounded" style="cursor: pointer;" height="200" width="250">
					<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-xs-4" id="hidden" style="display: none;">
				<div class="row">
					<div class="col-xs-5">New Profile Picture :</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-7">
						<img src="" id="preview" class="img-rounded" style="cursor: pointer;" height="200" width="250">
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-xs-4">
				<div class="row">
					<div class="col-xs-5">Upload Picture :</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-11">
						<input type="file" name="file" id="file" class="form-control" required>
					</div>
				</div>
			</div>
		</div>	
		<br>
		<div class="row">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<input type="submit" value="Submit" class="btn btn-success">
			</div>
		</div>
	</form>
	</div>
</div>
<div id="model" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">
		        	<em style="color: blue;">
		        		<?php echo $this->session->userdata('name'); ?>
		        	</em>
		        </h4>
		    </div>
		    <div class="modal-body">
		        <img src="" id="image_modal" width="100%" height="100%">
		    </div>
	    </div>

	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#file').change(function(event){
			try{
					var url = URL.createObjectURL(event.target.files[0]);
				}
			catch(err){

				$('#hidden').hide();
				// alert('Error is :'+err.message);
				return false;
			}
				$('#hidden').show();
				$('#preview').attr('src',url);

				URL.revokeObjectURL(this.src);
			
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